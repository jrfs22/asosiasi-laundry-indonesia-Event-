<?php

namespace Database\Seeders;

use App\Models\EventsModel;
use App\Models\RegistrationModel;
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
            RegistrationModel::factory()->count(1)->state([
                'event_id' => $event->id
            ])->create();
        }
    }
}
