<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Box;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@test.fr',
            'password' => 'test',
        ]);

        Box::factory()->create([
            'name' => 'Box 1',
            'description' => 'Description of Box 1',
            'adress' => '1 rue de la Paix',
            'price' => 10.00,
            'user_id' => 1,
        ]);

        Box::factory()->create([
            'name' => 'Box 2',
            'description' => 'Description of Box 2',
            'adress' => '2 rue de la Paix',
            'price' => 20.00,
            'user_id' => 1,
        ]);
    }
}
