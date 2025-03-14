<?php

namespace App\Livewire\Pages;

use App\Models\Article as ArticleModel;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Article extends Component
{
    public ArticleModel $article;

    public function mount(): void
    {
        views($this->article)->record();
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.pages.article');
    }
}
