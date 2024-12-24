<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationHistory;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use App\Notifications\ApplicationStatusChanged;
use App\Http\Controllers\StatusController;


class ApplicationController extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth', 'role:admission_officer'])->except(['index', 'show']);
    }

    public function index()
    {
        $applications = Application::with(['documents'])->latest()->paginate(10);
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

    public function officerDashboard()
    {
        if (!Auth::user()->role === 'admission_officer') {
            abort(403);
        }

        $pendingCount = Application::where('status', 'pending')->count();
        $approvedCount = Application::where('status', 'approved')->count();
        $rejectedCount = Application::where('status', 'rejected')->count();

        // Get recent activities
        $recentActivities = ApplicationHistory::with(['application', 'user'])
            ->latest()
            ->take(10)
            ->get();

        return view('applications.officer-dashboard', compact(
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'recentActivities'
        ));
    }

    public function updateStatus(Request $request, Application $application)
    {
        if (Auth::user()->role !== 'admission_officer') {
            abort(403);
        }

        $oldStatus = $application->status;

        $validated = $request->validate([
            'status' => ['required', 'in:pending,approved,rejected'],
            'remarks' => ['nullable', 'string', 'max:1000'],
        ]);

        $application->update($validated);

        // Record history
        ApplicationHistory::create([
            'application_id' => $application->id,
            'user_id' => Auth::id(),
            'old_status' => $oldStatus,
            'new_status' => $validated['status'],
            'remarks' => $validated['remarks'],
        ]);

        // Send notification to applicant
        $applicant = $application->user;
        $applicant->notify(new ApplicationStatusChanged(
            $application,
            $oldStatus,
            $validated['status']
        ));

        return redirect()
            ->route('applications.show', $application)
            ->with('success', 'Application status updated successfully');
    }

    public function uploadDocument(Request $request, Application $application)
    {
        $request->validate([
            'document' => 'required|file|mimes:pdf|max:10240',
            'document_type' => 'required|string|in:Form 137,Birth Certificate,Report Card,Good Moral,Medical Certificate',
        ]);

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $path = $file->storeAs('documents', $fileName, 'public');

            $document = new Document([
                'document_type' => $request->document_type,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
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
        if (!Auth::check()) {
            abort(403);
        }

        if (!Storage::exists($document->file_path)) {
            abort(404);
        }

        return Storage::response($document->file_path, $document->file_name, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $document->file_name . '"',
        ]);
    }
}
