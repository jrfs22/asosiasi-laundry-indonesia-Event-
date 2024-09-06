<?php

namespace Database\Seeders;

use App\Models\ReferralsModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferralsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ReferralsModel::factory()->count(50)->create();
    }
}
