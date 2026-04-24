<?php

namespace Database\Factories;

use App\Models\MonetizationEvent;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MonetizationEvent>
 */
class MonetizationEventFactory extends Factory
{
    protected $model = MonetizationEvent::class;

    public function definition(): array
    {
        return [
            'recipe_id' => Recipe::factory(),
            'creator_id' => User::factory(),
            'event_type' => fake()->randomElement([
                MonetizationEvent::TYPE_AD_IMPRESSION,
                MonetizationEvent::TYPE_SPONSORED_CLICK,
                MonetizationEvent::TYPE_PAID_PURCHASE,
            ]),
            'amount' => fake()->randomFloat(4, 0.01, 25),
            'currency' => fake()->randomElement(['EUR', 'USD']),
            'occurred_at' => now()->subDays(fake()->numberBetween(0, 30)),
        ];
    }
}
