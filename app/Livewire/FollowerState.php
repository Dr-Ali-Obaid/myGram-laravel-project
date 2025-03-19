<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On; 

class FollowerState extends Component
{
    
    public $userId;
    public $isFollower = false;
    #[On(  "requestConfirmed"  )]
    public function mount(){
        
       $this->isFollower =  auth()->user()->follower()->where("follower_id", $this->userId)->where('confirmed', true)->exists();
    }
    public function render()

    {
        return view('livewire.follower-state');
    }
}
