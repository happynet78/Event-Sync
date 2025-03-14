<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\View\View;
class VariantOptionSelector extends Component
{
    public $variant;
    public $variantId;
    public $isSelected;

    public function mount($variant, $variantId, $isSelected = false): void
    {
        $this->variant = $variant;
        $this->variantId = $variantId;
        $this->isSelected = $isSelected;
    }

    public function render():View
    {
        return view('livewire.components.variant-option-selector');
    }
}
