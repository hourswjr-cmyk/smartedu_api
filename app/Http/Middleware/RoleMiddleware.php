<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    // Split roles if passed as comma-separated string
    $allowedRoles = [];

    foreach ($roles as $role) {
        $allowedRoles = array_merge($allowedRoles, explode(',', $role));
    }

    if (!in_array(Auth::user()->role, $allowedRoles)) {
        abort(403, 'Unauthorized');
    }

    return $next($request);
}

}