<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class Following extends Component
{
    public $userId;
    protected $user;

    #[On("unfollowUser")]
    #[Computed]
    public function count()
    {
        $this->user = User::find($this->userId);
        return $this->user->following()->wherePivot("confirmed", true)->count();
    }
    public function render()
    {
        return view("livewire.following");
    }
}
