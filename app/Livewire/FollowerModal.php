<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\Computed;


class FollowerModal extends ModalComponent
{
    public $userId;
    protected $user;
    
   
   
    #[Computed]
    public function followerlist(){
        $this->user = User::find($this->userId);
        return $this->user->follower()->get();
    }
    
    public function render()
    {
        return view('livewire.follower-modal');
    }
}
