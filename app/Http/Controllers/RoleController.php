<?php

namespace App\Http\Controllers;

use App\Models\PermissionSet;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index () {
        $roles = Role::get();
        return view('pages.users.roles.index',[
            'roles' => $roles
        ]);
    }

    public function add(Request $request) {
        if ($request->method() == 'GET') {
            $permissions = PermissionSet::permissionsGroups();
            return view('pages.users.roles.add',[
                'permissions' => $permissions
            ]);
        }

        try {
            $role = Role::create([
                'name' => ucfirst($request->name)
            ], ['name' => 'required']);
            if ($role) {
                if (count($request->permissions) > 0) {
                    $permissions =[];
                    foreach($request->permissions as $permission_name){
                        $permissions[] = Permission::firstOrCreate([
                            'name' => $permission_name
                        ]);
                    }
                    $role->syncPermissions($permissions);
                }else {
                    return back()->withError('You must select permission(s) for the role');
                }
            }

            Log::info("Added a role");
            return redirect('/roles')->withSuccess('Role added successfully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->withError('An error has occurred failed to add a new role');
        }
    }

    public function edit(Request $request, $id=null) {
        if (empty($id) && $request->has('id')){
            $id = $request->id;
        }

        $role = Role::find($id);
        if (!$role) {
            return back()->withError('Role not found');
        }

        if ($request->method() == 'GET') {
            $permissions = PermissionSet::permissionsGroups();
            $rolePermissions = $role->permissions()->pluck('name')->toArray();

            return view('pages.users.roles.edit',[
                'permissions' => $permissions,
                'role' => $role,
                'rolePermissions' => $rolePermissions
            ]);
        }

        try {
            $role->name = strtolower($request->name);
            if ($role->update() && count($request->permissions) > 0) {
                $permissions =[];
                foreach($request->permissions as $permission_name){
                    $permissions[] = Permission::updateOrCreate(
                        [
                            'name' => $permission_name
                        ],
                        [
                            'name' => $permission_name
                        ]
                    );
                }
                $role->syncPermissions($permissions);
            }else {
                return back()->withError('You must select permissions');
            }

            Log::info("Edited a role");
            return redirect('/roles')->withSuccess('Role edited successfully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->withError('An error has occurred failed to update role');
        }
    }

    public function deleteRole(Request $request) {
        try {
            if ($request->has('role_id')) {
                $role = Role::find($request->input('role_id'));
                if ($role) {
                    $role->revokePermissionTo(Permission::all());
                    $role->delete();
                    Log::info("Deleted a role");
                    return redirect('/roles')->withSuccess('Role Deleted');
                }
            }
        } catch(\Exception $exception) {
            Log::error($exception->getMessage());
        }
        return redirect('/roles')->withError('Role could not be deleted');
    }
}
