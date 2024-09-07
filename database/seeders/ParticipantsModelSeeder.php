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
        foreach (EventsModel::all() as $event) {
            ParticipantsModel::factory()->count(3)->state([
                'event_id' => $event->id
            ])->create();
        }
    }
}
