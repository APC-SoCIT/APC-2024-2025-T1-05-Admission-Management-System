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

class ApplicationController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['role:admission_officer'])->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = Application::with(['documents'])
            ->when($request->has('search'), function($q) use ($request) {
                return $q->where('applicant_name', 'like', '%' . $request->search . '%')
                    ->orWhere('program', 'like', '%' . $request->search . '%');
            })
            ->when($request->has('sort'), function($q) use ($request) {
                return $q->orderBy($request->sort, $request->direction ?? 'asc');
            }, function($q) {
                return $q->latest();
            });

        $applications = $query->paginate(10);

        if ($request->ajax()) {
            return view('applications.partials.table', compact('applications'));
        }

        return view('applications.index', compact('applications'));
    }

    public function create()
    {
        return view('applications.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'applicant_name' => 'required|string|max:255',
            'grade_level' => 'required|string',
            'program' => 'required|string',
            'documents.*' => 'sometimes|file|mimes:pdf|max:10240'
        ]);

        $application = Application::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
            'applicant_name' => $validated['applicant_name'],
            'grade_level' => $validated['grade_level'],
            'program' => $validated['program']
        ]);

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('documents', 'public');
                $application->documents()->create([
                    'document_type' => $file->getClientOriginalName(),
                    'file_path' => $path
                ]);
            }
        }

        return redirect()
            ->route('applications.show', $application)
            ->with('success', 'Application created successfully.');
    }

    public function show(Application $application)
    {
        $application->load(['documents']);
        return view('applications.show', compact('application'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,approved,rejected'],
            'remarks' => ['nullable', 'string', 'max:1000'],
        ]);

        $oldStatus = $application->status;
        $application->update($validated);

        // Record the status change in history
        ApplicationHistory::create([
            'application_id' => $application->id,
            'user_id' => Auth::id(),
            'old_status' => $oldStatus,
            'new_status' => $validated['status'],
            'remarks' => $validated['remarks']
        ]);

        // Send notification to the applicant with all required parameters
        if ($application->user) {
            $application->user->notify(new ApplicationStatusChanged(
                $application,
                $oldStatus,
                $validated['status']
            ));
        }

        return redirect()
            ->route('applications.show', $application)
            ->with('success', 'Application status updated successfully');
    }

    public function newApplications()
    {
        $applications = Application::where('status', 'pending')
            ->latest()
            ->paginate(10);
        return view('applications.new', compact('applications'));
    }

    public function acceptedApplications()
    {
        $applications = Application::where('status', 'approved')
            ->latest()
            ->paginate(10);
        return view('applications.accepted', compact('applications'));
    }

    public function rejectedApplications()
    {
        $applications = Application::where('status', 'rejected')
            ->latest()
            ->paginate(10);
        return view('applications.rejected', compact('applications'));
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

        return back()->withErrors(['document' => 'Failed to upload document']);
    }

    public function deleteDocument(Document $document)
    {
        if (Storage::exists($document->file_path)) {
            Storage::delete($document->file_path);
        }

        $document->delete();

        return back()->with('success', 'Document deleted successfully');
    }
}
