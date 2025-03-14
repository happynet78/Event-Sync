<?php

namespace App\Livewire\Components;

use App\Models\Product;
use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\View\View;

class ProductVariantSelector extends Component
{
    public Product $product;
    public $selectedColor = null;
    public array $selectedOptions = [];

    public function mount(): void
    {
        $this->selectedColor = null;
        $this->selectedOptions = [];
    }

    public function selectColor($color): void
    {
        $this->selectedColor = $color;
    }

    public function getColorVariants(): Collection
    {
        return collect($this->product->variant)
            ->filter(fn ($variant) => $variant['type'] === 'Color');
    }

    public function getChildrenVariants(): Collection
    {
        if(!$this->selectedColor || !isset($this->product->variants[$this->selectedColor]['children'])) {
            return collect();
        }

        return collect($this->product->variants[$this->selectedColor]['children']);
    }

    public function render(): View
    {
        return view('livewire.components.product-variant-selector', [
            'colorVariants' => $this->getColorVariants(),
            'childrenVariants' => $this->getChildrenVariants(),
        ]);
    }
}
