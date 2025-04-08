<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class PostList extends Component
{
    #[On("toggling")]
    #[Computed]
    public function posts()
    {
        $ids = auth()
            ->user()
            ->following()
            ->wherePivot("confirmed", true)
            ->get()
            ->pluck("id");
        return Post::whereIn("user_id", $ids)->latest()->get();
    }
    public function render()
    {
        return view("livewire.post-list");
    }
}
