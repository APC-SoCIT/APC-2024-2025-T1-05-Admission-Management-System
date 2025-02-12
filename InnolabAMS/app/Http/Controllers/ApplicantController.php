<?php

namespace App\Http\Controllers;

use App\Models\ApplicantInfo;
use App\Models\FamilyInfo;
use App\Models\SiblingInfo;
use App\Models\EducationalBackground;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{
    public function index()
    {
        $applicants = ApplicantInfo::with(['user', 'familyInfo', 'educationalBackground'])->get();
        return view('admission.index', compact('applicants'));
    }

    public function create()
    {
        return view('admission.create');
    }

    public function store(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                // Create applicant record first
                $applicant = ApplicantInfo::create([
                    'user_id' => auth()->id(),
                    'status' => 'new',
                    'student_type' => $request->student_type,
                    'previous_school' => $request->previous_school,
                    'transfer_reason' => $request->transfer_reason,
                    'gap_period' => $request->gap_period,
                    'return_reason' => $request->return_reason,
                    'current_grade_level' => $request->current_grade_level,
                    'academic_status' => $request->academic_status,
                    'applicant_surname' => $request->applicant_surname,
                    'applicant_given_name' => $request->applicant_given_name,
                    'applicant_middle_name' => $request->applicant_middle_name,
                    'applicant_extension' => $request->applicant_extension,
                    'applicant_date_birth' => $request->applicant_date_birth,
                    'age' => $request->age,
                    'gender' => $request->gender,
                    'applicant_tel_no' => $request->applicant_tel_no,
                    'applicant_mobile_number' => $request->applicant_mobile_number,
                    'applicant_nationality' => $request->applicant_nationality,
                    'applicant_religion' => $request->applicant_religion,
                    'applicant_address_street' => $request->applicant_address_street,
                    'applicant_address_city' => $request->applicant_address_city,
                    'applicant_address_province' => $request->applicant_address_province,
                ]);

                // Create family information using the relationship
                $applicant->familyInfo()->create([
                    'father_name' => $request->father_name,
                    'father_contact' => $request->father_contact,
                    'mother_name' => $request->mother_name,
                    'mother_contact' => $request->mother_contact,
                    'guardian_name' => $request->guardian_name,
                    'guardian_contact' => $request->guardian_contact
                ]);

                // Handle file uploads
                $this->handleFileUploads($request, $applicant);

                return redirect()
                    ->route('admission.new')
                    ->with('success', 'Application submitted successfully');
            });

        } catch (\Exception $e) {
            \Log::error('Application submission error: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Error submitting application. Please try again. ' . $e->getMessage());
        }
    }

    protected function handleFileUploads(Request $request, ApplicantInfo $applicant)
    {
        $fileFields = [
            'birth_certificate' => 'birth_certificate_path',
            'photo' => 'photo_path',
            'form_137' => 'form_137_path',
            'form_138' => 'form_138_path',
            'good_moral' => 'good_moral_path',
            'guardian_id' => 'guardian_id_path',
            'medical_records' => 'medical_records_path'
        ];

        foreach ($fileFields as $inputName => $pathField) {
            if ($request->hasFile($inputName)) {
                $path = $request->file($inputName)->store('documents');
                $applicant->update([$pathField => $path]);
            }
        }
    }

    public function show($id)
    {
        $applicant = ApplicantInfo::with(['familyInfo', 'siblings', 'educationalBackground'])
            ->findOrFail($id);
        return view('admission.show', compact('applicant'));
    }

    public function new()
    {
        $applicants = ApplicantInfo::where('status', ApplicantInfo::STATUS_NEW)->get();
        return view('admission.new', compact('applicants'));
    }

    public function accepted()
    {
        $applicants = ApplicantInfo::where('status', ApplicantInfo::STATUS_ACCEPTED)->get();
        return view('admission.accepted', compact('applicants'));
    }

    public function rejected()
    {
        $applicants = ApplicantInfo::where('status', ApplicantInfo::STATUS_REJECTED)->get();
        return view('admission.rejected', compact('applicants'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', [
                ApplicantInfo::STATUS_NEW,
                ApplicantInfo::STATUS_ACCEPTED,
                ApplicantInfo::STATUS_REJECTED
            ])
        ]);

        $applicant = ApplicantInfo::findOrFail($id);
        $applicant->update(['status' => $request->status]);

        return back()->with('success', 'Application status updated successfully');
    }
}