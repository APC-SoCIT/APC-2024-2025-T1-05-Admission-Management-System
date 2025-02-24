<?php

namespace App\Http\Controllers;

use App\Models\ApplicantInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{
    public function index()
    {
        $applicants = ApplicantInfo::with('user')->get();
        return view('applicants.index', compact('applicants'));
    }

    public function show($id)
    {
        $applicant = ApplicantInfo::with('user')->findOrFail($id);
        return view('applicants.show', compact('applicant'));
    }

    public function create()
    {
        return view('applicants.create');
    }

    public function store(Request $request)
    {
        // Add this at the beginning of the store method
        \Log::info('Files received:', [
            'has_birth_cert' => $request->hasFile('birth_certificate'),
            'has_form_137' => $request->hasFile('form_137'),
            'has_form_138' => $request->hasFile('form_138'),
            'has_id_picture' => $request->hasFile('id_picture'),
            'has_good_moral' => $request->hasFile('good_moral'),
        ]);

        try {
            // Validate the request
            $validatedData = $request->validate([
                // Existing validation rules for applicant info
                'apply_program' => 'required',
                'apply_grade_level' => 'required',
                'apply_strand' => 'required_if:apply_program,Senior High School',
                'student_type' => 'required',
                'applicant_surname' => 'required',
                'applicant_given_name' => 'required',
                'gender' => 'required',
                'applicant_date_birth' => 'required|date',
                'applicant_place_birth' => 'required',
                'applicant_nationality' => 'required',
                'applicant_mobile_number' => 'required',
                'applicant_email' => 'required|email|max:255|unique:applicant_infos,applicant_email',
                'applicant_address_city' => 'required',
                'applicant_barangay' => 'required',
                'applicant_address_street' => 'required',

            // File validation rules
            'birth_certificate' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'form_137' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'form_138' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'id_picture' => 'required|file|mimes:jpg,jpeg,png|max:1024',
            'good_moral' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

            // Handle file uploads
            $paths = [];
            $fileFields = ['birth_certificate', 'form_137', 'form_138', 'id_picture', 'good_moral'];

            foreach ($fileFields as $field) {
                if ($request->hasFile($field) && $request->file($field)->isValid()) {
                    $path = $request->file($field)->store("documents/$field", 'public');
                    $paths["{$field}_path"] = $path;
                }
            }

            // Merge the file paths with other data
            $applicantData = array_merge($request->except($fileFields), $paths);

            // Create the applicant record
            $applicant = ApplicantInfo::create($applicantData);

            return redirect()->route('applicants.show')
                ->with('success', 'Application submitted successfully.');

        } catch (\Exception $e) {
            // Delete any uploaded files if there was an error
            foreach ($paths ?? [] as $path) {
                Storage::disk('public')->delete($path);
            }

            \Log::error('Application submission error: ' . $e->getMessage());
            return back()->with('error', 'Error submitting application. Please try again.')
                ->withInput();
        }
    }

    // Add this method to handle file downloads
    public function downloadFile($id, $documentType)
    {
        $applicant = ApplicantInfo::findOrFail($id);

        $pathMap = [
            'birth_certificate' => $applicant->birth_certificate_path,
            'form_137' => $applicant->form_137_path,
            'form_138' => $applicant->form_138_path,
            'id_picture' => $applicant->id_picture_path,
            'good_moral' => $applicant->good_moral_path,
        ];

        if (!isset($pathMap[$documentType])) {
            abort(404);
        }

        $path = $pathMap[$documentType];

        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }

        $fullPath = Storage::disk('public')->path($path);
        return response()->file($fullPath);
    }
}
