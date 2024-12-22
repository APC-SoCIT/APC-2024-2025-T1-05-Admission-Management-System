<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with(['documents'])
            ->latest()
            ->paginate(10);

        return view('applications.index', compact('applications'));
    }

    public function show(Application $application)
    {
        $application->load('documents');
        return view('applications.show', compact('application'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,approved,rejected'],
            'remarks' => ['nullable', 'string', 'max:1000'],
        ]);

        $application->update($validated);

        return back()->with('status', 'Application status updated successfully.');
    }
}
