<?php

namespace App\Http\Controllers;

use App\Models\EducationalBackground;
use App\Models\ApplicantInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationalBackgroundController extends Controller
{
    /**
     * Show the form for creating educational background.
     */
    public function create()
    {
        // Get the authenticated user's applicant info
        $applicant = ApplicantInfo::where('user_id', Auth::id())->first();
        
        // Get existing educational background if any
        $educationalBackground = $applicant ? EducationalBackground::where('applicant_id', $applicant->id)->first() : null;
        
        return view('educational_background.create', compact('educationalBackground'));
    }

    /**
     * Store educational background information.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lrn' => 'nullable|string|max:12',
            'sped' => 'required|boolean',
            'pwd' => 'required|boolean',
            'applicant_school_name' => 'required|string|max:255',
            'applicant_school_address' => 'required|string|max:255',
            'applicant_last_grade_level' => 'required|string|in:1,2,3,4,5,6,7,8,9,10,11,12',
            'applicant_year_graduation' => 'required|date',
            'applicant_gwa' => 'required|numeric|between:0,100',
            'applicant_achievements' => 'nullable|string'
        ]);

        $applicant = ApplicantInfo::where('user_id', Auth::id())->firstOrFail();

        $educationalBackground = EducationalBackground::updateOrCreate(
            ['applicant_id' => $applicant->id],
            $request->all()
        );

        return response()->json([
            'success' => true,
            'message' => 'Educational background saved successfully',
            'redirect' => route('form.documents') // Adjust this route as needed
        ]);
    }

    /**
     * Update educational background information.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'lrn' => 'nullable|string|max:12',
            'sped' => 'required|boolean',
            'pwd' => 'required|boolean',
            'applicant_school_name' => 'required|string|max:255',
            'applicant_school_address' => 'required|string|max:255',
            'applicant_last_grade_level' => 'required|string|in:1,2,3,4,5,6,7,8,9,10,11,12',
            'applicant_year_graduation' => 'required|date',
            'applicant_gwa' => 'required|numeric|between:0,100',
            'applicant_achievements' => 'nullable|string'
        ]);

        $educationalBackground = EducationalBackground::findOrFail($id);
        
        // Check if the educational background belongs to the authenticated user
        $applicant = ApplicantInfo::where('user_id', Auth::id())->firstOrFail();
        if ($educationalBackground->applicant_id !== $applicant->id) {
            abort(403, 'Unauthorized action.');
        }

        $educationalBackground->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Educational background updated successfully'
        ]);
    }
}