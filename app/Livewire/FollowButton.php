<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class FollowButton extends Component
{
    
    public $userId;
    protected $user;
    public $follow_state;
    public $classes;

    public function mount(){
        $this->user = User::find($this->userId);
        $this->set_follow_state();
    }

    public function toggling(){
        $this->user = User::find($this->userId);
        auth()->user()->toggleFollow($this->user);
        $this->set_follow_state();
        $this->dispatch("toggling");
    }

    protected function set_follow_state(){
        
        if(auth()->user()->isPending($this->user)){
            $this->follow_state = "Pending";
        }
        elseif(auth()->user()->isFollowing($this->user)){
            $this->follow_state = "Unfollow";
        }
        else{
            $this->follow_state = "Follow";
        }
    }

    public function render()
    {
        return view('livewire.follow-button');
    }
}
