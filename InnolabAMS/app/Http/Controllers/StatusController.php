<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use App\Models\ApplicationHistory;
use App\Http\Controllers\Controller;

class StatusController extends BaseController
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admission_officer']);
    }

    public function update(Request $request, Application $application)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,approved,rejected'],
            'remarks' => ['nullable', 'string', 'max:1000'],
        ]);

        $oldStatus = $application->status;
        $application->update($validated);

        // Record history
        ApplicationHistory::create([
            'application_id' => $application->id,
            'user_id' => Auth::id(),
            'old_status' => $oldStatus,
            'new_status' => $validated['status'],
            'remarks' => $validated['remarks']
        ]);

        return response()->json([
            'message' => 'Status updated successfully',
            'status' => $validated['status']
        ]);
    }
}
