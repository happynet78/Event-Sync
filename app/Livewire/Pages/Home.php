<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Article;

class Home extends Component
{
    public $articles;

    public function mount(): void
    {
        $this->articles = Article::limit(8)->isPublished()->get();
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.home');
    }
}
