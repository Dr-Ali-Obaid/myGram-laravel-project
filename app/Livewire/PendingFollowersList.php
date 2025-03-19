<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On; 

// #[On(["toggling" => '$refresh', "requestConfirmed" => '$refresh', "requestDeleted" => '$refresh' ])]
class PendingFollowersList extends Component
{
    protected $follower;

    public function confirm($id){
        $this->follower = User::find($id);
        auth()->user()->confirm($this->follower);
        $this->dispatch("requestConfirmed");
    }
    public function delete($id){
        $this->follower = User::find($id);
        auth()->user()->deleteFollowRequest($this->follower);
        $this->dispatch("requestDeleted");
    }
    public function render()
    {
        return view('livewire.pending-followers-list');
    }
}
