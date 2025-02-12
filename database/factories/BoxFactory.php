<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BoxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->sentence(),
            'adress' => fake()->address(),
            'price' => fake()->randomFloat(2, 1, 100),
            'user_id' => fake()->numberBetween(1, 1),
            'tenant_id' => fake()->numberBetween(1, 3),
        ];
    }
}
