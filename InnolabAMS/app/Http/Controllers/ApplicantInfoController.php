<?php

namespace App\Http\Controllers;

use App\Models\ApplicantInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\AcceptanceEmail;
use App\Mail\RejectionEmail;
use App\Http\Requests\RejectApplicationRequest;
use App\Notifications\ApplicationRejected;
use App\Http\Requests\AcceptApplicationRequest;
use App\Notifications\ApplicationAccepted;
use Carbon\Carbon;

class ApplicantInfoController extends Controller
{
    // Index method to list applicants
    public function index()
    {
        $applicants = ApplicantInfo::where('status', 'new')
            ->with('user')
            ->select(
                'id',
                'user_id',
                'applicant_surname',
                'applicant_given_name',
                'applicant_middle_name',
                'applicant_extension',
                'gender',
                'apply_program',
                'applicant_mobile_number',
                'status',
                'applicant_email'
            )
            ->paginate(10)
            ->through(fn($applicant) => $applicant->makeVisible('applicant_email'));

        return view('admission.index', array_merge(
            ['applicants' => $applicants],
            $this->getCounts()
        ));
    }

    // Store method for handling form submissions
    public function store(Request $request)
    {
        try {
            // Log the entire request for debugging
            \Log::info('Request data:', $request->all());

            // Validate basic fields first
            $validatedData = $request->validate([
                'apply_program' => 'required',
                'apply_grade_level' => 'required',
                'student_type' => 'required',
                // Add other validation rules but exclude files for now
                'hobbies' => 'nullable|string|max:65535',
                'skills' => 'nullable|string|max:65535',
                'extracurricular_interest' => 'nullable|string|max:65535',
            ]);

            // Handle file uploads separately
            $paths = [];
            $fileFields = ['birth_certificate', 'form_137', 'form_138', 'id_picture', 'good_moral'];

            foreach ($fileFields as $field) {
                \Log::info("Checking file: {$field}", [
                    'exists' => $request->hasFile($field),
                    'valid' => $request->hasFile($field) ? $request->file($field)->isValid() : false
                ]);

                if ($request->hasFile($field) && $request->file($field)->isValid()) {
                    try {
                        $file = $request->file($field);
                        $filename = time() . '_' . $file->getClientOriginalName();
                        // Store in public disk
                        $path = $file->storeAs("documents/{$field}", $filename, 'public');
                        $paths["{$field}_path"] = $path;
                        \Log::info("File {$field} stored successfully at: {$path}");
                    } catch (\Exception $e) {
                        \Log::error("Error storing file {$field}: " . $e->getMessage());
                        throw $e;
                    }
                }
            }

            // Prepare applicant data
            $applicantData = $request->except(array_merge($fileFields, ['_token']));

            // Convert siblings array to JSON if it exists
            if (isset($applicantData['siblings']) && is_array($applicantData['siblings'])) {
                $applicantData['siblings'] = json_encode($applicantData['siblings']);
            }

            // Add file paths, status and user_id
            $applicantData = array_merge($applicantData, $paths, [
                'status' => 'pending',
                'user_id' => auth()->id()
            ]);

            \Log::info('Final applicant data:', $applicantData);

            // Create applicant record
            $applicant = ApplicantInfo::create($applicantData);

            \Log::info('Applicant created successfully:', ['id' => $applicant->id]);

            return redirect()
            ->route('admission.show', $applicant->id)
            ->with('success', 'Application created successfully');

        } catch (\Exception $e) {
            \Log::error('Application submission error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());

            // Clean up any uploaded files if there was an error
            foreach ($paths ?? [] as $path) {
                Storage::disk('public')->delete($path);
            }

            return back()
                ->withInput()
                ->with('error', 'Error submitting application. Please try again.');
        }
    }

    public function new()
    {
        $applicants = ApplicantInfo::where('status', 'new')
            ->with('user')
            ->paginate(10);
        return view('admission.new', array_merge(
            ['applicants' => $applicants],
            $this->getCounts()
        ));
    }

    public function accepted()
    {
        $applicants = ApplicantInfo::where('status', 'accepted')
            ->with('user')
            ->paginate(10);
        return view('admission.accepted', array_merge(
            ['applicants' => $applicants],
            $this->getCounts()
        ));
    }

    public function rejected()
    {
        $applicants = ApplicantInfo::where('status', 'rejected')
            ->with('user')
            ->paginate(10);
        return view('admission.rejected', array_merge(
            ['applicants' => $applicants],
            $this->getCounts()
        ));
    }

    // Add these methods to your existing ApplicantInfoController class
    public function create()
    {
        return view('admission.create');
    }

    public function show($id)
    {
        $applicant = ApplicantInfo::findOrFail($id);
        return view('admission.show', compact('applicant'));
    }

    public function downloadFile($id, $documentType)
    {
        try {
            $applicant = ApplicantInfo::findOrFail($id);

            $pathMap = [
                'birth_certificate' => $applicant->birth_certificate_path,
                'form_137' => $applicant->form_137_path,
                'form_138' => $applicant->form_138_path,
                'id_picture' => $applicant->id_picture_path,
                'good_moral' => $applicant->good_moral_path,
            ];

            if (!isset($pathMap[$documentType]) || !$pathMap[$documentType]) {
                return back()->with('error', 'Document not found');
            }

            $path = $pathMap[$documentType];

            if (!Storage::disk('public')->exists($path)) {
                return back()->with('error', 'File not found in storage');
            }

            return response()->file(Storage::disk('public')->path($path));
        } catch (\Exception $e) {
            \Log::error('Document download error: ' . $e->getMessage());
            return back()->with('error', 'Error downloading document');
        }
    }

    //Change method name from showPersonalInfoForm to showApplicationForm
    public function showApplicationForm()
    {
        return view('application_form.create');
    }

    public function storeForm(Request $request)
    {
        try {
            $validated = $request->validate([
                // Program Information
                'apply_program' => 'required|in:Elementary,High School,Senior High School',
                'apply_grade_level' => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12',
                'apply_strand' => 'nullable|required_if:apply_program,Senior High School|in:STEM,ABM,TECHVOC,HUMSS,GAS',

                // Personal Information
                'applicant_surname' => 'required|max:40',
                'applicant_given_name' => 'required|max:40',
                'applicant_middle_name' => 'nullable|max:40',
                'applicant_extension' => 'nullable|max:10',
                'applicant_date_birth' => 'required|date',
                'age' => 'nullable|numeric|min:0|max:100',
                'applicant_place_birth' => 'required|max:255',
                'gender' => 'required|in:Male,Female',
                'applicant_tel_no' => 'nullable|string|max:20',
                'applicant_address_street' => 'required|max:255',
                'applicant_address_province' => 'required|max:255',
                'applicant_address_city' => 'required|max:255',
                'applicant_nationality' => 'required|max:255',
                'applicant_religion' => 'nullable|max:255',
                'applicant_mobile_number' => 'required|string|max:11',
                'applicant_email' => 'required|email|max:255|unique:applicant_infos,applicant_email',
                'applicant_photo' => 'nullable|image|max:2048',

                // Educational Background
                'lrn' => 'nullable|string|max:12',
                'school_name' => 'nullable|string|max:255',
                'school_address' => 'nullable|string|max:255',
                'previous_program' => 'nullable|string|max:255',
                'year_of_graduation' => 'nullable|string|max:4',
                'awards_honors' => 'nullable|string|max:255',
                'gwa' => 'nullable|numeric|between:0,100',

                // Family Information
                'father_given_name' => 'nullable|string|max:255',
                'father_middle_name' => 'nullable|string|max:255',
                'father_surname' => 'nullable|string|max:255',
                'father_contact' => 'nullable|string|max:255',
                'mother_name' => 'nullable|string|max:255',
                'mother_occupation' => 'nullable|string|max:255',
                'mother_contact' => 'nullable|string|max:255',
                'guardian_given_name' => 'nullable|string|max:255',
                'guardian_middle_name' => 'nullable|string|max:255',
                'guardian_surname' => 'nullable|string|max:255',
                'guardian_contact_num' => 'nullable|string|max:255',
                'siblings' => 'nullable|array',
                'siblings.*.full_name' => 'nullable|string|max:255',
                'siblings.*.date_of_birth' => 'nullable|date',
                'siblings.*.age' => 'nullable|numeric|min:0|max:100',
                'siblings.*.grade_level' => 'nullable|string|max:255',
                'siblings.*.school_attended' => 'nullable|string|max:255',

                // Emergency Contact
                'emergency_contact_name' => 'nullable|string|max:255',
                'emergency_contact_address' => 'nullable|string|max:255',
                'emergency_contact_tel' => 'nullable|string|max:20',
                'emergency_contact_mobile' => 'nullable|string|max:20',
                'emergency_contact_email' => 'nullable|email|max:255',
            ]);

            // Debug log
            \Log::info('Validated data:', $validated);

            // Ensure user_id is set
            $validated['user_id'] = auth()->id();
            $validated['status'] = 'pending';

            // Handle siblings data - convert to JSON
            if (isset($validated['siblings'])) {
                $validated['siblings'] = json_encode(array_values(array_filter($validated['siblings'], function ($sibling) {
                    return !empty($sibling['full_name']);
                })));
            }

            // Handle photo upload
            if ($request->hasFile('applicant_photo')) {
                $path = $request->file('applicant_photo')->store('applicant-photos', 'public');
                $validated['applicant_photo'] = $path;
            }

            $applicant = ApplicantInfo::create($validated);

            // Debug log
            \Log::info('Application created:', ['id' => $applicant->id]);

            return redirect()
                ->route('admission.show',  $applicant->id)
                ->with('success', 'Application created successfully');
        } catch (\Exception $e) {
            // Debug log
            \Log::error('Application creation failed:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Failed to create application: ' . $e->getMessage());
        }
    }

    public function showScholarshipForm()
    {
        return view('scholarship.create');
    }

    // Add this method to your existing ApplicantInfoController class
    public function updateStatus(Request $request, $id)
    {
        $applicant = ApplicantInfo::findOrFail($id);
        if ($request->status === 'accepted') {
            return $this->acceptApplication($request, $id);
        }

        // Use existing rejection logic but pass the original request
        return $this->rejectApplication($request, $id);
    }

    protected function acceptApplication(Request $request, $id)
    {
        $applicant = ApplicantInfo::findOrFail($id);

        $applicant->update([
            'status' => 'accepted',
            'acceptance_message' => $request->acceptance_message ?? 'Congratulations! Your application has been accepted.',
            'accepted_at' => Carbon::now(),
            'processed_at' => now(),
            'processed_by' => auth()->id()
        ]);

        // Send acceptance notification
        $applicant->user->notify(new ApplicationAccepted($applicant));
        Mail::to($applicant->applicant_email)->send(new AcceptanceEmail($applicant));

        if (empty($applicant->applicant_email)) {
            return redirect()->back()->with('error', 'Applicant email is missing or invalid.');
        }

        return redirect()->route('admission.accepted')
            ->with('success', 'Application has been accepted successfully.');
    }

    protected function rejectApplication(Request $request, $id)
    {
        // Validate the request here instead of using a form request
        $validated = $request->validate([
            'status' => 'required|in:rejected',
            'rejection_reason' => 'required|string|max:1000'
        ]);

        $applicant = ApplicantInfo::findOrFail($id);
        $applicant->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
            'processed_at' => now(),
            'processed_by' => auth()->id()
        ]);

        // Send rejection notification
        $applicant->user->notify(new ApplicationRejected($applicant));
        Mail::to($applicant->applicant_email)->send(new RejectionEmail($applicant));

        if (empty($applicant->applicant_email)) {
            return redirect()->back()->with('error', 'Applicant email is missing or invalid.');
        }


        return redirect()->route('admission.rejected')
            ->with('success', 'Application has been rejected');
    }

    private function getCounts()
    {
        return [
            'newCount' => ApplicantInfo::where('status', 'new')->count(),
            'acceptedCount' => ApplicantInfo::where('status', 'accepted')->count(),
            'rejectedCount' => ApplicantInfo::where('status', 'rejected')->count(),
        ];
    }

    public function someMethod()
    {
        $applicant = \App\Models\ApplicantInfo::where('user_id', auth()->id())->first();
        return view('some.view', compact('applicant'));
    }

}
