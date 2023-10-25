<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RestrictionMiddleware
{
    public function handle($request, Closure $next, $roleName, $permission)
    {
        $user = Auth::user();

        $hasDirectPermission = $user->hasDirectPermission($permission);
        $hasPermissionViaRole = $user->hasRole($roleName) && $user->hasPermissionTo($permission);

        if (($hasDirectPermission && $hasPermissionViaRole) || (!$hasDirectPermission && !$hasPermissionViaRole)){
            // Both direct and role-based permissions exist; deny access
            return abort(403, 'Restricted Access.');
        }

        return $next($request);
    }
}
