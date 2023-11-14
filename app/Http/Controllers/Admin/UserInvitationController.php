<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\UserInvitation;
use App\Models\Admin\InvitedUserRole;
use App\Models\Admin\InvitedUserPermission;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
use App\Mail\UserInvitationEmail;

class UserInvitationController extends Controller
{

    public function index()
    {
        $users = UserInvitation::with('roles', 'roles.permissions', 'permissions')->paginate(10);
        // dd($users);
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

        return Inertia::render('Admin/UserInvitations/Index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        // Get user's roles for reference
        $roles = Role::with('permissions')->get();

        return Inertia::render('Admin/UserInvitations/Create', [
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'email' => 'required|email',
                'designation' => 'nullable',
            ]);

            $invitation = UserInvitation::where('email', $request->email)->first();

            if ($invitation && $invitation->status == 'pending') {
                // Invitation already exists in pending status, resend email logic  
                DB::rollBack(); // Rollback the transaction
                return redirect()->back()->with('flash.banner', 'Invitation already pending.')->with('flash.bannerStyle', 'danger');
            }

            $existingUser = User::where('email', $request->email)->first();

            if ($existingUser) {
                // User already exists, show a message
                DB::rollBack(); // Rollback the transaction
                return redirect()->back()->with('flash.banner', 'User already exists with this email.')->with('flash.bannerStyle', 'danger');
            }

            $token = Str::random(32);

            // Set expiration time (adjust the hours as needed)
            $expiresAt = Carbon::now()->addHours(48); // Example: expiration after 48 hours

            // Create a new invitation
            $newInvitation = UserInvitation::create([
                'email' => $request->email,
                'designation' => $request->designation,
                'token' => $token,
                'invited_by' => auth()->id(),
                'status' => 'pending',
                'expires_at' => $expiresAt,
                // Add other fields as needed
            ]);

            // Attach roles and permissions
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

            // Step 5: Get permissions in selected roles but not in selected permissions
            $restrictions = array_diff($permissionsForSelectedRoles, $selectedPermissions);

            // Step 6: Get permissions in not selected roles but in selected permissions
            $extras = array_intersect($permissionsForNotSelectedRoles, $selectedPermissions);

            $permissionsToAdd = array_merge($restrictions, $extras);
            // dd($selectedRoles, $permissionsToAdd);

            // Attach roles to the user
            foreach ($selectedRoles as $role) {
                InvitedUserRole::create([
                    'invitation_id' => $newInvitation->id,
                    'role_id' => $role,
                ]);
            }

            // Attach permissions to the user
            foreach ($permissionsToAdd as $permission) {
                InvitedUserPermission::create([
                    'invitation_id' => $newInvitation->id,
                    'permission_id' => $permission,
                ]);
            }

            // Send invitation email
            Mail::to($request->email)->send(new UserInvitationEmail($newInvitation));

            // Commit the transaction if everything is successful
            DB::commit();
            return redirect()->route('admin.user-invitations.index')->with('flash.banner', 'Invitation sent successfully.');
        } catch (ValidationException $e) {
            // Rollback the transaction on validation exception
            DB::rollBack();
            // Handle validation errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            // Rollback the transaction on query exception
            DB::rollBack();
            // Handle database query exceptions
            return redirect()->back()->with('flash.banner', 'Error occurred while processing the invitation.')->with('flash.bannerStyle', 'danger');
        } catch (\Exception $e) {
            // Rollback the transaction on other exceptions
            DB::rollBack();
            // Handle other exceptions
            return redirect()->back()->with('flash.banner', $e->getMessage())->with('flash.bannerStyle', 'danger');
        }
    }

    public function show(UserInvitation $userInvitation)
    {
        //
    }

    public function edit(UserInvitation $userInvitation)
    {
        // Get the user's roles and permissions
        $userRoles = $userInvitation->roles()->with('permissions')->get();

        // Extract user's permissions into a flat array
        $userPermissions = $userRoles->flatMap(function ($userRole) {
            return $userRole->permissions;
        })->pluck('id')->toArray();

        // Get permissions associated with the user in model_has_permissions
        $modelHasPermissions = $userInvitation->permissions->pluck('id')->toArray();

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

        return Inertia::render('Admin/UserInvitations/Show', [
            'user' => $userInvitation,
            'userRoles' => $userRoles,
            'roles' => $roles,
            'userPermissions' => $userPermissions,
            'designation' => ['name' => $userInvitation->designation],
        ]);
    }

    public function update(Request $request, UserInvitation $userInvitation)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'email' => 'required|email',
                'designation' => 'nullable',

            ]);

            $userInvitation->update([
                'email' => $request->email,
                'designation' => $request->designation,
                // Add other fields as needed
            ]);

            // Existing user check
            $existingUser = User::where('email', $request->email)->first();

            if ($existingUser) {
                // User already exists, show a message
                DB::rollBack(); // Rollback the transaction
                return redirect()->back()->with('flash.banner', 'User already exists with this email.')->with('flash.bannerStyle', 'danger');
            }

            // Detach existing roles and permissions
            $userInvitation->roles()->detach();
            $userInvitation->permissions()->detach();

            // Attach roles and permissions
            $selectedRoles = $request->input('selectedRoles', []);
            $selectedPermissions = $request->input('selectedPermissions', []);

            $notSelectedRoles = Role::whereNotIn('id', $selectedRoles)->pluck('id')->toArray();

            $permissionsForNotSelectedRoles = Role::with('permissions')
                ->whereIn('id', $notSelectedRoles)
                ->get()
                ->pluck('permissions.*.id')
                ->flatten()
                ->toArray();

            $permissionsForSelectedRoles = Role::with('permissions')
                ->whereIn('id', $selectedRoles)
                ->get()
                ->pluck('permissions.*.id')
                ->flatten()
                ->toArray();

            $restrictions = array_diff($permissionsForSelectedRoles, $selectedPermissions);
            $extras = array_intersect($permissionsForNotSelectedRoles, $selectedPermissions);

            $permissionsToAdd = array_merge($restrictions, $extras);

            foreach ($selectedRoles as $role) {
                InvitedUserRole::create([
                    'invitation_id' => $userInvitation->id,
                    'role_id' => $role,
                ]);
            }

            foreach ($permissionsToAdd as $permission) {
                InvitedUserPermission::create([
                    'invitation_id' => $userInvitation->id,
                    'permission_id' => $permission,
                ]);
            }

            // Send invitation email
            Mail::to($request->email)->send(new UserInvitationEmail($userInvitation));

            // Commit the transaction if everything is successful
            DB::commit();

            // Redirect with a success message
            return redirect()->route('admin.user-invitations.index')->with('flash.banner', 'Invitation updated successfully.')->with('flash.bannerStyle', 'success');
        } catch (ValidationException $e) {
            // Rollback the transaction on validation exception
            DB::rollBack();
            // Handle validation errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            // Rollback the transaction on query exception
            DB::rollBack();
            // Handle database query exceptions
            return redirect()->back()->with('flash.banner', 'Error occurred while processing the invitation.')->with('flash.bannerStyle', 'danger');
        } catch (\Exception $e) {
            // Rollback the transaction on other exceptions
            DB::rollBack();
            // Handle other exceptions
            return redirect()->back()->with('flash.banner', 'An unexpected error occurred.')->with('flash.bannerStyle', 'danger');
        }
    }


    public function destroy(UserInvitation $userInvitation)
    {
        //
    }
}
