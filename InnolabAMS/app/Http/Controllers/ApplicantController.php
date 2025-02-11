<?php

namespace App\Http\Controllers;

use App\Models\ApplicantInfo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreApplicationRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{
    public function index()
    {
        $applicants = ApplicantInfo::with(['user', 'familyInfo', 'educationalBackground'])->get();
        return view('applicants.index', compact('applicants'));
    }

    public function show($id)
    {
        $applicant = ApplicantInfo::with(['user', 'familyInfo', 'educationalBackground'])->findOrFail($id);
        return view('applicants.show', compact('applicant'));
    }

    public function create()
    {
        return view('admission.create');
    }

    public function store(StoreApplicationRequest $request)
    {
        try {
            Log::info('Starting application submission', ['request' => $request->all()]);

            DB::beginTransaction();

            // Handle file uploads
            $filePaths = $this->handleFileUploads($request);
            Log::info('Files uploaded', ['paths' => $filePaths]);

            // Create applicant record
            $applicant = ApplicantInfo::create([
                'user_id' => Auth::id(),
                'student_type' => $request->student_type,
                'previous_school' => $request->previous_school,
                'transfer_reason' => $request->transfer_reason,
                'is_returning' => $request->boolean('is_returning'),
                'apply_program' => $request->apply_program,
                'apply_grade_level' => $request->apply_grade_level,
                'apply_strand' => $request->apply_strand,
                // Personal Information
                'applicant_surname' => $request->applicant_surname,
                'applicant_given_name' => $request->applicant_given_name,
                'applicant_middle_name' => $request->applicant_middle_name,
                'applicant_extension' => $request->applicant_extension,
                'applicant_date_birth' => $request->applicant_date_birth,
                'age' => $request->age,
                'applicant_place_birth' => $request->applicant_place_birth,
                'gender' => $request->gender,
                'applicant_tel_no' => $request->applicant_tel_no,
                'applicant_mobile_number' => $request->applicant_mobile_number,
                'applicant_address_street' => $request->applicant_address_street,
                'applicant_address_province' => $request->applicant_address_province,
                'applicant_address_city' => $request->applicant_address_city,
                'applicant_nationality' => $request->applicant_nationality,
                'applicant_religion' => $request->applicant_religion,
                // File paths
                'birth_certificate_path' => $filePaths['birth_certificate'] ?? null,
                'form_138_path' => $filePaths['form_138'] ?? null,
                'good_moral_path' => $filePaths['good_moral'] ?? null,
                'parent_id_path' => $filePaths['parent_id'] ?? null,
                'photo_2x2_path' => $filePaths['photo_2x2'] ?? null,
                'medical_records_path' => $filePaths['medical_records'] ?? null,
                'status' => 'new'
            ]);

            // Create educational background
            $applicant->educationalBackground()->create([
                'lrn' => $request->lrn,
                'school_name' => $request->school_name,
                'school_address' => $request->school_address,
                'previous_program' => $request->previous_program,
                'year_of_graduation' => $request->year_of_graduation,
                'gwa' => $request->gwa,
                'awards_honors' => $request->awards_honors
            ]);

            // Create family info
            $familyInfo = $applicant->familyInfo()->create([
                'father_name' => $request->father_name,
                'father_occupation' => $request->father_occupation,
                'father_contact_number' => $request->father_contact_number,
                'mother_name' => $request->mother_name,
                'mother_occupation' => $request->mother_occupation,
                'mother_contact_number' => $request->mother_contact_number,
                'emergency_contact_name' => $request->emergency_contact_name,
                'emergency_contact_address' => $request->emergency_contact_address,
                'emergency_contact_tel' => $request->emergency_contact_tel,
                'emergency_contact_mobile' => $request->emergency_contact_mobile,
                'emergency_contact_email' => $request->emergency_contact_email,
            ]);

            // Create siblings if any
            if ($request->has('siblings')) {
                foreach ($request->siblings as $sibling) {
                    $familyInfo->siblings()->create([
                        'full_name' => $sibling['full_name'],
                        'date_of_birth' => $sibling['date_of_birth'],
                        'age' => $sibling['age'],
                        'grade_level' => $sibling['grade_level'],
                        'school_attended' => $sibling['school_attended']
                    ]);
                }
            }

            DB::commit();
            Log::info('Application submitted successfully');

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Application submitted successfully',
                    'redirect' => route('admission.index')
                ]);
            }

            return redirect()
                ->route('admission.index')
                ->with('success', 'Application submitted successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Application submission failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Clean up any uploaded files if there was an error
            foreach ($filePaths ?? [] as $path) {
                if ($path) {
                    Storage::delete($path);
                }
            }

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to submit application. Please try again.',
                    'error' => $e->getMessage()
                ], 422);
            }

            return back()
                ->withInput()
                ->with('error', 'Failed to submit application. Please try again.');
        }
    }

    private function handleFileUploads(Request $request): array
    {
        $filePaths = [];
        $fileFields = [
            'birth_certificate',
            'form_138',
            'good_moral',
            'parent_id',
            'photo_2x2',
            'medical_records'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $filePaths[$field] = $request->file($field)->store('documents', 'public');
            }
        }

        return $filePaths;
    }
}
