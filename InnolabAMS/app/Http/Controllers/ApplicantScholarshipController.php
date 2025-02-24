<?php

namespace App\Http\Controllers;
use App\Models\ApplicantScholarship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicantScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_scholarship' => 'required|string|max:225',
            'annual_household_income' => 'required|string',
            'applicant_signature' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'parent_signature' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Check if user has applicant info
        $user = auth()->user();
        if (!$user->applicant_info) {
            return redirect()->route('scholarship.create')
                ->with('error', 'Please complete your application form first.');
        }

        // Handle file uploads
        $applicantSignaturePath = $request->file('applicant_signature')->store('signatures', 'public');
        $parentSignaturePath = $request->file('parent_signature')->store('signatures', 'public');

        // Create scholarship application
        try {
            $scholarship = ApplicantScholarship::create([
                'applicant_info_id' => $user->applicant_info->id,
                'current_scholarship' => $request->current_scholarship,
                'annual_household_income' => $request->annual_household_income,
                'applicant_signature' => $applicantSignaturePath,
                'parent_signature' => $parentSignaturePath
            ]);

            return redirect()->route('scholarship.create')
                ->with('success', 'Scholarship application submitted successfully!');
        } catch (\Exception $e) {
            // Delete uploaded files if database insert fails
            Storage::disk('public')->delete([$applicantSignaturePath, $parentSignaturePath]);

            return redirect()->route('scholarship.create')
                ->with('error', 'Failed to submit scholarship application. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $scholarships = ApplicantScholarship::with('applicant_info')->get();
        return view('scholarship.show', compact('scholarships'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApplicantScholarship $applicantScholarship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ApplicantScholarship $applicantScholarship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApplicantScholarship $applicantScholarship)
    {
        //
    }

    public function showScholarshipForm()
    {
        return view('scholarship.create');
    }
}
