<?php
// app/Http/Middleware/CheckRole.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // For now, let's allow any authenticated user to access pages with role middleware
        // Later we can implement proper role checks once the user roles system is set up
        if (!\Illuminate\Support\Facades\Auth::check()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
