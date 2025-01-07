<?php

namespace App\Http\Controllers;
use App\Models\ApplicantScholarship;
use Illuminate\Http\Request;

class ApplicantScholarshipController extends Controller
{
    public function show(Request $request)
    {
        $scholarship = ApplicantScholarship::all();
        // Fetch all scholarship from the database
        return view('scholarship.show', compact('scholarship')); // Pass users to the view
    }

    public function store(Request $request)
    {
        $request->validate([
            'applicant_info_id' => 'required|exists:applicant_info,id',
            'current_scholarship' => 'nullable|string|max:225',
            'annual_household_income' => 'required|in:Below 150,000,150,000 - 300,000,300,001 - 500,000,500,001 - 750,000,750,001 - 1,000,000,Above 1,000,000',
            'applicant_signature' => 'required|string|max:225',
            'parent_signature' => 'required|string|max:225',
            'scholarship_document' => 'nullable|string|max:225',
        ]);
        
        ApplicantScholarship::create([
            'applicant_info_id' => $request->applicant_info_id,
            'current_scholarship' => $request->current_scholarship,
            'annual_household_income' => $request->annual_household_income,
            'applicant_signature' => $request->applicant_signature,
            'parent_signature' => $request->parent_signature,
            'scholarship_document' => $request->scholarship_document,
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Your inquiry has been submitted successfully!');
    }
}
