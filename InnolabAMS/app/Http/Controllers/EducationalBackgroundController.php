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
    public function store(Request $request, ApplicantInfo $applicant)
    {
        $validated = $request->validate([
            'lrn' => 'nullable|string|max:12',
            'school_name' => 'required|string|max:255',
            'school_address' => 'required|string|max:255',
            'previous_program' => 'nullable|string|max:255',
            'year_of_graduation' => 'nullable|string|max:4',
            'awards_honors' => 'nullable|string',
            'gwa' => 'nullable|numeric|between:1.00,5.00'
        ]);

        try {
            $educationalBackground = EducationalBackground::create([
                'applicant_info_id' => $applicant->id,
                ...$validated
            ]);

            return response()->json([
                'message' => 'Educational background saved successfully',
                'data' => $educationalBackground
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error saving educational background'
            ], 500);
        }
    }

    /**
     * Update educational background information.
     */
    public function update(Request $request, ApplicantInfo $applicant)
    {
        $validated = $request->validate([
            'lrn' => 'nullable|string|max:12',
            'school_name' => 'required|string|max:255',
            'school_address' => 'required|string|max:255',
            'previous_program' => 'nullable|string|max:255',
            'year_of_graduation' => 'nullable|string|max:4',
            'awards_honors' => 'nullable|string',
            'gwa' => 'nullable|numeric|between:1.00,5.00'
        ]);

        try {
            $educationalBackground = $applicant->educationalBackground;
            
            if (!$educationalBackground) {
                return response()->json([
                    'error' => 'Educational background not found'
                ], 404);
            }

            $educationalBackground->update($validated);

            return response()->json([
                'message' => 'Educational background updated successfully',
                'data' => $educationalBackground
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error updating educational background'
            ], 500);
        }
    }
}