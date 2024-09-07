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
        // User::insert([
        //     [
        //         'name' => 'Admin amin',
        //         'email' => 'amin@admin.com',
        //         'password' => Hash::make('123'),
        //         'role' => 'admin'
        //     ],
        //     [
        //         'name' => 'User Amin',
        //         'email' => 'amin@user.com',
        //         'password' => Hash::make('123'),
        //         'role' => 'user'
        //     ],
        // ]);

        MembersModel::insert([
            [
                'name' => 'Josep Ronaldo Francis Siregar',
                'phone_number' => '087893504595',
                'type' => 'Pengurus'
            ],
        ]);
    }
}
