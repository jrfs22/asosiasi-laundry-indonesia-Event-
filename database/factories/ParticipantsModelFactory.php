<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ParticipantsModel>
 */
class ParticipantsModelFactory extends Factory
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
            'laundry_name' => fake()->name(),
            'phone_number' => '087893504595',
            'certificate_name' => fake()->name(),
            'type' => fake()->randomElement(['member', 'non member']),
            'qrcode' => 'josep-ronaldo-francis-siregar.svg',
        ];
    }
}
