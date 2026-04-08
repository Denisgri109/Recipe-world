<?php

namespace Database\Factories;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    protected $model = Ingredient::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ingredients = [
            'flour', 'sugar', 'salt', 'pepper', 'olive oil', 'butter', 'garlic',
            'onion', 'tomato', 'chicken breast', 'ground beef', 'milk', 'eggs',
            'cheddar cheese', 'mozzarella', 'parmesan', 'basil', 'oregano',
            'paprika', 'cumin', 'cinnamon', 'vanilla extract', 'baking powder',
            'lemon juice', 'soy sauce', 'honey', 'rice', 'pasta', 'bell pepper',
            'mushrooms', 'spinach', 'broccoli', 'carrots', 'potatoes', 'cream',
        ];

        $quantities = [
            '1 cup', '2 cups', '1/2 cup', '1/4 cup', '1 tbsp', '2 tbsp',
            '1 tsp', '1/2 tsp', '1/4 tsp', '3 cloves', '1 large', '2 medium',
            '200g', '500g', '1 kg', '250ml', '100ml', 'a pinch of', '1 handful',
        ];

        return [
            'recipe_id' => Recipe::factory(),
            'name' => $this->faker->randomElement($ingredients),
            'quantity' => $this->faker->randomElement($quantities),
            'order' => $this->faker->numberBetween(1, 10),
        ];
    }
}
