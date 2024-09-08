<?php

namespace Database\Seeders;

use App\Models\EventsModel;
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
            $event = EventsModel::inRandomOrder()->first();
            ParticipantsModel::factory()->count(1)->state([
                'registration_id' => $regist->id,
                'event_id' => $event->id
            ])->create();
        }
    }
}
