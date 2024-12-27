<?php
// app/Http/Middleware/CheckRole.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;  // Add this import

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        Log::info('CheckRole middleware', [
            'user_id' => Auth::id(),
            'user_role' => Auth::user()->role ?? 'none',
            'required_role' => $role
        ]);

        if (!Auth::check() || Auth::user()->role !== $role) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
