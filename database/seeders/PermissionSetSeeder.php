<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use App\Models\Role;
use App\Models\PermissionSet;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionsList = PermissionSet::permissions();
        foreach ($permissionsList as $key=>$value) {
            Permission::firstOrCreate(['name' => $value]);
        }

        //Default Role
        //Admin
        $admin = Role::firstOrCreate(['name' => User::ROLE_SUPER_ADMIN]);
        $admin->syncPermissions(Permission::all());
    }
}
