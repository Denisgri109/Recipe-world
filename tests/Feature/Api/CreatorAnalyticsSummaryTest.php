<?php

namespace Tests\Feature\Api;

use App\Models\Recipe;
use App\Models\RecipeView;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreatorAnalyticsSummaryTest extends TestCase
{
    use RefreshDatabase;

    public function test_summary_requires_authentication(): void
    {
        $this->getJson('/api/creator/analytics/summary')->assertUnauthorized();
    }

    public function test_summary_returns_creator_level_aggregated_metrics(): void
    {
        Carbon::setTestNow('2026-04-23 12:00:00');

        $creator = User::factory()->create();
        $otherUser = User::factory()->create();
        $viewerA = User::factory()->create();
        $viewerB = User::factory()->create();

        $creatorRecipeA = Recipe::factory()->create([
            'user_id' => $creator->id,
            'views_count' => 10,
            'title' => 'Creator Recipe A',
        ]);

        $creatorRecipeB = Recipe::factory()->create([
            'user_id' => $creator->id,
            'views_count' => 20,
            'title' => 'Creator Recipe B',
        ]);

        $otherRecipe = Recipe::factory()->create([
            'user_id' => $otherUser->id,
            'views_count' => 999,
            'title' => 'Other Recipe',
        ]);

        $this->createView($creatorRecipeA, $viewerA->id, null, '2026-04-22 10:00:00');
        $this->createView($creatorRecipeB, $viewerB->id, null, '2026-04-21 10:00:00');
        $this->createView($creatorRecipeA, null, hash('sha256', '10.0.0.1'), '2026-04-20 10:00:00');

        $this->createView($creatorRecipeA, $viewerA->id, null, '2026-04-10 10:00:00');
        $this->createView($creatorRecipeB, null, hash('sha256', '10.0.0.2'), '2026-04-11 10:00:00');

        $this->createView($otherRecipe, User::factory()->create()->id, null, '2026-04-22 10:00:00');

        Sanctum::actingAs($creator);

        $response = $this->getJson('/api/creator/analytics/summary');

        $response
            ->assertOk()
            ->assertJsonPath('data.total_recipes', 2)
            ->assertJsonPath('data.total_views', 30)
            ->assertJsonPath('data.unique_viewers', 4)
            ->assertJsonPath('data.avg_views_per_recipe', 15)
            ->assertJsonPath('data.views_last_7_days', 3)
            ->assertJsonPath('data.views_previous_7_days', 2)
            ->assertJsonPath('data.growth_percentage', 50)
            ->assertJsonPath('data.top_recipe.id', $creatorRecipeB->id)
            ->assertJsonPath('data.top_recipe.views_count', 20);
    }

    public function test_growth_is_100_percent_when_previous_period_has_no_views(): void
    {
        Carbon::setTestNow('2026-04-23 12:00:00');

        $creator = User::factory()->create();
        $recipe = Recipe::factory()->create([
            'user_id' => $creator->id,
            'views_count' => 1,
        ]);

        $this->createView($recipe, null, hash('sha256', '10.0.0.9'), '2026-04-22 10:00:00');

        Sanctum::actingAs($creator);

        $response = $this->getJson('/api/creator/analytics/summary');

        $response
            ->assertOk()
            ->assertJsonPath('data.views_last_7_days', 1)
            ->assertJsonPath('data.views_previous_7_days', 0)
            ->assertJsonPath('data.growth_percentage', 100);
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    private function createView(Recipe $recipe, ?int $viewerId, ?string $ipHash, string $viewedAt): void
    {
        RecipeView::query()->create([
            'recipe_id' => $recipe->id,
            'viewer_id' => $viewerId,
            'ip_hash' => $ipHash,
            'user_agent' => 'test-agent',
            'viewed_at' => Carbon::parse($viewedAt),
            'viewed_on' => Carbon::parse($viewedAt)->toDateString(),
        ]);
    }
}
