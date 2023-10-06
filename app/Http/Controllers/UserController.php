<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    // public function index()
    // {
    //     $roles = Role::with('permissions')->get();

    //     return Inertia::render('RolePermission/Index', [
    //         'roles' => $roles,
    //     ]);
    // }    

    public function index()
    {
        $users = User::with('roles', 'permissions')->paginate(10); // Adjust the number of users per page as needed
    
        return Inertia::render('Users/Index', [
            'users' => $users,
        ]);
    }
    
    




    public function edit(User $user)
    {
        // Get the user's roles and permissions
        $userRoles = $user->roles()->with('permissions')->get();
    
        // Get all roles and permissions for reference
        $roles = Role::with('permissions')->get();
    
        return Inertia::render('Users/Show', [
            'user' => $user,
            'userRoles' => $userRoles,
            'roles' => $roles,
        ]);
    }
    
    


    public function updatePermissions(Request $request)
    {
        // Validate the request data
        $request->validate([
            'roles.*.id' => 'required|exists:roles,id',
            'permissions.*' => 'nullable|exists:permissions,id',
        ]);

        // Process and update permissions for each role
        foreach ($request->input('roles') as $roleData) {
            $role = Role::find($roleData['id']);
            $role->syncPermissions($roleData['permissions']);
        }

        return redirect()->back()->with('success', 'Permissions updated successfully.');
    }
}
