<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Document;
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

        return redirect()
            ->route('applications.show', $application)
            ->with('success', 'Application status updated successfully');
    }

    public function viewDocument(Document $document)
    {
        // Basic auth check from middleware
        if (!auth()->check()) {
            abort(403);
        }

        // Check if file exists
        if (!Storage::exists($document->file_path)) {
            abort(404);
        }

        // Stream the file
        return Storage::response($document->file_path, $document->file_name, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $document->file_name . '"'
        ]);
    }
}
