<?php

namespace Database\Seeders;

use App\Models\MembersModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembersModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MembersModel::factory()->count(10)->create();
    }
}
