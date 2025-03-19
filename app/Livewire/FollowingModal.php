<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\Computed;


class FollowingModal extends ModalComponent
{
    public $userId;
    protected $user;
    
    #[Computed]
    public function followingList(){
        $this->user = User::find($this->userId);
        return $this->user->following()->wherePivot("confirmed", true)->get();
    }
    public function unfollowing($followingUserId){
        $following_user = User::find($followingUserId);
        $this->user = User::find($this->userId);
        $this->user->unfollow($following_user);
        $this->dispatch("unfollowUser");
    }
    public function render()
    {
        return view('livewire.following-modal');
    }
}
