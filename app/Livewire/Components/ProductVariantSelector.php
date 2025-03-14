<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use App\Models\Product;
use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\View\View;

class ProductVariantSelector extends Component
{
    public Product $product;

    /**
     * The ID of the selected top-level (Color) variant.)
     */
    public $selectedColor = null;

    /**
     *
     * The Nested selection.
     * Selections are atored by parent key, for example:
     * [
     *      // For children of the selected Color (keyed by color variant id):
     *      '
     * ]
     *
     */
    public array $selectedOptions = [];

    public function mount(): void
    {
        $this->selectedColor = null;
        $this->selectedOptions = [];
    }

    public function selectColor(string $color): void
    {
        $this->selectedColor = $color;
        // Reset any nested selectedions when the color changes.
        $this->selectedOptions = [];
    }

    public function getColorVariants(): Collection
    {
        return collect($this->product->variants)
            ->filter(fn ($variant) => $variant['type'] === 'Color');
    }

    public function addToBasket(): void
    {
        // Validate that a color has been selected, and-for example-a valid Range option,
        // If applicable. Use $this->>selectedColor and $this->>selectedOptions.
        // Then add the product (and variant choices) to the basket.
        // You may dispatch an event or redirect as needed.
        //
        // For this example, we simply emit an event.
        $this->dispatch( 'productAddedToBasket', [
            'productId' => $this->product->id,
            'color' => $this->selectedColor,
            'variants' => $this->selectedVariants,
        ]);
    }

    public function render(): View
    {
        return view('livewire.components.product-variant-selector', [
            'colorVariants' => $this->getColorVariants(),
        ]);
    }
}
