<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Cviebrock\EloquentSluggable\Sluggable;

class Recipe extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'instructions',
        'prep_time',
        'cook_time',
        'servings',
        'difficulty',
        'image_path',
        'category_id',
        'is_draft',
        'views_count',
    ];

    protected $casts = [
        'is_draft' => 'boolean',
    ];

    public function scopeOwnedBy(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public function scopeSortForCreator(Builder $query, string $sort): Builder
    {
        return match ($sort) {
            'most_viewed' => $query->orderByDesc('views_count')->latest('id'),
            default => $query->latest(),
        };
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class);
    }

    public function views(): HasMany
    {
        return $this->hasMany(RecipeView::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
