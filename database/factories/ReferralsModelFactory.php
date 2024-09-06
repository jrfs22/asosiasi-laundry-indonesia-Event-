<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReferralsModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'referrer_id' => User::inRandomOrder()->first()->id,
            'referred_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
