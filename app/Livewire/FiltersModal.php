<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use LivewireUI\Modal\ModalComponent;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class FiltersModal extends ModalComponent
{
    public $image;
    public $filtered_image;
    public $filters = ["Original", "Clarendon", "Gingham", "Moon", "Perpetua"];
    public $temp_images = [];
    public $description;

    public static function modalMaxWidth(): string
    {
        return "4xl";
    }
    public static function dispatchCloseEvent(): bool
    {
        return true;
    }

    public function mount($image)
    {
        $this->image = $image;
        $this->filtered_image = $this->image;
        $this->add_temp_image($this->filtered_image);
    }

    public function filter_original()
    {
        $this->filtered_image = $this->image;
        $this->add_temp_image($this->filtered_image);
    }

    public function filter_clarendon()
    {
        // إنشاء مدير الصور
        $manager = new ImageManager(new Driver());

        // read an image
        $path = Storage::disk('public')->get($this->image);
        $img = $manager->read($path);

        // increase brightness
        $img = $img->brightness(20)->contrast(15);

        // إنشاء اسم عشوائي جديد للصورة
        $filteredFileName = Str::random(20) . ".jpeg";

        // تحديد مسار التخزين
        $filteredImagePath = "temp/" . $filteredFileName;
        // حفظ الصورة الجديدة في مجلد public/temp
        Storage::disk('public')->put($filteredImagePath, (string) $img->encode());

        // تخزين المسار الصحيح لاستخدامه في العرض
        $this->filtered_image = $filteredImagePath;
        // سيتم استدعاء الدالة add_temp_image() وتمرير الصورة المفلترة الحالية كقيمة لمعاملها من أجل إضافتها للمصفوفة
        $this->add_temp_image($this->filtered_image);
    }

    public function filter_gingham()
    {
        $manager = new ImageManager(new Driver());
        $path = Storage::disk('public')->get($this->image);
        $img = $manager->read($path);
        $img = $img
            ->brightness(10)
            ->contrast(5)
            ->colorize(10, 0, -10)
            ->gamma(1.1);
        $filteredFileName = Str::random(20) . ".jpeg";
        $filteredImagePath = "temp/" . $filteredFileName;
        Storage::disk('public')->put($filteredImagePath, (string) $img->encode());
        $this->filtered_image = $filteredImagePath;
        $this->add_temp_image($this->filtered_image);
    }

    public function filter_moon()
    {
        $manager = new ImageManager(new Driver());
        $path = Storage::disk('public')->get($this->image);
        $img = $manager->read($path);
        $img = $img->greyscale();
        $filteredFileName = Str::random(20) . ".jpeg";
        $filteredImagePath = "temp/" . $filteredFileName;
        Storage::disk('public')->put($filteredImagePath, (string) $img->encode());
        $this->filtered_image = $filteredImagePath;
        $this->add_temp_image($this->filtered_image);
    }
    public function filter_perpetua()
    {
        $manager = new ImageManager(new Driver());
        $path = Storage::disk('public')->get($this->image);
        $img = $manager->read($path);
        $img = $img
            ->colorize(-30, 10, 10)
            ->contrast(-10)
            ->gamma(0.9);
        $filteredFileName = Str::random(20) . ".jpeg";
        $filteredImagePath = "temp/" . $filteredFileName;
        Storage::disk('public')->put($filteredImagePath, (string) $img->encode());
        $this->filtered_image = $filteredImagePath;
        $this->add_temp_image($this->filtered_image);
    }

    public function publish()
    {
        $this->validate([
            "description" => "required",
        ]);
        $post_image = "posts/" . Str::random(20) . ".jpeg";
        Storage::disk('public')->put($post_image, Storage::disk('public')->get($this->filtered_image));
        Storage::disk('public')->delete($this->filtered_image);

        $post = auth()
            ->user()
            ->posts()
            ->create([
                "description" => $this->description,
                "slug" => Str::random(10),
                "image" => $post_image,
            ]);
        $this->forceClose()->closeModal();
        $this->dispatch("publish-new-post");
    }

    public function add_temp_image($image)
    {
        $this->temp_images[] = $image;
    }

    #[On("modalClosed")]
    public function delete_temp_image()
    {
        Storage::disk("public")->delete($this->temp_images);
    }

    public function render()
    {
        return view("livewire.filters-modal");
    }
}
