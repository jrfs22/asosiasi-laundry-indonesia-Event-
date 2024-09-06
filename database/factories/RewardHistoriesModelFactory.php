<?php

namespace Database\Factories;

use App\Models\RewardsModel;
use App\Models\ReferralsModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RewardHistoriesModel>
 */
class RewardHistoriesModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reward_id' => RewardsModel::inRandomOrder()->first()->id,
            'referral_id' => ReferralsModel::inRandomOrder()->first()->id,
        ];
    }
}
