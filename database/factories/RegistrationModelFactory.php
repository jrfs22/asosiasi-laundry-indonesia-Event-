<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RegistrationModel>
 */
class RegistrationModelFactory extends Factory
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
            'phone_number' => '087893504595',
            'email' => fake()->safeEmail(),
            'tickets' => fake()->randomDigit(),
            'amount' => fake()->numberBetween(1000000, 20000000),
            'discount_percentage' => fake()->numberBetween(1, 100),
            'discount_total' => fake()->numberBetween(100000, 500000),
            'source' => fake()->randomElement(['teman', 'instagram', 'facebook']),
            'member' => fake()->randomElement(['ya', 'tidak'])
        ];
    }
}
