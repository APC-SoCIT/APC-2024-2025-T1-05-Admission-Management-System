<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Debug output
        logger('User role: ' . $request->user()->role);
        logger('Required role: ' . $role);

        if (!$request->user() || $request->user()->role !== $role) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
