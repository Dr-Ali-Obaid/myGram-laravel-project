<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On; 

class Follower extends Component
{
    public $userId;
    protected $user;
    #[On("toggling")]
    #[Computed]
    public function countFollowers(){
        $this->user = User::find($this->userId);
        return $this->user->follower()->count();
    }
    public function render()
    {
        return view('livewire.follower');
    }
}
