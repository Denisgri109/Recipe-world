<?php

namespace Tests\Feature\Api;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreatorRecipeIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_creator_can_fetch_only_their_recipes(): void
    {
        $creator = User::factory()->create();
        $otherUser = User::factory()->create();

        Recipe::factory()->count(2)->create([
            'user_id' => $creator->id,
            'views_count' => 5,
        ]);

        Recipe::factory()->count(3)->create([
            'user_id' => $otherUser->id,
            'views_count' => 10,
        ]);

        Sanctum::actingAs($creator);

        $response = $this->getJson('/api/creator/recipes');

        $response
            ->assertOk()
            ->assertJsonPath('meta.total', 2)
            ->assertJsonCount(2, 'data');

        foreach ($response->json('data') as $recipe) {
            $this->assertDatabaseHas('recipes', [
                'id' => $recipe['id'],
                'user_id' => $creator->id,
            ]);
        }
    }

    public function test_creator_recipes_can_be_sorted_by_most_viewed(): void
    {
        $creator = User::factory()->create();

        $lowViews = Recipe::factory()->create([
            'user_id' => $creator->id,
            'views_count' => 2,
        ]);

        $highViews = Recipe::factory()->create([
            'user_id' => $creator->id,
            'views_count' => 55,
        ]);

        Sanctum::actingAs($creator);

        $response = $this->getJson('/api/creator/recipes?sort=most_viewed');

        $response->assertOk();

        $ids = array_column($response->json('data'), 'id');

        $this->assertSame($highViews->id, $ids[0]);
        $this->assertSame($lowViews->id, $ids[1]);
    }

    public function test_endpoint_requires_authentication(): void
    {
        $this->getJson('/api/creator/recipes')->assertUnauthorized();
    }
}
