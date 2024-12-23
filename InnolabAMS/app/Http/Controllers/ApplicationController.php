<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller; // Make sure this import is added

class ApplicationController extends Controller
{
    // Add middleware for authentication and role-based access control
    public function __construct()
    {
        #$this->middleware(['auth', 'role:admission_officer'])->except(['index', 'show']);
    }

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

    public function deleteDocument(Document $document)
    {
        if (Storage::exists($document->file_path)) {
            Storage::delete($document->file_path);
        }
        $document->delete();

        return back()->with('success', 'Document deleted successfully');
    }

    // Update the updateStatus method to check if the user is an admission officer
    public function updateStatus(Request $request, Application $application)
    {
        if (!Auth::user()->isAdmissionOfficer()) {
            abort(403); // Forbidden if the user is not an admission officer
        }

        $validated = $request->validate([
            'status' => ['required', 'in:pending,approved,rejected'],
            'remarks' => ['nullable', 'string', 'max:1000'],
        ]);

        $application->update($validated);

        return redirect()
            ->route('applications.show', $application)
            ->with('success', 'Application status updated successfully');
    }

    public function uploadDocument(Request $request, Application $application)
    {
        $request->validate([
            'document' => 'required|file|mimes:pdf|max:10240', // 10MB max
            'document_type' => 'required|string|in:Form 137,Birth Certificate,Report Card,Good Moral,Medical Certificate'
        ]);

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Store the file in the storage/app/public/documents directory
            $path = $file->storeAs('documents', $fileName, 'public');

            // Create document record
            $document = new Document([
                'document_type' => $request->document_type,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path
            ]);

            $application->documents()->save($document);

            return redirect()
                ->route('applications.show', $application)
                ->with('success', 'Document uploaded successfully');
        }

        return back()
            ->withErrors(['document' => 'Failed to upload document'])
            ->withInput();
    }

    public function formatFileSize($bytes)
    {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' bytes';
    }

    public function viewDocument(Document $document)
    {
        // Basic auth check from middleware
        if (!Auth::check()) {
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
