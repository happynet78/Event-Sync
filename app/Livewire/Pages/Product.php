<?php

namespace App\Livewire\Pages;

use App\Models\Product as ProductModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Product extends Component
{
    public ProductModel $product;

    public string $previewUrl;

    public function mount(): void
    {
        views($this->product)->record();
        $this->previewUrl = (string) $this->product->images?->first()->path;
    }

    public function getSlides(): array
    {
        return $this->product->images->map(function ($image) {
            return [
                'image' => Storage::url($image->path),
            ];
        })->toArray();
    }

    public function setPreviewUrl($image): void
    {
        $this->previewUrl = (string) $image['path'];
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.pages.product');
    }
}
