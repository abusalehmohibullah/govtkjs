<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\UserInvitation;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Contracts\RegisterViewResponse;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;;

class RegisteredUserController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Show the registration view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\RegisterViewResponse
     */
    public function create(Request $request, $token = null)
    {
        $invitation = UserInvitation::where('token', $token)->first();
        if (!$invitation) {
            // Handle invalid token (redirect, show error, etc.)
            return redirect('/'); // Adjust this as needed
        }
        return Inertia::render('Auth/Register', [
            'token' => $token,
            'email' => $invitation->email,
        ]);
    }

    /**
     * Create a new registered user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Fortify\Contracts\CreatesNewUsers  $creator
     * @return \Laravel\Fortify\Contracts\RegisterResponse
     */
    public function store(
        Request $request,
        $token = null,
        CreatesNewUsers $creator
    ): RegisterResponse {
        event(new Registered($user = $creator->create($request->all(), $token)));

        $emailVerifiedAt = Carbon::now();
        $user->update(['email_verified_at' => $emailVerifiedAt]);
        
        $this->guard->login($user);
        
        // Find and delete the invitation record based on the email
        $invitation = UserInvitation::with(['roles', 'permissions'])->where('email', $request->input('email'))->first();

        // Assign roles and permissions from the invitation to the user
        $invitationRoles = $invitation->roles->pluck('id')->toArray();
        $invitationPermissions = $invitation->permissions->pluck('id')->toArray();

        $user->assignRole($invitationRoles);
        $user->givePermissionTo($invitationPermissions);
        
        $invitation->update(['status' => 'accepted']);

        return app(RegisterResponse::class);
    }
}
