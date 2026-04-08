<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Seed the application's recipe categories.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Breakfast', 'description' => 'Start your day with delicious breakfast ideas.'],
            ['name' => 'Lunch', 'description' => 'Tasty midday meals for every schedule.'],
            ['name' => 'Dinner', 'description' => 'Hearty evening recipes for family and friends.'],
            ['name' => 'Desserts', 'description' => 'Sweet recipes for every occasion.'],
            ['name' => 'Snacks', 'description' => 'Quick bites and light treats.'],
            ['name' => 'Soups', 'description' => 'Warm and comforting soup recipes.'],
            ['name' => 'Salads', 'description' => 'Fresh, vibrant, and healthy salad ideas.'],
            ['name' => 'Vegan', 'description' => 'Plant-based recipes full of flavor.'],
            ['name' => 'Gluten-Free', 'description' => 'Recipes made without gluten ingredients.'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description']]
            );
        }
    }
}
