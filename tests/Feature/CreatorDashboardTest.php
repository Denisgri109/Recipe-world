<?php

namespace Tests\Feature;

use App\Models\MonetizationEvent;
use App\Models\Recipe;
use App\Models\RecipeView;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatorDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_page_requires_authentication(): void
    {
        $this->get('/creator/dashboard')->assertRedirect('/login');
    }

    public function test_authenticated_user_can_view_dashboard_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/creator/dashboard')
            ->assertOk()
            ->assertSee('Creator Dashboard');
    }

    public function test_dashboard_summary_returns_expected_kpis(): void
    {
        Carbon::setTestNow('2026-04-23 12:00:00');

        $creator = User::factory()->create();
        $viewer = User::factory()->create();

        $recipe = Recipe::factory()->create([
            'user_id' => $creator->id,
            'views_count' => 12,
            'title' => 'Dashboard Recipe',
        ]);

        RecipeView::query()->create([
            'recipe_id' => $recipe->id,
            'viewer_id' => $viewer->id,
            'ip_hash' => null,
            'user_agent' => 'browser-a',
            'viewed_at' => Carbon::parse('2026-04-22 10:00:00'),
            'viewed_on' => '2026-04-22',
        ]);

        MonetizationEvent::factory()->create([
            'recipe_id' => $recipe->id,
            'creator_id' => $creator->id,
            'currency' => 'EUR',
            'amount' => '2.3500',
            'occurred_at' => Carbon::parse('2026-04-22 11:00:00'),
        ]);

        $response = $this->actingAs($creator)
            ->getJson('/creator/dashboard/summary');

        $response
            ->assertOk()
            ->assertJsonPath('data.total_recipes', 1)
            ->assertJsonPath('data.total_views', 12)
            ->assertJsonPath('data.unique_viewers', 1)
            ->assertJsonPath('data.total_revenue', '2.3500')
            ->assertJsonPath('data.currency', 'EUR')
            ->assertJsonPath('data.top_recipe.id', $recipe->id);
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }
}
