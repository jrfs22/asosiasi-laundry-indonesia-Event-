<?php

namespace Database\Seeders;

use App\Models\RewardHistoriesModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RewardHistoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RewardHistoriesModel::factory()->count(50)->create();
    }
}
