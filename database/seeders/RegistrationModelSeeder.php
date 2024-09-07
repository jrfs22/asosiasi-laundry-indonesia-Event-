<?php

namespace Database\Seeders;

use App\Models\EventsModel;
use App\Models\ParticipantsModel;
use App\Models\RegistrationModel;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistrationModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (EventsModel::all() as $event) {
            $user = ParticipantsModel::inRandomOrder()->first();
            RegistrationModel::factory()->count(1)->state([
                'event_id' => $event->id,
                'participant_id' => $user->id
            ])->create();
        }
    }
}
