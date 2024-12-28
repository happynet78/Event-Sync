<?php

namespace App\Models;

use App\Enum\ArticleStatus;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use WireComments\Traits\Commentable;

class Article extends Model
{
    use HasFactory;
    use Commentable;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'media_id'
    ];

    protected $casts = [
        'status' => ArticleStatus::class,
        'content' => 'array'
    ];

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
