<?php

namespace App\Http\Controllers;

use App\Models\ApplicantInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ApplicantInfoController extends Controller  // Note the corrected class name
{
    public function index()
    {
        $applicants = ApplicantInfo::with('user')->get();
        return view('admission.index', compact('applicants'));
    }

    public function show($id)
    {
        $applicant = ApplicantInfo::with('user')->findOrFail($id);
        return view('admission.show', compact('applicant'));
    }

    public function create()
    {
        return view('admission.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'program_type' => 'required',
            'grade_level' => 'required',
            'strand' => 'required_if:program_type,Senior High School',
            'student_type' => 'required',
            
            // Personal Information
            'applicant_given_name' => 'required',
            'applicant_surname' => 'required',
            'applicant_middle_name' => 'required',
            'gender' => 'required',
            'applicant_date_birth' => 'required|date',
            'applicant_place_of_birth' => 'required',
            'applicant_nationality' => 'required',
            'applicant_mobile_number' => 'nullable|max:20',
            
            // Address
            'applicant_address_province' => 'required',
            'applicant_address_city' => 'required',
            'applicant_address_barangay' => 'required',
            'applicant_house_number' => 'required',
            'applicant_address_street' => 'required',
            
            // Emergency Contact
            'emergency_first_name' => 'required',
            'emergency_last_name' => 'required',
            'emergency_contact_number' => ['required', 'regex:/^09\d{2}-\d{3}-\d{4}$/'],
            'emergency_contact_address' => 'required',
        ]);

        // Validate at least one guardian is provided
        if (empty($request->father_first_name) && empty($request->mother_first_name) && empty($request->guardian_first_name)) {
            return back()
                ->withInput()
                ->withErrors(['guardian' => 'At least one guardian information must be provided']);
        }

        // Validate required documents based on student type
        if ($request->student_type === 'transferee_new') {
            $request->validate([
                'birth_certificate' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
                'form_138' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
                'good_moral' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
                'parent_id' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
                'photo_2x2' => 'required|file|mimes:jpg,jpeg,png|max:10240',
            ]);
        } elseif ($request->student_type === 'existing') {
            $request->validate([
                'updated_parent_id' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            ]);
        }

        try {
            // Create new applicant record
            $applicant = new ApplicantInfo();
            
            // Fill basic information
            $applicant->fill($request->only([
                'program_type',
                'grade_level',
                'strand',
                'student_type',
                'applicant_given_name',
                'applicant_surname',
                'applicant_middle_name',
                'applicant_extension',
                'gender',
                'applicant_date_birth',
                'applicant_place_of_birth',
                'applicant_nationality',
                'applicant_religion',
                'applicant_mobile_number',
                'applicant_tel_no',
                'applicant_address_province',
                'applicant_address_city',
                'applicant_address_barangay',
                'applicant_house_number',
                'applicant_address_street',
                // Family Information
                'father_first_name',
                'father_middle_name',
                'father_last_name',
                'father_contact',
                'father_tel',
                'mother_first_name',
                'mother_middle_name',
                'mother_last_name',
                'mother_contact',
                'mother_tel',
                'guardian_first_name',
                'guardian_middle_name',
                'guardian_last_name',
                'guardian_contact',
                'guardian_tel',
                // Emergency Contact
                'emergency_first_name',
                'emergency_middle_name',
                'emergency_last_name',
                'emergency_contact_number',
                'emergency_contact_tel',
                'emergency_contact_address'
            ]));

            // Handle file uploads
            $documentTypes = [
                'birth_certificate',
                'form_138',
                'good_moral',
                'parent_id',
                'photo_2x2',
                'updated_parent_id',
                'medical_records'
            ];

            foreach ($documentTypes as $docType) {
                if ($request->hasFile($docType)) {
                    $path = $request->file($docType)->store("documents/$docType", 'public');
                    $applicant->{$docType . '_path'} = $path;
                }
            }

            $applicant->status = 'new';
            $applicant->save();

            // Redirect to new applications page with success message
            return redirect()
                ->route('admission.new')
                ->with('success', 'Application submitted successfully');

        } catch (\Exception $e) {
            Log::error('Application submission error: ' . $e->getMessage());
            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to submit application. Please try again.']);
        }
    }
}