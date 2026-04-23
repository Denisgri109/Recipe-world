<?php

namespace Tests\Feature;

use App\Models\MonetizationEvent;
use App\Models\Recipe;
use App\Models\User;
use App\Services\MonetizationAggregationService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MonetizationAggregationServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_total_revenue_returns_decimal_safe_values_and_zero_default(): void
    {
        $creator = User::factory()->create();
        $otherCreator = User::factory()->create();
        $recipe = Recipe::factory()->create(['user_id' => $creator->id]);

        MonetizationEvent::factory()->create([
            'recipe_id' => $recipe->id,
            'creator_id' => $creator->id,
            'currency' => 'EUR',
            'amount' => '1.1250',
            'occurred_at' => Carbon::parse('2026-04-20 10:00:00'),
        ]);

        MonetizationEvent::factory()->create([
            'recipe_id' => $recipe->id,
            'creator_id' => $creator->id,
            'currency' => 'EUR',
            'amount' => '2.0050',
            'occurred_at' => Carbon::parse('2026-04-21 10:00:00'),
        ]);

        MonetizationEvent::factory()->create([
            'recipe_id' => $recipe->id,
            'creator_id' => $otherCreator->id,
            'currency' => 'EUR',
            'amount' => '9.9900',
            'occurred_at' => Carbon::parse('2026-04-21 10:00:00'),
        ]);

        $service = app(MonetizationAggregationService::class);

        $this->assertSame('3.1300', $service->totalRevenue($creator->id, 'eur'));
        $this->assertSame('0.0000', $service->totalRevenue($creator->id, 'USD'));
    }

    public function test_revenue_by_recipe_and_over_time_are_grouped_correctly(): void
    {
        $creator = User::factory()->create();
        $recipeA = Recipe::factory()->create(['user_id' => $creator->id, 'title' => 'Recipe A']);
        $recipeB = Recipe::factory()->create(['user_id' => $creator->id, 'title' => 'Recipe B']);

        MonetizationEvent::factory()->create([
            'recipe_id' => $recipeA->id,
            'creator_id' => $creator->id,
            'currency' => 'EUR',
            'amount' => '1.0000',
            'occurred_at' => Carbon::parse('2026-04-20 09:00:00'),
        ]);

        MonetizationEvent::factory()->create([
            'recipe_id' => $recipeA->id,
            'creator_id' => $creator->id,
            'currency' => 'EUR',
            'amount' => '2.5000',
            'occurred_at' => Carbon::parse('2026-04-20 16:00:00'),
        ]);

        MonetizationEvent::factory()->create([
            'recipe_id' => $recipeB->id,
            'creator_id' => $creator->id,
            'currency' => 'EUR',
            'amount' => '5.2500',
            'occurred_at' => Carbon::parse('2026-04-21 10:00:00'),
        ]);

        MonetizationEvent::factory()->create([
            'recipe_id' => $recipeB->id,
            'creator_id' => $creator->id,
            'currency' => 'USD',
            'amount' => '100.0000',
            'occurred_at' => Carbon::parse('2026-04-21 10:00:00'),
        ]);

        $service = app(MonetizationAggregationService::class);

        $byRecipe = $service->revenueByRecipe($creator->id, 'EUR');

        $this->assertCount(2, $byRecipe);
        $this->assertSame($recipeB->id, $byRecipe[0]['recipe_id']);
        $this->assertSame('5.2500', $byRecipe[0]['revenue_total']);
        $this->assertSame($recipeA->id, $byRecipe[1]['recipe_id']);
        $this->assertSame('3.5000', $byRecipe[1]['revenue_total']);

        $overTime = $service->revenueOverTime(
            $creator->id,
            'EUR',
            Carbon::parse('2026-04-20 00:00:00'),
            Carbon::parse('2026-04-21 23:59:59')
        );

        $this->assertSame([
            ['period' => '2026-04-20', 'revenue_total' => '3.5000'],
            ['period' => '2026-04-21', 'revenue_total' => '5.2500'],
        ], $overTime);
    }

    public function test_total_revenue_by_currency_returns_sensible_default(): void
    {
        $creator = User::factory()->create();
        $service = app(MonetizationAggregationService::class);

        $this->assertSame([], $service->totalRevenueByCurrency($creator->id));
    }
}
