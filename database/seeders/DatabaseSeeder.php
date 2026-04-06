<?php

namespace Database\Seeders;

use App\Models\User;
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
        $this->call(CategorySeeder::class);

        // 3. Seed Recipes (with ingredients)
        $this->call(RecipeSeeder::class);
    }
}
