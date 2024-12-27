<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Article as ArticleModel;

class Article extends Component
{
    public ArticleModel $article;

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.article');
    }
}
