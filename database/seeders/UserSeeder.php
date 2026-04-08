<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's users.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Denis Murphy',
                'email' => 'denis@example.com',
            ],
            [
                'name' => 'Roman Kovac',
                'email' => 'roman@example.com',
            ],
            [
                'name' => 'Emma Byrne',
                'email' => 'emma@example.com',
            ],
            [
                'name' => 'Liam Doyle',
                'email' => 'liam@example.com',
            ],
            [
                'name' => 'Saoirse Kelly',
                'email' => 'saoirse@example.com',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}
