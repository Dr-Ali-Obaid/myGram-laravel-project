<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On; 

class PendingFollowerCount extends Component
{
    #[On( ["toggling" , "requestConfirmed" , "requestDeleted"]  )]
    #[Computed]
    public function count(){
        return auth()->user()->pending_followers()->count();
    }
    public function render()
    {
        return view('livewire.pending-follower-count');
    }
}
