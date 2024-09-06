<?php

namespace Database\Seeders;

use App\Models\RewardsModel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (User::all() as $user) {
            RewardsModel::create([
                'user_id' => $user->id,
                'total_points' => 0, // Default value
            ]);
        }
    }
}
