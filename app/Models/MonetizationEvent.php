<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonetizationEvent extends Model
{
    use HasFactory;

    public const TYPE_AD_IMPRESSION = 'ad_impression';
    public const TYPE_SPONSORED_CLICK = 'sponsored_click';
    public const TYPE_PAID_PURCHASE = 'paid_recipe_purchase';

    protected $fillable = [
        'recipe_id',
        'creator_id',
        'event_type',
        'amount',
        'currency',
        'occurred_at',
    ];

    protected $casts = [
        'amount' => 'decimal:4',
        'occurred_at' => 'immutable_datetime',
    ];

    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
