<?php

namespace Database\Seeders;

use App\Models\ParticipantsModel;
use App\Models\RegistrationModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParticipantsModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RegistrationModel::all() as $regist) {
            ParticipantsModel::factory()->count(3)->state([
                'registration_id' => $regist->id
            ])->create();
        }
    }
}
