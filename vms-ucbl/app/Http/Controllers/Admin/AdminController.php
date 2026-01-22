<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function dashboard(){
        return view('vms.backend.admin.admin_dashboard');
    }

    public function createRole(){
        return view('vms.backend.admin.Addrole');
    }

    public function storeRole(Request $request){
        $request->validate([
            'role_name' => 'required|string|unique:roles,name|max:255',
            'description' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive,restricted',
        ]);

        $role = Role::create([
            'name' => $request->role_name,
        ]);

        // If permissions are selected, sync them to the role
        if ($request->has('permissions')) {
            $permissions = [];

            if (in_array('dashboard', $request->permissions)) {
                $permissions[] = Permission::firstOrCreate(['name' => 'view dashboard']);
            }
            if (in_array('users', $request->permissions)) {
                $permissions[] = Permission::firstOrCreate(['name' => 'manage users']);
            }
            if (in_array('roles', $request->permissions)) {
                $permissions[] = Permission::firstOrCreate(['name' => 'manage roles']);
            }
            if (in_array('reports', $request->permissions)) {
                $permissions[] = Permission::firstOrCreate(['name' => 'view reports']);
            }
            if (in_array('audit', $request->permissions)) {
                $permissions[] = Permission::firstOrCreate(['name' => 'view audit logs']);
            }
            if (in_array('settings', $request->permissions)) {
                $permissions[] = Permission::firstOrCreate(['name' => 'manage settings']);
            }

            $role->syncPermissions($permissions);
        }

        return redirect()->route('admin.role.create')
            ->with('success', 'Role "' . $request->role_name . '" created successfully!');
    }

    public function createAssignRole(){
        $users = User::all();
        $roles = Role::all();
        return view('vms.backend.admin.Assignrole', compact('users', 'roles'));
    }

    public function storeAssignRole(Request $request){
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
            'effective_date' => 'nullable|date',
            'status' => 'required|in:active,pending,restricted',
            'remarks' => 'nullable|string|max:500',
        ]);

        $user = User::find($request->user_id);
        $role = Role::find($request->role_id);

        // Remove existing roles and assign new one
        $user->syncRoles([$role->id]);

        // Log the assignment (optional - you might want to create a role_assignments table)
        // For now, we'll just return success

        return redirect()->route('admin.role.assign.create')
            ->with('success', 'Role "' . $role->name . '" assigned to ' . $user->name . ' successfully!');
    }

    public function removeUserRole(Request $request){
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);
        $roles = $user->getRoleNames();
        $user->removeRole($roles->first());

        return redirect()->route('admin.role.assign.create')
            ->with('success', 'Role removed from ' . $user->name . ' successfully!');
    }
}
