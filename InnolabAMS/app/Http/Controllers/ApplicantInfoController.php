<?php

namespace App\Http\Controllers;

use App\Models\ApplicantInfo;
use Illuminate\Http\Request;

class ApplicantInfoController extends Controller
{
    public function index()
    {
        $applicants = ApplicantInfo::with('user')->get();
        return view('admission.index', compact('applicants'));
    }

    public function new()
    {
        $applicants = ApplicantInfo::with('user')
            ->where('status', 'new')
            ->get();
        return view('admission.new', compact('applicants'));
    }

    public function accepted()
    {
        $applicants = ApplicantInfo::with('user')
            ->where('status', 'accepted')
            ->get();
        return view('admission.accepted', compact('applicants'));
    }

    public function rejected()
    {
        $applicants = ApplicantInfo::with('user')
            ->where('status', 'rejected')
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
        // Add validation rules here based on your requirements
        $validated = $request->validate([
            'apply_program' => 'required',
            'apply_grade_level' => 'required',
            'applicant_surname' => 'required|max:40',
            'applicant_given_name' => 'required|max:40',
            // Add other validation rules
        ]);

        $applicant = ApplicantInfo::create($validated);
        return redirect()->route('admission.show', $applicant->id)
            ->with('success', 'Application created successfully');
    }
}