<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\EventsModel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventsModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (User::all() as $user) {
            EventsModel::factory()->count(1)->state([
                'user_id' => $user->id
            ])->create();
        }
    }
}
