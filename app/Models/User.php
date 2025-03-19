<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'image',
        'email',
        'password',
        'bio',
        'private_account'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function suggested_users(){
        $followings = auth()->user()->following()->wherePivot("confirmed",true)->get();
        return User::all()->diff($followings)->except(auth()->id())->shuffle()->take(5);
    }
    public function likes(){
        return $this->belongsToMany(Post::class, "likes");
    }
    public function following(){
        return $this->belongsToMany(User::class, "follows", "follower_id" , "following_id")->withTimestamps()->withPivot("confirmed");
    }
    public function follower(){
        return $this->belongsToMany(User::class, "follows", "following_id", "follower_id" )->withTimestamps()->withPivot("confirmed");
    }
    public function toggleFollow(User $user){
        $this->following()->toggle($user); 
        if(!$user->private_account){
            $this->following()->updateExistingPivot($user, ["confirmed" => true]);
        }
    }
    public function follow(User $user){
        if($user->private_account){
            return $this->following()->attach($user);
        }
        return $this->following()->attach($user, ["confirmed" => true]);
    }
    public function unfollow(User $user){
        return $this->following()->detach($user);
    }
    public function pending_followers(){
        return $this->follower()->where("confirmed", false);
    }
   
    public function isPending(User $user){
        return $this->following()->where("following_id", $user->id)->where("confirmed", false)->exists();
    }
    public function isFollowing(User $user){
        return $this->following()->where("following_id", $user->id)->where("confirmed", true)->exists();
    }
    public function isFollower(User $user){
        return $this->follower()->where("follower_id", $user->id)->where("confirmed", true)->exists();
    }
    public function confirm(User $user){
        return $this->follower()->updateExistingPivot($user, ["confirmed" => true]);
    }
    public function  deleteFollowRequest(User $user) {
        return $this->follower()->detach($user);
    }
}


