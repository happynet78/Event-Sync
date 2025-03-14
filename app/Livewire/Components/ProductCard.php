<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use App\Models\Product;
use Illuminate\View\View;
use Livewire\Component;

class ProductCard extends Component
{
    public Product $product;

    public function render(): View
    {
        return view('livewire.components.product-card');
    }
}
