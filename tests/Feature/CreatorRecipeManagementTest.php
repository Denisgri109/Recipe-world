<?php

namespace Tests\Feature;

use App\Models\MonetizationEvent;
use App\Models\Recipe;
use App\Models\RecipeView;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatorRecipeManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_my_recipes_page_requires_authentication(): void
    {
        $this->get('/creator/my-recipes')->assertRedirect('/login');
    }

    public function test_my_recipes_page_shows_only_authored_recipes(): void
    {
        $creator = User::factory()->create();
        $otherUser = User::factory()->create();

        $ownRecipe = Recipe::factory()->create([
            'user_id' => $creator->id,
            'title' => 'My Secret Pasta',
            'is_draft' => false,
            'views_count' => 20,
        ]);

        $otherRecipe = Recipe::factory()->create([
            'user_id' => $otherUser->id,
            'title' => 'Other User Recipe',
            'is_draft' => false,
            'views_count' => 999,
        ]);

        RecipeView::query()->create([
            'recipe_id' => $ownRecipe->id,
            'viewer_id' => null,
            'ip_hash' => hash('sha256', '10.0.0.1'),
            'user_agent' => 'test-agent',
            'viewed_at' => now(),
            'viewed_on' => now()->toDateString(),
        ]);

        MonetizationEvent::factory()->create([
            'recipe_id' => $ownRecipe->id,
            'creator_id' => $creator->id,
            'currency' => strtoupper((string) config('app.currency', 'EUR')),
            'amount' => '3.2500',
            'occurred_at' => now(),
        ]);

        $response = $this->actingAs($creator)->get('/creator/my-recipes');

        $response
            ->assertOk()
            ->assertSee('My Secret Pasta')
            ->assertDontSee('Other User Recipe')
            ->assertSee('Published')
            ->assertSee('20')
            ->assertSee('3.2500');

        $this->assertNotNull($otherRecipe);
    }

    public function test_my_recipes_can_be_filtered_by_draft_status(): void
    {
        $creator = User::factory()->create();

        Recipe::factory()->create([
            'user_id' => $creator->id,
            'title' => 'Published Recipe',
            'is_draft' => false,
        ]);

        Recipe::factory()->create([
            'user_id' => $creator->id,
            'title' => 'Draft Recipe',
            'is_draft' => true,
        ]);

        $response = $this->actingAs($creator)->get('/creator/my-recipes?status=draft');

        $response
            ->assertOk()
            ->assertSee('Draft Recipe')
            ->assertDontSee('Published Recipe');
    }
}
