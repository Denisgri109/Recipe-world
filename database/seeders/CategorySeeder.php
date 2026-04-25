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
            ['name' => 'Breakfast', 'description' => 'Start your day with delicious breakfast ideas.', 'image' => 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Lunch', 'description' => 'Tasty midday meals for every schedule.', 'image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Dinner', 'description' => 'Hearty evening recipes for family and friends.', 'image' => 'https://images.unsplash.com/photo-1473093295043-cdd812d0e601?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Desserts', 'description' => 'Sweet recipes for every occasion.', 'image' => 'https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Snacks', 'description' => 'Quick bites and light treats.', 'image' => 'https://images.unsplash.com/photo-1599490659213-e2b9527bd087?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Soups', 'description' => 'Warm and comforting soup recipes.', 'image' => 'https://images.unsplash.com/photo-1547592166-23ac45744acd?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Salads', 'description' => 'Fresh, vibrant, and healthy salad ideas.', 'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Vegan', 'description' => 'Plant-based recipes full of flavor.', 'image' => 'https://images.unsplash.com/photo-1511690656952-34342bb7c2f2?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Gluten-Free', 'description' => 'Recipes made without gluten ingredients.', 'image' => 'https://images.unsplash.com/photo-1599084993091-1cb5c0721cc6?q=80&w=800&auto=format&fit=crop'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                [
                    'description' => $category['description'],
                    'image' => $category['image'] ?? null,
                ]
            );
        }
    }
}
