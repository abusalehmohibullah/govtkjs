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
        $users = User::with('roles', 'roles.permissions', 'permissions')->paginate(10);

        // Initialize empty arrays for extras and restrictions
        $extras = [];
        $restrictions = [];

        foreach ($users as $user) {
            foreach ($user->permissions as $permission) {
                $foundInRoles = false;

                foreach ($user->roles as $role) {
                    if ($role->permissions->contains('id', $permission->id)) {
                        $foundInRoles = true;
                        break;
                    }
                }

                if ($foundInRoles) {
                    $restrictions[] = $permission->name;
                } else {
                    $extras[] = $permission->name;
                }
            }

            // Add extras and restrictions to the user
            $user->extras = $extras;
            $user->restrictions = $restrictions;

            // Reset the extras and restrictions arrays for the next user
            $extras = [];
            $restrictions = [];
        }

        return Inertia::render('Users/Index', [
            'users' => $users,
        ]);
    }



    public function edit(User $user)
    {
        // Get the user's roles and permissions
        $userRoles = $user->roles()->with('permissions')->get();

        // Extract user's permissions into a flat array
        $userPermissions = $userRoles->flatMap(function ($userRole) {
            return $userRole->permissions;
        })->pluck('id')->toArray();

        // Get permissions associated with the user in model_has_permissions
        $modelHasPermissions = $user->permissions->pluck('id')->toArray();

        // Exclude direct permissions that exist in user's roles
        $userPermissions = array_diff($userPermissions, $modelHasPermissions);

        // Get all permissions from the roles
        $allPermissions = $userRoles->flatMap(function ($userRole) {
            return $userRole->permissions;
        })->pluck('id')->toArray();

        // Include direct permissions if they don't exist in user's roles
        $userPermissions = array_merge($userPermissions, array_diff($modelHasPermissions, $allPermissions));

        // Get user's roles for reference
        $roles = Role::with('permissions')->get();

        return Inertia::render('Users/Show', [
            'user' => $user,
            'userRoles' => $userRoles,
            'roles' => $roles,
            'userPermissions' => $userPermissions,
        ]);
    }


    public function update(Request $request, User $user)
    {
        // Step 1: Get the selected roles and permissions from the request
        $selectedRoles = $request->input('selectedRoles', []);
        $selectedPermissions = $request->input('selectedPermissions', []);

        // Step 2: Get the not selected roles
        $notSelectedRoles = Role::whereNotIn('id', $selectedRoles)->pluck('id')->toArray();

        // Step 3: Get permissions for not selected roles
        $permissionsForNotSelectedRoles = Role::with('permissions')
            ->whereIn('id', $notSelectedRoles)
            ->get()
            ->pluck('permissions.*.id')
            ->flatten()
            ->toArray();

        // Step 4: Get permissions for selected roles
        $permissionsForSelectedRoles = Role::with('permissions')
            ->whereIn('id', $selectedRoles)
            ->get()
            ->pluck('permissions.*.id')
            ->flatten()
            ->toArray();

        // dd($permissionsForSelectedRoles, $selectedPermissions);
        // Step 5: Get common permissions
        // $commonPermissions = array_intersect($permissionsForSelectedRoles, $selectedPermissions);

        // Step 6: Get permissions in selected roles but not in selected permissions
        $restrictions = array_diff($permissionsForSelectedRoles, $selectedPermissions);

        // Step 7: Get permissions in not selected roles but in selected permissions
        $extras = array_intersect($permissionsForNotSelectedRoles, $selectedPermissions);

        $permissionsToAdd = array_merge($restrictions, $extras);

        // dd($permissionsToRemove);
        // Step 8: Remove common permissions from the user
        // $user->permissions()->detach($commonPermissions);

        // Step 9: Add permissions from permissionsToAdd
        // $user->permissions()->attach($permissionsToAdd);

        // Step 10: Remove permissions from permissionsToRemove
        // $user->permissions()->detach($permissionsToRemove);

        // Optionally, you can also update the user's roles.
        // Example:
        $user->roles()->sync($selectedRoles);
        $user->permissions()->sync($permissionsToAdd);

        return redirect()->route('admin.users.index')
            ->with('flash.banner', 'Roles and permissions updated successfully.');
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
