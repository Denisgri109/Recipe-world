<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecipeView extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'recipe_id',
        'viewer_id',
        'ip_hash',
        'user_agent',
        'viewed_at',
        'viewed_on',
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }

    public function viewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'viewer_id');
    }
}
