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
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'category_id' => Category::inRandomOrder()->value('id') ?? Category::create(['name' => $this->faker->unique()->word()])->id,
            'title' => rtrim($this->faker->sentence(4), '.'),
            'description' => $this->faker->text(200),
            'instructions' => implode("\n\n", $this->faker->paragraphs(3)),
            'prep_time' => $this->faker->numberBetween(5, 60),
            'cook_time' => $this->faker->numberBetween(10, 120),
            'servings' => $this->faker->numberBetween(1, 8),
            'difficulty' => $this->faker->randomElement(['easy', 'medium', 'hard']),
        ];
    }
}
