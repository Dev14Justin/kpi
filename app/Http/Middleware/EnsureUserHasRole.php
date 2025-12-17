<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if ($user === null) {
            abort(401);
        }

        $allowedRoles = $roles !== []
            ? $roles
            : [UserRole::Admin->value, UserRole::Superadmin->value];

        $roleValue = $user->role instanceof UserRole ? $user->role->value : (string) $user->role;

        if (! in_array($roleValue, $allowedRoles, true)) {
            abort(403, 'Accès interdit.');
        }

        return $next($request);
    }
}
