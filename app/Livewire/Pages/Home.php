<?php

namespace App\Livewire\Pages;

use App\Models\Article as ArticleModel;
use App\Models\Product as ProductModel;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Home extends Component
{
    public $articles;

    public $products;

    public function mount(): void
    {
        $this->articles = ArticleModel::limit(8)->isPublished()->get();
        $this->products = ProductModel::isPublished()->limit(8)->get();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.home');
    }
}
