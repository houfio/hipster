<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = $request->user();

        if (is_null($user)) {
            return view('auth.login');
        }

        $user->authorize($role);
        return $next($request);
    }
}
