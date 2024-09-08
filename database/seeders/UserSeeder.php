<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Role::all() as $role) {
            $users = User::factory()->count(1)->create();
            $users->each(function ($user) use ($role) {
                $user->assignRole($role);
            });
        }
    }
}
