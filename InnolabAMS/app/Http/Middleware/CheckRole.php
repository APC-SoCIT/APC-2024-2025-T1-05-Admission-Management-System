<?php
// app/Http/Middleware/CheckRole.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Add this import

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->user();

        if (!$user) {
            abort(403, 'Unauthorized action.');
        }

        // Check if user is an admission officer
        if ($role === 'admission_officer') {
            $isAdmissionOfficer = DB::table('admission_officers')
                ->where('user_id', $user->id)
                ->exists();

            if (!$isAdmissionOfficer) {
                abort(403, 'Unauthorized action. Must be an admission officer.');
            }
        }

        return $next($request);
    }
}
