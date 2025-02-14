<?php

namespace App\Livewire\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Article as ArticleModel;

class ArticleGrid extends Component
{
    use WithPagination;

    public Collection $articles;
    public int $limit;
    public $category;
    public $sort_by;
    public bool $show_load_more = false;

    public function mount(): void
    {
        $this->loadMore();
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View
    {
        return view('livewire.components.article-grid');
    }

    /**
     * @return void
     */
    public function loadMore(): void
    {
        $offset = 0;
        if (isset($this->articles)) {
            $offset = $this->articles->count();
        }

        $newArticles = $this->sort_by === 'popular'
            ? $this->getArticlesByViews($offset)
            : $this->getArticlesBySortOrder($offset);

        if (isset($this->articles)) {
            $this->articles = $this->articles->merge($newArticles);
        } else {
            $this->articles = $newArticles;
        }
        $this->show_load_more = $newArticles->count() >= $this->limit;
    }

    /**
     * @return Builder
     */
    private  function getBaseQuery(): Builder
    {
        return ArticleModel::with('categories')
            ->whereHas('categories', function ($query) {
                $query->whereIn('categories.id',  (array) $this->category);
            });
    }

    /**
     * @param int $offset
     * @return Collection
     */
    private function getArticlesByViews(int $offset = 0): Collection
    {
        $cacheKey = 'articles_by_views_' . implode('_', (array) $this->category) . '_offset_' . $offset;
        return cache()->remember($cacheKey, now()->addMinutes(10), function () use ($offset) {
            return $this->getBaseQuery()
                ->orderByViews() // Custom sorting by views
                ->skip($offset) // Skip already loaded articles
                ->limit($this->limit)
                ->get();
        });
    }

    /**
     * @param int $offset
     * @return Collection
     */
    private function getArticlesBySortOrder(int $offset = 0): Collection
    {
        $cacheKey = 'articles_by_sort_' . implode('_', (array) $this->category) . '_' . $this->sort_by . '_offset_' . $offset;

        return cache()->remember($cacheKey, now()->addMinutes(10), function () use ($offset) {
            $validColumns = ['created_at', 'updated_at'];
            $sortBy = in_array($this->sort_by, $validColumns) ? $this->sort_by : 'created_at';

            return $this->getBaseQuery()
                ->orderBy($sortBy, 'desc') // Custom sorting by a valid column
                ->skip($offset) // Skip already loaded articles
                ->limit($this->limit)
                ->get();
        });
    }
}
