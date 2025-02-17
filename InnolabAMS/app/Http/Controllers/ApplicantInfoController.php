<?php

namespace App\Http\Controllers;

use App\Models\ApplicantInfo;
use Illuminate\Http\Request;

class ApplicantInfoController extends Controller
{
    // Index method to list applicants
    public function index()
    {
        $query = ApplicantInfo::with('user')
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
            );

        // Handle sorting
        $sortField = request('sort', 'id');
        $sortDirection = request('direction', 'desc');
        $query->orderBy($sortField, $sortDirection);

        // Handle search
        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('applicant_surname', 'like', "%{$search}%")
                    ->orWhere('applicant_given_name', 'like', "%{$search}%")
                    ->orWhere('apply_program', 'like', "%{$search}%")
                    ->orWhere('applicant_mobile_number', 'like', "%{$search}%");
            });
        }

        $applicants = $query->get();

        // Handle JSON response
        if (request()->wantsJson()) {
            return response()->json($applicants);
        }

        return view('admission.index', compact('applicants'));
    }

    // Store method for handling form submissions
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                // Program Information
                'apply_program' => 'required|in:Elementary,High School,Senior High School',
                'apply_grade_level' => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12',
                'apply_strand' => 'nullable|required_if:apply_program,Senior High School|in:STEM,ABM,TECHVOC,HUMSS,GAS',
                'student_type' => 'required|in:Transferee,Existing Student,Returning Student',

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
                'applicant_barangay' => 'required|max:255',
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
                'father_name' => 'nullable|string|max:255',
                'father_occupation' => 'nullable|string|max:255',
                'father_contact' => 'nullable|string|max:255',
                'mother_name' => 'nullable|string|max:255',
                'mother_occupation' => 'nullable|string|max:255',
                'mother_contact' => 'nullable|string|max:255',
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


    public function new()
    {
        $applicants = ApplicantInfo::with('user')
            ->where('status', 'new')
            ->get();
        return view('admission.index', ['applicants' => $applicants]);
    }

    public function accepted()
    {
        $applicants = ApplicantInfo::with('user')
            ->where('status', 'accepted')
            ->get();
        return view('admission.index', ['applicants' => $applicants]);
    }

    public function rejected()
    {
        $applicants = ApplicantInfo::with('user')
            ->where('status', 'rejected')
            ->get();
        return view('admission.index', ['applicants' => $applicants]);
    }

            // Add these methods to your existing ApplicantInfoController class
        public function create()
        {
            return view('admission.create');
        }

        public function show($id)
        {
            $applicant = ApplicantInfo::with('user')->findOrFail($id);
            return view('admission.show', compact('applicant'));
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
                'father_name' => 'nullable|string|max:255',
                'father_occupation' => 'nullable|string|max:255',
                'father_contact' => 'nullable|string|max:255',
                'mother_name' => 'nullable|string|max:255',
                'mother_occupation' => 'nullable|string|max:255',
                'mother_contact' => 'nullable|string|max:255',
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
}
