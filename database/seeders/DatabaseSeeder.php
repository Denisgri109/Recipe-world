<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Users
        User::factory(5)->create();

        // 2. Seed Categories
        Category::factory()
            ->count(8)
            ->sequence(
                ['name' => 'Breakfast',  'description' => 'Start your day with a hearty meal.'],
                ['name' => 'Lunch',      'description' => 'Midday meals to keep you going.'],
                ['name' => 'Dinner',     'description' => 'Delicious evening recipes.'],
                ['name' => 'Desserts',   'description' => 'Sweet treats and baked goods.'],
                ['name' => 'Appetizers', 'description' => 'Small bites to get things started.'],
                ['name' => 'Soups',      'description' => 'Warm and comforting bowls.'],
                ['name' => 'Salads',     'description' => 'Fresh and healthy options.'],
                ['name' => 'Snacks',     'description' => 'Quick bites for any time of day.'],
            )
            ->create();

        // 3. Seed Recipes (with ingredients)
        $this->call(RecipeSeeder::class);
    }
}
