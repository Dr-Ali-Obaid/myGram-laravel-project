<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class ProfilePosts extends Component
{
    public $user;

    #[On("toggling")]
    public function mount()
    {
        $this->user;
    }

    #[On("publish-new-post")]
    public function refreshUserPosts()
    {
        $this->user->load("posts"); // إعادة تحميل المنشورات
    }
    public function render()
    {
        return view("livewire.profile-posts");
    }
}
