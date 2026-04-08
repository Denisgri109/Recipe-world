<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Grab all seeded users and categories
        $userIds = User::pluck('id')->toArray();
        $categoryIds = Category::pluck('id')->toArray();

        // Guard – if no users or categories exist, skip
        if (empty($userIds) || empty($categoryIds)) {
            $this->command->warn('Skipping RecipeSeeder: seed users and categories first.');
            return;
        }

        // Create 18 sample recipes spread across users & categories
        $recipes = Recipe::factory()
            ->count(18)
            ->sequence(fn ($sequence) => [
                'user_id' => $userIds[$sequence->index % count($userIds)],
                'category_id' => $categoryIds[$sequence->index % count($categoryIds)],
            ])
            ->create();

        // For each recipe, attach 3–7 ingredients with sequential order
        $recipes->each(function (Recipe $recipe) {
            $count = rand(3, 7);
            for ($i = 1; $i <= $count; $i++) {
                Ingredient::factory()->create([
                    'recipe_id' => $recipe->id,
                    'order' => $i,
                ]);
            }
        });
    }
}
