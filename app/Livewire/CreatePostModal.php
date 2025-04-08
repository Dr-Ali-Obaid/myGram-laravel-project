<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use LivewireUI\Modal\ModalComponent;
use Livewire\WithFileUploads;
use Livewire\TemporaryUploadedFile;

class CreatePostModal extends ModalComponent
{
    use WithFileUploads;
    public $image;

    public static function modalMaxWidth(): string
    {
        return "4xl";
    }

    public function save_temp()
    {
        $image = $this->image->store("temp", "public");
        $this->dispatch("openModal", "filters-modal", ["image" => $image]);
    }

    public function render()
    {
        return view("livewire.create-post-modal");
    }
}
