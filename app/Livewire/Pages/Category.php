<?php

namespace App\Livewire\Pages;

use App\Models\Category as CategoryModel;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Category extends Component
{
    public CategoryModel $category;

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.pages.category');
    }
}
