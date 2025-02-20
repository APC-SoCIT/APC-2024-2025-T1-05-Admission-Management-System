<?php

namespace App\Http\Controllers;

use App\Models\ApplicantInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
                'status'
            )->get();

        return view('admission.index', compact('applicants'));
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
                'status' => 'new',
                'user_id' => auth()->id() // Add the authenticated user's ID
            ]);

            \Log::info('Final applicant data:', $applicantData);

            // Create applicant record
            $applicant = ApplicantInfo::create($applicantData);

            \Log::info('Applicant created successfully:', ['id' => $applicant->id]);

            return redirect()->route('admission.index')
                ->with('success', 'Application submitted successfully.');

        } catch (\Exception $e) {
            \Log::error('Application submission error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());

            // Clean up any uploaded files if there was an error
            foreach ($paths ?? [] as $path) {
                Storage::disk('public')->delete($path);
            }

            return back()
                ->withInput()
                ->with('error', 'Error submitting application: ' . $e->getMessage());
        }
    }

    public function new()
    {
        $applicants = ApplicantInfo::with('user')
            ->where('status', 'new')
            ->get();
        return view('admission.index', ['applicants' => $applicants]);
    }

    public function accepted()
    {
        $applicants = ApplicantInfo::where('status', 'accepted')
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
                'status'
            )->get();

        return view('admission.index', compact('applicants'));
    }

    public function rejected()
    {
        $applicants = ApplicantInfo::where('status', 'rejected')
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
                'status'
            )->get();

        return view('admission.index', compact('applicants'));
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
        $applicant = ApplicantInfo::findOrFail($id);
        $pathColumn = "{$documentType}_path";

        if (!$applicant->$pathColumn) {
            abort(404, 'File not found');
        }

        $filePath = storage_path('app/public/' . $applicant->$pathColumn);

        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        return response()->file($filePath);
    }

    //Personal Information Form
    public function showPersonalInfoForm()
    {
        return view('personal_information.create');
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
                'applicant_mobile_number' => 'required|max:12',
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
            $validated['user_id'] = auth()->id() ?? 1; // Fallback to ID 1 if no auth user
            $validated['status'] = 'new';

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
                ->route('admission.index')
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
        $validatedData = $request->validate([
            'status' => ['required', 'string', 'in:accepted,rejected'],
        ]);

        $applicant = ApplicantInfo::findOrFail($id);
        $applicant->update([
            'status' => $validatedData['status'],
            'processed_at' => now(),
            'processed_by' => auth()->id()
        ]);

        $statusMessage = ucfirst($validatedData['status']);

        // Redirect based on status
        if ($validatedData['status'] === 'accepted') {
            return redirect()->route('admission.accepted')
                ->with('success', "Application has been {$statusMessage}");
        } else {
            return redirect()->route('admission.rejected')
                ->with('success', "Application has been {$statusMessage}");
        }
    }
}
