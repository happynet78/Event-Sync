<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class Header extends Component
{
    public function render(): View
    {
        return view('livewire.header');
    }
}
