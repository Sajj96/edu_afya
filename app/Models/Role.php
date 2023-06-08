<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{

    public static function updatePermissions() {
        $permissionsList = PermissionSet::permissions();
        foreach ($permissionsList as $key=>$value) {
            Permission::firstOrCreate(['name' => $value]);
        }
    }

    public static function setDefaultRoles() {
        //Update permissions
        self::updatePermissions();

        //Admin Role
        $admin = Role::firstOrCreate(['name' => User::ROLE_ADMIN]);
        $admin->syncPermissions(Permission::all());
    }
}
