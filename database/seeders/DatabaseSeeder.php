<?php

namespace Database\Seeders;

use App\Models\EventsModel;
use App\Models\ParticipantsModel;
use App\Models\RegistrationModel;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            EventsModelSeeder::class,
            RegistrationModelSeeder::class,
            ParticipantsModelSeeder::class,
            MembersModelSeeder::class
        ]);
    }
}
