<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();
        $categories = Category::pluck('id', 'name')->toArray();

        if (empty($userIds) || empty($categories)) {
            $this->command->warn('Skipping RecipeSeeder: seed users and categories first.');
            return;
        }

        $recipes = [
            // ──── BREAKFAST (2 recipes) ────────────────────────
            [
                'title' => 'Fluffy Banana Pancakes',
                'description' => 'Light and fluffy pancakes with ripe banana folded into the batter, served with maple syrup.',
                'instructions' => "1. Mash two ripe bananas in a mixing bowl.\n\n2. Add eggs, milk, melted butter, and vanilla extract. Whisk together.\n\n3. In a separate bowl, combine flour, sugar, baking powder, and salt.\n\n4. Fold the dry ingredients into the wet mixture until just combined.\n\n5. Heat a non-stick pan over medium heat. Pour 1/4 cup batter per pancake.\n\n6. Cook until bubbles form on the surface, then flip and cook 2 more minutes.\n\n7. Serve with maple syrup and fresh berries.",
                'prep_time' => 10, 'cook_time' => 15, 'servings' => 4, 'difficulty' => 'easy',
                'image_path' => 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?q=80&w=800&auto=format&fit=crop',
                'category' => 'Breakfast',
                'ingredients' => [
                    ['name' => 'Ripe bananas', 'quantity' => '2 large'],
                    ['name' => 'Eggs', 'quantity' => '2'],
                    ['name' => 'Milk', 'quantity' => '1 cup'],
                    ['name' => 'Flour', 'quantity' => '1.5 cups'],
                    ['name' => 'Baking powder', 'quantity' => '1 tbsp'],
                    ['name' => 'Maple syrup', 'quantity' => 'to serve'],
                ],
            ],
            [
                'title' => 'Avocado Toast with Poached Egg',
                'description' => 'Crunchy sourdough toast topped with creamy avocado and a perfectly poached egg.',
                'instructions' => "1. Toast two slices of sourdough bread until golden.\n\n2. Mash a ripe avocado with a fork. Season with salt, pepper, and lemon juice.\n\n3. Spread the mashed avocado onto the toast.\n\n4. Bring a pot of water to a gentle simmer. Add a splash of vinegar.\n\n5. Crack an egg into a small cup and gently slide it into the water.\n\n6. Poach for 3 to 4 minutes. Remove with a slotted spoon.\n\n7. Place the egg on the avocado toast. Season with chilli flakes and serve.",
                'prep_time' => 5, 'cook_time' => 5, 'servings' => 1, 'difficulty' => 'medium',
                'image_path' => 'https://images.unsplash.com/photo-1525351484163-7529414344d8?q=80&w=800&auto=format&fit=crop',
                'category' => 'Breakfast',
                'ingredients' => [
                    ['name' => 'Sourdough bread', 'quantity' => '2 slices'],
                    ['name' => 'Avocado', 'quantity' => '1 ripe'],
                    ['name' => 'Egg', 'quantity' => '1 large'],
                    ['name' => 'Lemon juice', 'quantity' => '1 tsp'],
                    ['name' => 'Chilli flakes', 'quantity' => 'a pinch'],
                ],
            ],

            // ──── LUNCH (2 recipes) ────────────────────────────
            [
                'title' => 'Chicken Caesar Salad Wrap',
                'description' => 'Grilled chicken, crunchy romaine, parmesan, and Caesar dressing wrapped in a warm tortilla.',
                'instructions' => "1. Season chicken breast with salt, pepper, and olive oil.\n\n2. Grill for 6 minutes per side until fully cooked. Rest and slice.\n\n3. Chop romaine lettuce and toss with Caesar dressing.\n\n4. Warm a large flour tortilla in a dry pan.\n\n5. Layer the lettuce, chicken, croutons, and shaved parmesan on the tortilla.\n\n6. Roll tightly and slice in half diagonally.\n\n7. Serve immediately with extra dressing on the side.",
                'prep_time' => 10, 'cook_time' => 12, 'servings' => 2, 'difficulty' => 'easy',
                'image_path' => 'https://images.unsplash.com/photo-1550304943-4f24f54ddde9?q=80&w=800&auto=format&fit=crop',
                'category' => 'Lunch',
                'ingredients' => [
                    ['name' => 'Chicken breast', 'quantity' => '1 large'],
                    ['name' => 'Romaine lettuce', 'quantity' => '2 cups'],
                    ['name' => 'Caesar dressing', 'quantity' => '3 tbsp'],
                    ['name' => 'Parmesan', 'quantity' => '1/4 cup'],
                    ['name' => 'Flour tortilla', 'quantity' => '2 large'],
                ],
            ],
            [
                'title' => 'Beef Stir-Fry with Vegetables',
                'description' => 'A quick and flavourful stir-fry with tender beef strips and fresh vegetables over steamed rice.',
                'instructions' => "1. Slice beef into thin strips and marinate with soy sauce, garlic, and cornstarch for 15 minutes.\n\n2. Heat oil in a wok over high heat.\n\n3. Cook the beef strips for 2 minutes until browned. Remove and set aside.\n\n4. Add sliced bell peppers, broccoli, and snap peas to the wok. Stir-fry for 3 minutes.\n\n5. Return the beef to the wok. Add soy sauce, sesame oil, and a pinch of sugar.\n\n6. Toss everything together and serve over steamed rice.",
                'prep_time' => 20, 'cook_time' => 10, 'servings' => 3, 'difficulty' => 'medium',
                'image_path' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?q=80&w=800&auto=format&fit=crop',
                'category' => 'Lunch',
                'ingredients' => [
                    ['name' => 'Beef strips', 'quantity' => '500g'],
                    ['name' => 'Bell pepper', 'quantity' => '1 sliced'],
                    ['name' => 'Broccoli florets', 'quantity' => '1 cup'],
                    ['name' => 'Soy sauce', 'quantity' => '3 tbsp'],
                    ['name' => 'Sesame oil', 'quantity' => '1 tbsp'],
                    ['name' => 'Steamed rice', 'quantity' => 'to serve'],
                ],
            ],

            // ──── DINNER (2 recipes) ───────────────────────────
            [
                'title' => 'Classic Margherita Pizza',
                'description' => 'A simple and delicious pizza with tomato sauce, fresh mozzarella, and basil on a crispy crust.',
                'instructions' => "1. Preheat oven to 220C (425F).\n\n2. Roll out pizza dough on a floured surface into a round shape.\n\n3. Spread tomato sauce evenly over the base, leaving a small border.\n\n4. Tear fresh mozzarella and scatter over the sauce.\n\n5. Drizzle with olive oil and season with salt.\n\n6. Bake for 12 to 15 minutes until the crust is golden and cheese is bubbly.\n\n7. Top with fresh basil leaves before serving.",
                'prep_time' => 15, 'cook_time' => 15, 'servings' => 2, 'difficulty' => 'medium',
                'image_path' => 'https://images.unsplash.com/photo-1604068549290-dea0e4a305ca?q=80&w=800&auto=format&fit=crop',
                'category' => 'Dinner',
                'ingredients' => [
                    ['name' => 'Pizza dough', 'quantity' => '1 ball'],
                    ['name' => 'Tomato sauce', 'quantity' => '1/2 cup'],
                    ['name' => 'Fresh mozzarella', 'quantity' => '200g'],
                    ['name' => 'Fresh basil', 'quantity' => '1 handful'],
                    ['name' => 'Olive oil', 'quantity' => '1 tbsp'],
                ],
            ],
            [
                'title' => 'Honey Garlic Salmon',
                'description' => 'Baked salmon fillets glazed with a sweet and savoury honey garlic sauce, served with rice.',
                'instructions' => "1. Preheat oven to 200C (400F).\n\n2. Place salmon fillets on a lined baking tray.\n\n3. Mix together honey, soy sauce, minced garlic, and lemon juice.\n\n4. Brush the glaze generously over each fillet.\n\n5. Bake for 12 to 15 minutes until the salmon flakes easily.\n\n6. Garnish with sesame seeds and sliced spring onions.\n\n7. Serve with steamed rice and vegetables.",
                'prep_time' => 10, 'cook_time' => 15, 'servings' => 2, 'difficulty' => 'easy',
                'image_path' => 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?q=80&w=800&auto=format&fit=crop',
                'category' => 'Dinner',
                'ingredients' => [
                    ['name' => 'Salmon fillets', 'quantity' => '2'],
                    ['name' => 'Honey', 'quantity' => '3 tbsp'],
                    ['name' => 'Soy sauce', 'quantity' => '2 tbsp'],
                    ['name' => 'Garlic', 'quantity' => '3 cloves'],
                    ['name' => 'Lemon juice', 'quantity' => '1 tbsp'],
                ],
            ],

            // ──── DESSERTS (2 recipes) ─────────────────────────
            [
                'title' => 'Chocolate Chip Cookies',
                'description' => 'Chewy and golden cookies loaded with rich chocolate chips and a hint of vanilla.',
                'instructions' => "1. Preheat oven to 180C (350F). Line a baking tray with parchment paper.\n\n2. Cream together butter and sugar until light and fluffy.\n\n3. Beat in eggs one at a time, then add vanilla extract.\n\n4. Mix in flour, baking soda, and salt until a dough forms.\n\n5. Fold in chocolate chips.\n\n6. Scoop tablespoon-sized balls of dough onto the tray, spacing them apart.\n\n7. Bake for 10 to 12 minutes until edges are golden. Cool on the tray for 5 minutes.",
                'prep_time' => 15, 'cook_time' => 12, 'servings' => 12, 'difficulty' => 'easy',
                'image_path' => 'https://images.unsplash.com/photo-1499636136210-6f4ee915583e?q=80&w=800&auto=format&fit=crop',
                'category' => 'Desserts',
                'ingredients' => [
                    ['name' => 'Butter', 'quantity' => '1 cup'],
                    ['name' => 'Sugar', 'quantity' => '1.5 cups'],
                    ['name' => 'Flour', 'quantity' => '2 cups'],
                    ['name' => 'Chocolate chips', 'quantity' => '2 cups'],
                    ['name' => 'Vanilla extract', 'quantity' => '1 tsp'],
                ],
            ],
            [
                'title' => 'Classic Tiramisu',
                'description' => 'A luscious Italian dessert layered with espresso-soaked ladyfingers and mascarpone cream.',
                'instructions' => "1. Brew a strong espresso and let it cool. Add a splash of coffee liqueur if desired.\n\n2. Whisk egg yolks and sugar until pale and thick.\n\n3. Fold in mascarpone cheese until smooth.\n\n4. In a separate bowl, whip cream to stiff peaks and fold into the mascarpone mixture.\n\n5. Briefly dip ladyfingers into the espresso and layer them in a dish.\n\n6. Spread half the cream over the ladyfingers. Repeat layers.\n\n7. Dust generously with cocoa powder. Refrigerate for at least 4 hours before serving.",
                'prep_time' => 30, 'cook_time' => 0, 'servings' => 8, 'difficulty' => 'hard',
                'image_path' => 'https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?q=80&w=800&auto=format&fit=crop',
                'category' => 'Desserts',
                'ingredients' => [
                    ['name' => 'Mascarpone cheese', 'quantity' => '500g'],
                    ['name' => 'Ladyfingers', 'quantity' => '24'],
                    ['name' => 'Espresso', 'quantity' => '1.5 cups'],
                    ['name' => 'Egg yolks', 'quantity' => '4'],
                    ['name' => 'Cocoa powder', 'quantity' => '2 tbsp'],
                ],
            ],

            // ──── SNACKS (2 recipes) ───────────────────────────
            [
                'title' => 'Crispy Mozzarella Sticks',
                'description' => 'Golden-fried mozzarella sticks with a crunchy breadcrumb coating and marinara dip.',
                'instructions' => "1. Cut mozzarella into thick sticks.\n\n2. Set up a breading station: flour, beaten eggs, and seasoned breadcrumbs.\n\n3. Coat each stick in flour, dip in egg, then roll in breadcrumbs. Repeat for a thicker crust.\n\n4. Freeze the sticks for 20 minutes to firm up.\n\n5. Heat oil to 180C (350F) and fry sticks for 2 minutes until golden.\n\n6. Drain on paper towels.\n\n7. Serve hot with warm marinara sauce.",
                'prep_time' => 25, 'cook_time' => 5, 'servings' => 4, 'difficulty' => 'medium',
                'image_path' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?q=80&w=800&auto=format&fit=crop',
                'category' => 'Snacks',
                'ingredients' => [
                    ['name' => 'Mozzarella block', 'quantity' => '400g'],
                    ['name' => 'Breadcrumbs', 'quantity' => '1 cup'],
                    ['name' => 'Eggs', 'quantity' => '2'],
                    ['name' => 'Flour', 'quantity' => '1/2 cup'],
                    ['name' => 'Marinara sauce', 'quantity' => '1/2 cup'],
                ],
            ],
            [
                'title' => 'Homemade Guacamole',
                'description' => 'Fresh and zesty guacamole made with ripe avocados, lime, and cilantro. Perfect with tortilla chips.',
                'instructions' => "1. Cut avocados in half, remove pits, and scoop flesh into a bowl.\n\n2. Mash with a fork to your desired consistency.\n\n3. Dice half a red onion and a tomato finely.\n\n4. Mix in onion, tomato, minced jalapeño, and chopped cilantro.\n\n5. Squeeze in lime juice and season with salt.\n\n6. Taste and adjust seasoning.\n\n7. Serve immediately with tortilla chips.",
                'prep_time' => 10, 'cook_time' => 0, 'servings' => 4, 'difficulty' => 'easy',
                'image_path' => 'https://images.unsplash.com/photo-1600335895229-6e75511892c8?q=80&w=800&auto=format&fit=crop',
                'category' => 'Snacks',
                'ingredients' => [
                    ['name' => 'Avocados', 'quantity' => '3 ripe'],
                    ['name' => 'Lime', 'quantity' => '1'],
                    ['name' => 'Red onion', 'quantity' => '1/2'],
                    ['name' => 'Tomato', 'quantity' => '1 medium'],
                    ['name' => 'Cilantro', 'quantity' => '1 handful'],
                ],
            ],

            // ──── SOUPS (2 recipes) ────────────────────────────
            [
                'title' => 'Creamy Tomato Soup',
                'description' => 'A smooth and velvety tomato soup perfect for a cosy evening, served with crusty bread.',
                'instructions' => "1. Heat butter in a pot over medium heat. Add diced onion and garlic, cook until soft.\n\n2. Add canned crushed tomatoes and vegetable broth. Bring to a boil.\n\n3. Reduce heat and simmer for 20 minutes.\n\n4. Blend the soup until smooth using an immersion blender.\n\n5. Stir in heavy cream, salt, and pepper to taste.\n\n6. Serve hot with crusty bread.",
                'prep_time' => 10, 'cook_time' => 25, 'servings' => 4, 'difficulty' => 'easy',
                'image_path' => 'https://images.unsplash.com/photo-1547592166-23ac45744acd?q=80&w=800&auto=format&fit=crop',
                'category' => 'Soups',
                'ingredients' => [
                    ['name' => 'Crushed tomatoes', 'quantity' => '2 cans'],
                    ['name' => 'Onion', 'quantity' => '1 medium'],
                    ['name' => 'Garlic', 'quantity' => '3 cloves'],
                    ['name' => 'Vegetable broth', 'quantity' => '2 cups'],
                    ['name' => 'Heavy cream', 'quantity' => '1/2 cup'],
                ],
            ],
            [
                'title' => 'Thai Coconut Chicken Soup',
                'description' => 'A fragrant and creamy Thai soup with chicken, coconut milk, lemongrass, and lime.',
                'instructions' => "1. Heat coconut oil in a pot. Add sliced lemongrass, galangal, and chilli.\n\n2. Pour in coconut milk and chicken broth. Bring to a simmer.\n\n3. Add sliced chicken breast and cook for 8 minutes until done.\n\n4. Add mushrooms and cherry tomatoes. Simmer for 3 more minutes.\n\n5. Stir in fish sauce, lime juice, and a pinch of sugar.\n\n6. Garnish with fresh cilantro and sliced chilli.\n\n7. Serve hot with steamed jasmine rice.",
                'prep_time' => 15, 'cook_time' => 15, 'servings' => 4, 'difficulty' => 'medium',
                'image_path' => 'https://images.unsplash.com/photo-1569058242567-93de6f36f8e6?q=80&w=800&auto=format&fit=crop',
                'category' => 'Soups',
                'ingredients' => [
                    ['name' => 'Coconut milk', 'quantity' => '1 can'],
                    ['name' => 'Chicken breast', 'quantity' => '300g'],
                    ['name' => 'Lemongrass', 'quantity' => '2 stalks'],
                    ['name' => 'Fish sauce', 'quantity' => '2 tbsp'],
                    ['name' => 'Lime juice', 'quantity' => '2 tbsp'],
                ],
            ],

            // ──── SALADS (2 recipes) ───────────────────────────
            [
                'title' => 'Greek Salad',
                'description' => 'A bright and refreshing Mediterranean salad with feta, olives, cucumber, and a lemon dressing.',
                'instructions' => "1. Chop cucumber, tomatoes, and red onion into bite-sized pieces.\n\n2. Halve the Kalamata olives.\n\n3. Combine all vegetables in a large bowl.\n\n4. Crumble feta cheese generously over the top.\n\n5. Drizzle with extra virgin olive oil and red wine vinegar.\n\n6. Season with dried oregano, salt, and pepper.\n\n7. Toss gently and serve immediately.",
                'prep_time' => 10, 'cook_time' => 0, 'servings' => 4, 'difficulty' => 'easy',
                'image_path' => 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?q=80&w=800&auto=format&fit=crop',
                'category' => 'Salads',
                'ingredients' => [
                    ['name' => 'Cucumber', 'quantity' => '1 large'],
                    ['name' => 'Tomatoes', 'quantity' => '3 medium'],
                    ['name' => 'Feta cheese', 'quantity' => '150g'],
                    ['name' => 'Kalamata olives', 'quantity' => '1/2 cup'],
                    ['name' => 'Red onion', 'quantity' => '1/2'],
                ],
            ],
            [
                'title' => 'Quinoa Power Bowl',
                'description' => 'A hearty and nutritious bowl packed with quinoa, roasted vegetables, and tahini dressing.',
                'instructions' => "1. Cook quinoa according to package directions and let cool.\n\n2. Roast sweet potato, chickpeas, and red onion at 200C for 25 minutes.\n\n3. Prepare tahini dressing by whisking tahini, lemon juice, garlic, and water.\n\n4. Arrange quinoa in bowls.\n\n5. Top with roasted vegetables, sliced avocado, and fresh spinach.\n\n6. Drizzle generously with tahini dressing.\n\n7. Sprinkle with sesame seeds and serve.",
                'prep_time' => 15, 'cook_time' => 25, 'servings' => 2, 'difficulty' => 'easy',
                'image_path' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=800&auto=format&fit=crop',
                'category' => 'Salads',
                'ingredients' => [
                    ['name' => 'Quinoa', 'quantity' => '1 cup'],
                    ['name' => 'Sweet potato', 'quantity' => '1 medium'],
                    ['name' => 'Chickpeas', 'quantity' => '1 can'],
                    ['name' => 'Tahini', 'quantity' => '3 tbsp'],
                    ['name' => 'Avocado', 'quantity' => '1'],
                ],
            ],

            // ──── VEGAN (2 recipes) ────────────────────────────
            [
                'title' => 'Vegan Pad Thai',
                'description' => 'A vibrant and tangy vegan pad thai with rice noodles, tofu, and a tamarind peanut sauce.',
                'instructions' => "1. Soak rice noodles in hot water for 8 minutes until soft. Drain.\n\n2. Press and cube firm tofu. Pan-fry in oil until golden on all sides.\n\n3. Mix together tamarind paste, soy sauce, maple syrup, and lime juice for the sauce.\n\n4. Stir-fry sliced bell pepper, bean sprouts, and spring onions for 2 minutes.\n\n5. Add noodles and sauce. Toss everything together.\n\n6. Add the tofu and mix gently.\n\n7. Serve topped with crushed peanuts, lime wedges, and fresh cilantro.",
                'prep_time' => 15, 'cook_time' => 10, 'servings' => 2, 'difficulty' => 'medium',
                'image_path' => 'https://images.unsplash.com/photo-1559314809-0d155014e29e?q=80&w=800&auto=format&fit=crop',
                'category' => 'Vegan',
                'ingredients' => [
                    ['name' => 'Rice noodles', 'quantity' => '200g'],
                    ['name' => 'Firm tofu', 'quantity' => '200g'],
                    ['name' => 'Tamarind paste', 'quantity' => '2 tbsp'],
                    ['name' => 'Crushed peanuts', 'quantity' => '1/4 cup'],
                    ['name' => 'Bean sprouts', 'quantity' => '1 cup'],
                ],
            ],
            [
                'title' => 'Roasted Cauliflower Tacos',
                'description' => 'Spiced roasted cauliflower in warm tortillas with avocado crema and pickled onion.',
                'instructions' => "1. Cut cauliflower into small florets.\n\n2. Toss with olive oil, cumin, paprika, chilli powder, salt, and pepper.\n\n3. Roast at 220C (425F) for 25 minutes until charred and tender.\n\n4. Make avocado crema: blend avocado, lime juice, cilantro, and a splash of water.\n\n5. Quick-pickle red onion in lime juice and salt for 10 minutes.\n\n6. Warm corn tortillas in a dry pan.\n\n7. Assemble tacos with cauliflower, crema, pickled onion, and fresh cilantro.",
                'prep_time' => 15, 'cook_time' => 25, 'servings' => 3, 'difficulty' => 'easy',
                'image_path' => 'https://images.unsplash.com/photo-1552332386-f8dd00dc2f85?q=80&w=800&auto=format&fit=crop',
                'category' => 'Vegan',
                'ingredients' => [
                    ['name' => 'Cauliflower', 'quantity' => '1 head'],
                    ['name' => 'Corn tortillas', 'quantity' => '6'],
                    ['name' => 'Avocado', 'quantity' => '1'],
                    ['name' => 'Cumin', 'quantity' => '1 tsp'],
                    ['name' => 'Red onion', 'quantity' => '1/2'],
                ],
            ],

            // ──── GLUTEN-FREE (2 recipes) ──────────────────────
            [
                'title' => 'Garlic Butter Shrimp',
                'description' => 'Juicy shrimp sautéed in a rich garlic butter sauce with lemon and parsley.',
                'instructions' => "1. Peel and devein the shrimp. Pat dry with paper towels.\n\n2. Melt butter in a large skillet over medium-high heat.\n\n3. Add minced garlic and cook for 30 seconds until fragrant.\n\n4. Add shrimp in a single layer. Cook 2 minutes per side until pink.\n\n5. Squeeze fresh lemon juice over the shrimp.\n\n6. Season with salt, pepper, and red pepper flakes.\n\n7. Garnish with chopped parsley and serve with crusty bread.",
                'prep_time' => 10, 'cook_time' => 5, 'servings' => 2, 'difficulty' => 'easy',
                'image_path' => 'https://images.unsplash.com/photo-1599084993091-1cb5c0721cc6?q=80&w=800&auto=format&fit=crop',
                'category' => 'Gluten-Free',
                'ingredients' => [
                    ['name' => 'Large shrimp', 'quantity' => '500g'],
                    ['name' => 'Butter', 'quantity' => '3 tbsp'],
                    ['name' => 'Garlic', 'quantity' => '4 cloves'],
                    ['name' => 'Lemon', 'quantity' => '1'],
                    ['name' => 'Parsley', 'quantity' => '1 handful'],
                ],
            ],
            [
                'title' => 'Lemon Herb Roasted Chicken',
                'description' => 'A juicy whole roasted chicken with zesty lemon, rosemary, and garlic. Naturally gluten-free.',
                'instructions' => "1. Preheat oven to 200C (400F).\n\n2. Pat the chicken dry and season inside and out with salt and pepper.\n\n3. Stuff the cavity with lemon halves, garlic cloves, and fresh rosemary.\n\n4. Rub olive oil and butter over the skin.\n\n5. Place in a roasting pan and roast for 1 hour 15 minutes.\n\n6. Let the chicken rest for 10 minutes before carving.\n\n7. Serve with roasted potatoes and steamed greens.",
                'prep_time' => 15, 'cook_time' => 75, 'servings' => 6, 'difficulty' => 'medium',
                'image_path' => 'https://images.unsplash.com/photo-1598103442097-8b74394b95c6?q=80&w=800&auto=format&fit=crop',
                'category' => 'Gluten-Free',
                'ingredients' => [
                    ['name' => 'Whole chicken', 'quantity' => '1.5 kg'],
                    ['name' => 'Lemons', 'quantity' => '2'],
                    ['name' => 'Garlic', 'quantity' => '1 head'],
                    ['name' => 'Fresh rosemary', 'quantity' => '3 sprigs'],
                    ['name' => 'Butter', 'quantity' => '2 tbsp'],
                ],
            ],
        ];

        foreach ($recipes as $index => $recipeData) {
            $ingredients = $recipeData['ingredients'];
            $categoryName = $recipeData['category'];
            unset($recipeData['ingredients'], $recipeData['category']);

            $recipeData['user_id'] = $userIds[$index % count($userIds)];
            $recipeData['category_id'] = $categories[$categoryName] ?? array_values($categories)[0];
            $recipeData['slug'] = Str::slug($recipeData['title']) . '-' . ($index + 1);
            $recipeData['price'] = rand(3, 18);

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

        $this->command->info('Seeded ' . count($recipes) . ' recipes with ingredients.');
    }
}
