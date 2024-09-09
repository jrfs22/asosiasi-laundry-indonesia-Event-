<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'ASLI',
                'email' => 'asli@gmail.com',
                'password' => Hash::make('aslibanget123$')
            ],
            [
                'name' => 'Sahid Rahim',
                'email' => 'sahid@gmail.com',
                'password' => Hash::make('inipassworduntuksuperadmin123$')
            ]
        ];

        foreach (Role::all() as $key => $role) {
            $users = User::factory()->count(1)->state([
                'name' => $data[$key]['name'],
                'email' => $data[$key]['email'],
                'password' => $data[$key]['password'],
            ])->create();
            $users->each(function ($user) use ($role) {
                $user->assignRole($role);
            });
        }
    }
}
