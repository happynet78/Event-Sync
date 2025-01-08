<?php

namespace App\Livewire\Components;

use Illuminate\View\View;
use Livewire\Component;

class Navbar extends Component
{
    public bool $responsiveMenu = false;

    public function toggleDrawer(): void
    {
        $this->responsiveMenu = !$this->responsiveMenu;
    }

    public function render():View
    {
        return view('livewire.components.navbar');
    }
}
