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
        $categories = Category::pluck('id', 'name')->toArray();

        // Guard – if no users or categories exist, skip
        if (empty($userIds) || empty($categories)) {
            $this->command->warn('Skipping RecipeSeeder: seed users and categories first.');
            return;
        }

        $recipes = [
            [
                'title' => 'Classic Margherita Pizza',
                'description' => 'A simple and delicious pizza with tomato sauce, mozzarella, and fresh basil.',
                'instructions' => "1. Preheat oven to 220C (425F).\n\n2. Roll out pizza dough on a floured surface into a round shape.\n\n3. Spread tomato sauce evenly over the base, leaving a small border.\n\n4. Tear fresh mozzarella and scatter over the sauce.\n\n5. Drizzle with olive oil and season with salt.\n\n6. Bake for 12 to 15 minutes until the crust is golden and cheese is bubbly.\n\n7. Top with fresh basil leaves before serving.",
                'prep_time' => 15,
                'cook_time' => 15,
                'servings' => 2,
                'difficulty' => 'medium',
                'image_path' => 'https://images.unsplash.com/photo-1604068549290-dea0e4a305ca?q=80&w=800&auto=format&fit=crop',
                'category_id' => $categories['Dinner'] ?? array_values($categories)[0],
                'ingredients' => [
                    ['name' => 'Pizza dough', 'quantity' => '1 ball'],
                    ['name' => 'Tomato sauce', 'quantity' => '1/2 cup'],
                    ['name' => 'Fresh mozzarella', 'quantity' => '200g'],
                    ['name' => 'Fresh basil', 'quantity' => '1 handful'],
                    ['name' => 'Olive oil', 'quantity' => '1 tbsp'],
                ]
            ],
            [
                'title' => 'Fluffy Banana Pancakes',
                'description' => 'Light and fluffy pancakes with ripe banana folded into the batter.',
                'instructions' => "1. Mash two ripe bananas in a mixing bowl.\n\n2. Add eggs, milk, melted butter, and vanilla extract. Whisk together.\n\n3. In a separate bowl, combine flour, sugar, baking powder, and salt.\n\n4. Fold the dry ingredients into the wet mixture until just combined.\n\n5. Heat a non-stick pan over medium heat. Pour 1/4 cup batter per pancake.\n\n6. Cook until bubbles form on the surface, then flip and cook 2 more minutes.\n\n7. Serve with maple syrup and fresh berries.",
                'prep_time' => 10,
                'cook_time' => 15,
                'servings' => 4,
                'difficulty' => 'easy',
                'image_path' => 'https://images.unsplash.com/photo-1528207776546-3221869f33ae?q=80&w=800&auto=format&fit=crop',
                'category_id' => $categories['Breakfast'] ?? array_values($categories)[0],
                'ingredients' => [
                    ['name' => 'Ripe bananas', 'quantity' => '2 large'],
                    ['name' => 'Eggs', 'quantity' => '2'],
                    ['name' => 'Milk', 'quantity' => '1 cup'],
                    ['name' => 'Flour', 'quantity' => '1.5 cups'],
                    ['name' => 'Baking powder', 'quantity' => '1 tbsp'],
                ]
            ],
            [
                'title' => 'Beef Stir-Fry with Vegetables',
                'description' => 'A quick and flavourful stir-fry with tender beef strips and fresh vegetables.',
                'instructions' => "1. Slice beef into thin strips and marinate with soy sauce, garlic, and cornstarch for 15 minutes.\n\n2. Heat oil in a wok over high heat.\n\n3. Cook the beef strips for 2 minutes until browned. Remove and set aside.\n\n4. Add sliced bell peppers, broccoli, and snap peas to the wok. Stir-fry for 3 minutes.\n\n5. Return the beef to the wok. Add soy sauce, sesame oil, and a pinch of sugar.\n\n6. Toss everything together and serve over steamed rice.",
                'prep_time' => 20,
                'cook_time' => 10,
                'servings' => 3,
                'difficulty' => 'medium',
                'image_path' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?q=80&w=800&auto=format&fit=crop',
                'category_id' => $categories['Lunch'] ?? array_values($categories)[0],
                'ingredients' => [
                    ['name' => 'Beef strips', 'quantity' => '500g'],
                    ['name' => 'Bell pepper', 'quantity' => '1 sliced'],
                    ['name' => 'Broccoli', 'quantity' => '1 cup'],
                    ['name' => 'Soy sauce', 'quantity' => '3 tbsp'],
                    ['name' => 'Sesame oil', 'quantity' => '1 tbsp'],
                ]
            ],
            [
                'title' => 'Chocolate Chip Cookies',
                'description' => 'Chewy and golden cookies loaded with chocolate chips.',
                'instructions' => "1. Preheat oven to 180C (350F). Line a baking tray with parchment paper.\n\n2. Cream together butter and sugar until light and fluffy.\n\n3. Beat in eggs one at a time, then add vanilla extract.\n\n4. Mix in flour, baking soda, and salt until a dough forms.\n\n5. Fold in chocolate chips.\n\n6. Scoop tablespoon-sized balls of dough onto the tray, spacing them apart.\n\n7. Bake for 10 to 12 minutes until edges are golden. Cool on the tray for 5 minutes.",
                'prep_time' => 15,
                'cook_time' => 12,
                'servings' => 12,
                'difficulty' => 'easy',
                'image_path' => 'https://images.unsplash.com/photo-1499636136210-6f4ee915583e?q=80&w=800&auto=format&fit=crop',
                'category_id' => $categories['Desserts'] ?? array_values($categories)[0],
                'ingredients' => [
                    ['name' => 'Butter', 'quantity' => '1 cup'],
                    ['name' => 'Sugar', 'quantity' => '1.5 cups'],
                    ['name' => 'Flour', 'quantity' => '2 cups'],
                    ['name' => 'Chocolate chips', 'quantity' => '2 cups'],
                    ['name' => 'Vanilla extract', 'quantity' => '1 tsp'],
                ]
            ],
            [
                'title' => 'Creamy Tomato Soup',
                'description' => 'A smooth and velvety tomato soup perfect for a cosy evening.',
                'instructions' => "1. Heat butter in a pot over medium heat. Add diced onion and garlic, cook until soft.\n\n2. Add canned crushed tomatoes and vegetable broth. Bring to a boil.\n\n3. Reduce heat and simmer for 20 minutes.\n\n4. Blend the soup until smooth using an immersion blender.\n\n5. Stir in heavy cream, salt, and pepper to taste.\n\n6. Serve hot with crusty bread.",
                'prep_time' => 10,
                'cook_time' => 25,
                'servings' => 4,
                'difficulty' => 'easy',
                'image_path' => 'https://images.unsplash.com/photo-1547592166-23ac45744acd?q=80&w=800&auto=format&fit=crop',
                'category_id' => $categories['Soups'] ?? array_values($categories)[0],
                'ingredients' => [
                    ['name' => 'Crushed tomatoes', 'quantity' => '2 cans'],
                    ['name' => 'Onion', 'quantity' => '1 medium'],
                    ['name' => 'Garlic', 'quantity' => '3 cloves'],
                    ['name' => 'Vegetable broth', 'quantity' => '2 cups'],
                    ['name' => 'Heavy cream', 'quantity' => '1/2 cup'],
                ]
            ],
            [
                'title' => 'Avocado Toast with Poached Egg',
                'description' => 'Crunchy toast topped with creamy avocado and a perfectly poached egg.',
                'instructions' => "1. Toast two slices of sourdough bread until golden.\n\n2. Mash a ripe avocado with a fork. Season with salt, pepper, and lemon juice.\n\n3. Spread the mashed avocado onto the toast.\n\n4. Bring a pot of water to a gentle simmer. Add a splash of vinegar.\n\n5. Crack an egg into a small cup and gently slide it into the water.\n\n6. Poach for 3 to 4 minutes. Remove with a slotted spoon.\n\n7. Place the egg on the avocado toast. Season with chilli flakes and serve.",
                'prep_time' => 5,
                'cook_time' => 5,
                'servings' => 1,
                'difficulty' => 'medium',
                'image_path' => 'https://images.unsplash.com/photo-1603048297172-c92544798d5e?q=80&w=800&auto=format&fit=crop',
                'category_id' => $categories['Breakfast'] ?? array_values($categories)[0],
                'ingredients' => [
                    ['name' => 'Sourdough bread', 'quantity' => '2 slices'],
                    ['name' => 'Avocado', 'quantity' => '1 ripe'],
                    ['name' => 'Egg', 'quantity' => '1 large'],
                    ['name' => 'Lemon juice', 'quantity' => '1 tsp'],
                    ['name' => 'Chilli flakes', 'quantity' => 'a pinch'],
                ]
            ],
        ];

        foreach ($recipes as $index => $recipeData) {
            $ingredients = $recipeData['ingredients'];
            unset($recipeData['ingredients']);

            // Pick a user sequentially
            $recipeData['user_id'] = $userIds[$index % count($userIds)];
            $recipeData['slug'] = \Illuminate\Support\Str::slug($recipeData['title']) . '-' . rand(100, 999);

            $recipe = Recipe::create($recipeData);

            foreach ($ingredients as $ingredientIndex => $ingredient) {
                Ingredient::create([
                    'recipe_id' => $recipe->id,
                    'name' => $ingredient['name'],
                    'quantity' => $ingredient['quantity'],
                    'order' => $ingredientIndex + 1,
                ]);
            }
        }
    }
}
