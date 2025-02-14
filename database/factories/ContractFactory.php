<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date_start' => fake()->date(),
            'date_end' => fake()->dateTimeBetween($startDate = '+1 month', $endDate = '+2 years')->format('Y-m-d'),
            'price' => fake()->optional()->randomFloat(2, 100, 1000),
            'tenant_id' => fake()->numberBetween(1, 3),
            'box_id' => fake()->numberBetween(1, 6),
            'contract_model_id' => fake()->numberBetween(1, 1),
        ];
    }
}
