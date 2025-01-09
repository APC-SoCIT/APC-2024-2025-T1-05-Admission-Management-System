<?php

namespace App\Http\Controllers;

use App\Models\ApplicantInfo;
use Illuminate\Http\Request;

class ApplicantInfoController extends Controller
{
    public function index()
    {
        $applicants = ApplicantInfo::with('user')
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
            )
            ->orderBy('id', 'desc')
            ->get();

        return view('admission.index', compact('applicants'));
    }

    public function new()
    {
        $applicants = ApplicantInfo::with('user')
            ->where('status', 'new')
            ->orderBy('id', 'desc')
            ->get();
        return view('admission.new', compact('applicants'));
    }

    public function accepted()
    {
        $applicants = ApplicantInfo::with('user')
            ->where('status', 'accepted')
            ->orderBy('id', 'desc')
            ->get();
        return view('admission.accepted', compact('applicants'));
    }

    public function rejected()
    {
        $applicants = ApplicantInfo::with('user')
            ->where('status', 'rejected')
            ->orderBy('id', 'desc')
            ->get();
        return view('admission.rejected', compact('applicants'));
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
        $validated = $request->validate([
            'apply_program' => 'required|in:Kindergarten,Elementary,High School,Senior High School',
            'apply_grade_level' => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12',
            'apply_strand' => 'nullable|required_if:apply_program,Senior High School|in:STEM,ABM,TECHVOC,HUMSS,GAS',
            'applicant_surname' => 'required|max:40',
            'applicant_given_name' => 'required|max:40',
            'applicant_middle_name' => 'nullable|max:40',
            'applicant_extension' => 'nullable|max:10',
            'applicant_date_birth' => 'required|date',
            'applicant_place_birth' => 'required|max:255',
            'gender' => 'required|in:Male,Female',
            'applicant_address_street' => 'required|max:255',
            'applicant_address_province' => 'required|max:255',
            'applicant_address_city' => 'required|max:255',
            'applicant_nationality' => 'required|max:255',
            'applicant_religion' => 'nullable|max:255',
            'applicant_mobile_number' => 'required|max:12',
            'applicant_photo' => 'nullable|image|max:2048',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'new';

        if ($request->hasFile('applicant_photo')) {
            $path = $request->file('applicant_photo')->store('applicant-photos', 'public');
            $validated['applicant_photo'] = $path;
        }

        $applicant = ApplicantInfo::create($validated);

        return redirect()
            ->route('admission.show', $applicant->id)
            ->with('success', 'Application created successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:new,accepted,rejected'
        ]);

        $applicant = ApplicantInfo::findOrFail($id);
        $applicant->status = $request->status;
        $applicant->save();

        return redirect()
            ->back()
            ->with('success', 'Application status updated successfully');
    }
}