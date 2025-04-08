<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\On;

class Likedby extends Component
{
    public $post;

    #[On("toggle")]
    #[Computed]
    public function likes()
    {
        return $this->post->likes()->count();
    }

    #[Computed]
    public function firstusername()
    {
        return $this->post->likes()->first()->username;
    }

    public function render()
    {
        return view("livewire.likedby");
    }
}
