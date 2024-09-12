<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view events']);
        Permission::create(['name' => 'view pendaftar']);
        Permission::create(['name' => 'view member']);
        Permission::create(['name' => 'view absensi']);
        Permission::create(['name' => 'view peserta']);
        Permission::create(['name' => 'view qrcode']);
        Permission::create(['name' => 'reminder pembayaran']);
        Permission::create(['name' => 'read all_users']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('view pendaftar');
        $role->givePermissionTo('view peserta');
        $role->givePermissionTo('view qrcode');

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}
