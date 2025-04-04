<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 

class PostsCount extends Component
{

    public $user;
   

    #[On("publish-new-post")]
    public function mount(){
        $this->user;
    }

    public function render()
    {
        return view('livewire.posts-count');
    }
}
