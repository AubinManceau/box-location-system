<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Box;
use App\Models\Tenant;
use App\Models\ContractModel;
use App\Models\Contract;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@test.fr',
            'password' => 'test',
        ]);

        Tenant::factory(3)->create();

        Box::factory(6)->create();

        ContractModel::factory(1)->create();

        Contract::factory(2)->create();

    }
}
