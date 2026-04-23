<?php

namespace Tests\Feature;

use App\Models\Recipe;
use App\Models\User;
use App\Services\RecipeViewTrackingService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecipeViewTrackingTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_counted_once_per_day_for_same_recipe(): void
    {
        $recipe = Recipe::factory()->create(['views_count' => 0]);
        $service = app(RecipeViewTrackingService::class);

        Carbon::setTestNow('2026-04-23 10:00:00');

        $first = $service->track($recipe, null, '10.0.0.1', 'test-agent');
        $second = $service->track($recipe, null, '10.0.0.1', 'test-agent');

        $this->assertTrue($first['counted']);
        $this->assertFalse($second['counted']);
        $this->assertSame(1, $second['views_count']);
        $this->assertSame(1, $second['unique_today']);

        $this->assertDatabaseCount('recipe_views', 1);
    }

    public function test_guest_can_be_counted_again_on_next_day(): void
    {
        $recipe = Recipe::factory()->create(['views_count' => 0]);
        $service = app(RecipeViewTrackingService::class);

        Carbon::setTestNow('2026-04-23 10:00:00');
        $service->track($recipe, null, '10.0.0.1', 'test-agent');

        Carbon::setTestNow('2026-04-24 10:00:00');
        $nextDay = $service->track($recipe, null, '10.0.0.1', 'test-agent');

        $this->assertTrue($nextDay['counted']);
        $this->assertSame(2, $nextDay['views_count']);
        $this->assertSame(1, $nextDay['unique_today']);
        $this->assertDatabaseCount('recipe_views', 2);
    }

    public function test_authenticated_user_is_counted_once_per_day_by_user_id(): void
    {
        $recipe = Recipe::factory()->create(['views_count' => 0]);
        $userA = User::factory()->create();
        $userB = User::factory()->create();
        $service = app(RecipeViewTrackingService::class);

        Carbon::setTestNow('2026-04-23 12:00:00');

        $firstUserA = $service->track($recipe, $userA, '10.0.0.1', 'browser-a');
        $secondUserA = $service->track($recipe, $userA, '10.0.0.99', 'browser-a');
        $firstUserB = $service->track($recipe, $userB, '10.0.0.1', 'browser-b');

        $this->assertTrue($firstUserA['counted']);
        $this->assertFalse($secondUserA['counted']);
        $this->assertTrue($firstUserB['counted']);
        $this->assertSame(2, $firstUserB['views_count']);
        $this->assertSame(2, $firstUserB['unique_today']);

        $this->assertDatabaseCount('recipe_views', 2);
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }
}
