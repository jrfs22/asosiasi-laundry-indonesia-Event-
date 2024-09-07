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
            'tickets' => fake()->randomDigit(),
            'amount' => fake()->numberBetween(1000000, 20000000),
            'discount' => fake()->numberBetween(100000, 500000),
            'payment_status' => fake()->randomElement(['progress', 'selesai']),
            'qrcode' => fake()->name()
        ];
    }
}
