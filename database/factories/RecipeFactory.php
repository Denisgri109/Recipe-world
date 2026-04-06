<?php

namespace Database\Factories;

use App\Models\Recipe;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $recipes = [
            [
                'title' => 'Classic Spaghetti Bolognese',
                'description' => 'A rich and hearty Italian pasta dish with a slow-cooked meat sauce.',
                'instructions' => "1. Heat olive oil in a large pan over medium heat.\n\n2. Add diced onion, garlic, carrot, and celery. Cook for 5 minutes until softened.\n\n3. Add the ground beef and cook until browned, breaking it apart.\n\n4. Pour in the crushed tomatoes and tomato paste. Stir well.\n\n5. Season with salt, pepper, oregano, and basil.\n\n6. Simmer on low heat for 30 minutes, stirring occasionally.\n\n7. Cook spaghetti according to package directions. Drain and serve topped with the sauce.",
            ],
            [
                'title' => 'Chicken Caesar Salad',
                'description' => 'A crisp and refreshing salad with grilled chicken, croutons, and Caesar dressing.',
                'instructions' => "1. Season chicken breasts with salt, pepper, and olive oil.\n\n2. Grill chicken for 6 minutes per side until fully cooked. Let rest, then slice.\n\n3. Wash and chop romaine lettuce into bite-sized pieces.\n\n4. Toss lettuce with Caesar dressing.\n\n5. Top with sliced chicken, croutons, and shaved parmesan cheese.\n\n6. Serve immediately.",
            ],
            [
                'title' => 'Fluffy Banana Pancakes',
                'description' => 'Light and fluffy pancakes with ripe banana folded into the batter.',
                'instructions' => "1. Mash two ripe bananas in a mixing bowl.\n\n2. Add eggs, milk, melted butter, and vanilla extract. Whisk together.\n\n3. In a separate bowl, combine flour, sugar, baking powder, and salt.\n\n4. Fold the dry ingredients into the wet mixture until just combined.\n\n5. Heat a non-stick pan over medium heat. Pour 1/4 cup batter per pancake.\n\n6. Cook until bubbles form on the surface, then flip and cook 2 more minutes.\n\n7. Serve with maple syrup and fresh berries.",
            ],
            [
                'title' => 'Creamy Tomato Soup',
                'description' => 'A smooth and velvety tomato soup perfect for a cosy evening.',
                'instructions' => "1. Heat butter in a pot over medium heat. Add diced onion and garlic, cook until soft.\n\n2. Add canned crushed tomatoes and vegetable broth. Bring to a boil.\n\n3. Reduce heat and simmer for 20 minutes.\n\n4. Blend the soup until smooth using an immersion blender.\n\n5. Stir in heavy cream, salt, and pepper to taste.\n\n6. Serve hot with crusty bread.",
            ],
            [
                'title' => 'Grilled Cheese Sandwich',
                'description' => 'A golden, crispy sandwich with perfectly melted cheese inside.',
                'instructions' => "1. Butter two slices of bread on one side each.\n\n2. Place one slice butter-side down in a hot pan.\n\n3. Layer cheddar and mozzarella cheese on top.\n\n4. Place the second slice on top, butter-side up.\n\n5. Cook on medium-low heat for 3 minutes until golden, then flip.\n\n6. Cook the other side for 3 minutes until cheese is fully melted.\n\n7. Cut in half and serve.",
            ],
            [
                'title' => 'Beef Stir-Fry with Vegetables',
                'description' => 'A quick and flavourful stir-fry with tender beef strips and fresh vegetables.',
                'instructions' => "1. Slice beef into thin strips and marinate with soy sauce, garlic, and cornstarch for 15 minutes.\n\n2. Heat oil in a wok over high heat.\n\n3. Cook the beef strips for 2 minutes until browned. Remove and set aside.\n\n4. Add sliced bell peppers, broccoli, and snap peas to the wok. Stir-fry for 3 minutes.\n\n5. Return the beef to the wok. Add soy sauce, sesame oil, and a pinch of sugar.\n\n6. Toss everything together and serve over steamed rice.",
            ],
            [
                'title' => 'Classic Margherita Pizza',
                'description' => 'A simple and delicious pizza with tomato sauce, mozzarella, and fresh basil.',
                'instructions' => "1. Preheat oven to 220C (425F).\n\n2. Roll out pizza dough on a floured surface into a round shape.\n\n3. Spread tomato sauce evenly over the base, leaving a small border.\n\n4. Tear fresh mozzarella and scatter over the sauce.\n\n5. Drizzle with olive oil and season with salt.\n\n6. Bake for 12 to 15 minutes until the crust is golden and cheese is bubbly.\n\n7. Top with fresh basil leaves before serving.",
            ],
            [
                'title' => 'Chocolate Chip Cookies',
                'description' => 'Chewy and golden cookies loaded with chocolate chips.',
                'instructions' => "1. Preheat oven to 180C (350F). Line a baking tray with parchment paper.\n\n2. Cream together butter and sugar until light and fluffy.\n\n3. Beat in eggs one at a time, then add vanilla extract.\n\n4. Mix in flour, baking soda, and salt until a dough forms.\n\n5. Fold in chocolate chips.\n\n6. Scoop tablespoon-sized balls of dough onto the tray, spacing them apart.\n\n7. Bake for 10 to 12 minutes until edges are golden. Cool on the tray for 5 minutes.",
            ],
            [
                'title' => 'Vegetable Fried Rice',
                'description' => 'A quick fried rice packed with colourful vegetables and soy flavour.',
                'instructions' => "1. Cook rice and let it cool completely (day-old rice works best).\n\n2. Heat sesame oil in a large pan or wok over high heat.\n\n3. Add diced carrots, peas, corn, and spring onions. Stir-fry for 3 minutes.\n\n4. Push vegetables to the side. Scramble two eggs in the empty space.\n\n5. Add the cold rice and toss everything together.\n\n6. Season with soy sauce and white pepper.\n\n7. Serve hot, garnished with sliced spring onions.",
            ],
            [
                'title' => 'Lemon Herb Roasted Chicken',
                'description' => 'A juicy whole roasted chicken with zesty lemon and fresh herbs.',
                'instructions' => "1. Preheat oven to 200C (400F).\n\n2. Pat the chicken dry and season inside and out with salt and pepper.\n\n3. Stuff the cavity with lemon halves, garlic cloves, and fresh rosemary.\n\n4. Rub olive oil and butter over the skin.\n\n5. Place in a roasting pan and roast for 1 hour 15 minutes.\n\n6. Let the chicken rest for 10 minutes before carving.\n\n7. Serve with roasted potatoes and steamed greens.",
            ],
            [
                'title' => 'Berry Smoothie Bowl',
                'description' => 'A thick and creamy smoothie bowl topped with fresh fruit and granola.',
                'instructions' => "1. Blend frozen mixed berries, a banana, and a splash of milk until thick and smooth.\n\n2. Pour into a bowl.\n\n3. Top with sliced banana, fresh strawberries, blueberries, and granola.\n\n4. Drizzle with honey and sprinkle chia seeds on top.\n\n5. Serve immediately.",
            ],
            [
                'title' => 'Garlic Butter Shrimp',
                'description' => 'Juicy shrimp sauteed in a rich garlic butter sauce.',
                'instructions' => "1. Peel and devein the shrimp. Pat dry with paper towels.\n\n2. Melt butter in a large skillet over medium-high heat.\n\n3. Add minced garlic and cook for 30 seconds until fragrant.\n\n4. Add shrimp in a single layer. Cook 2 minutes per side until pink.\n\n5. Squeeze fresh lemon juice over the shrimp.\n\n6. Season with salt, pepper, and red pepper flakes.\n\n7. Garnish with chopped parsley and serve with crusty bread.",
            ],
            [
                'title' => 'Mushroom Risotto',
                'description' => 'A creamy Italian risotto with earthy mushrooms and parmesan.',
                'instructions' => "1. Heat vegetable broth in a saucepan and keep it warm on low.\n\n2. In a separate pan, melt butter and cook diced onion until translucent.\n\n3. Add sliced mushrooms and cook for 5 minutes.\n\n4. Add arborio rice and stir for 1 minute to toast the grains.\n\n5. Add white wine and stir until absorbed.\n\n6. Ladle in warm broth one cup at a time, stirring constantly and waiting for each addition to absorb.\n\n7. Stir in parmesan cheese and season with salt and pepper. Serve immediately.",
            ],
            [
                'title' => 'Avocado Toast with Poached Egg',
                'description' => 'Crunchy toast topped with creamy avocado and a perfectly poached egg.',
                'instructions' => "1. Toast two slices of sourdough bread until golden.\n\n2. Mash a ripe avocado with a fork. Season with salt, pepper, and lemon juice.\n\n3. Spread the mashed avocado onto the toast.\n\n4. Bring a pot of water to a gentle simmer. Add a splash of vinegar.\n\n5. Crack an egg into a small cup and gently slide it into the water.\n\n6. Poach for 3 to 4 minutes. Remove with a slotted spoon.\n\n7. Place the egg on the avocado toast. Season with chilli flakes and serve.",
            ],
            [
                'title' => 'Honey Garlic Salmon',
                'description' => 'Baked salmon fillets glazed with a sweet and savoury honey garlic sauce.',
                'instructions' => "1. Preheat oven to 200C (400F).\n\n2. Place salmon fillets on a lined baking tray.\n\n3. Mix together honey, soy sauce, minced garlic, and lemon juice.\n\n4. Brush the glaze generously over each fillet.\n\n5. Bake for 12 to 15 minutes until the salmon flakes easily.\n\n6. Garnish with sesame seeds and sliced spring onions.\n\n7. Serve with steamed rice and vegetables.",
            ],
            [
                'title' => 'Classic French Omelette',
                'description' => 'A silky smooth French omelette with a creamy, just-set centre.',
                'instructions' => "1. Crack three eggs into a bowl and whisk until smooth.\n\n2. Season with salt and pepper.\n\n3. Melt butter in a non-stick pan over medium-low heat.\n\n4. Pour in the eggs and stir gently with a spatula.\n\n5. When the eggs are mostly set but still slightly wet, stop stirring.\n\n6. Fold the omelette in thirds and slide onto a plate.\n\n7. Serve with fresh herbs and toast.",
            ],
            [
                'title' => 'Crispy Fish Tacos',
                'description' => 'Crunchy battered fish in warm tortillas with tangy slaw and lime.',
                'instructions' => "1. Cut white fish fillets into strips.\n\n2. Mix flour, paprika, garlic powder, salt, and pepper. Coat the fish strips.\n\n3. Heat oil in a deep pan. Fry the fish for 3 minutes per side until golden and crispy.\n\n4. Drain on paper towels.\n\n5. Mix shredded cabbage, lime juice, and mayonnaise for the slaw.\n\n6. Warm small flour tortillas in a dry pan.\n\n7. Assemble tacos: tortilla, fish, slaw, sliced avocado, and a squeeze of lime.",
            ],
            [
                'title' => 'Homemade Beef Burgers',
                'description' => 'Juicy homemade beef burgers with all the classic toppings.',
                'instructions' => "1. Mix ground beef with diced onion, garlic, salt, pepper, and Worcestershire sauce.\n\n2. Shape into 4 even patties, slightly larger than the bun size.\n\n3. Press a small indent in the centre of each patty to prevent puffing.\n\n4. Grill or pan-fry over high heat for 4 minutes per side for medium doneness.\n\n5. Place a slice of cheese on top during the last minute of cooking.\n\n6. Toast the burger buns.\n\n7. Assemble: bun, lettuce, tomato, patty, pickles, ketchup, and mustard.",
            ],
        ];

        $recipe = $this->faker->randomElement($recipes);

        return [
            'user_id' => User::factory(),
            'category_id' => Category::inRandomOrder()->value('id') ?? Category::create(['name' => 'Uncategorised'])->id,
            'title' => $recipe['title'],
            'description' => $recipe['description'],
            'instructions' => $recipe['instructions'],
            'prep_time' => $this->faker->numberBetween(5, 60),
            'cook_time' => $this->faker->numberBetween(10, 120),
            'servings' => $this->faker->numberBetween(1, 8),
            'difficulty' => $this->faker->randomElement(['easy', 'medium', 'hard']),
        ];
    }
}
