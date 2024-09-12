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
    public function run(): void
    {
        $this->call([
            RolesAndPermissionSeeder::class,
            UserSeeder::class,
            EventsModelSeeder::class,
            RegistrationModelSeeder::class,
            ParticipantsModelSeeder::class,
            MembersModelSeeder::class
        ]);
    }
}
