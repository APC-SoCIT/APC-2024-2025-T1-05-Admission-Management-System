<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicantInfo;
use Illuminate\Support\Facades\Auth;

class AdditionalInfoController extends Controller
{
    /**
     * Show the form for additional info.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {        
        // Get the authenticated user's applicant info
        $applicant = ApplicantInfo::where('user_id', Auth::id())->first();
        
        // Retrieve existing additional info if available
        $additionalInfo = $applicant ? ApplicantInfo::where('user_id', auth()->id())->first() : null;

        return view('additional_info.create', compact('additionalInfo'));
    }

    /**
     * Store or update additional information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'hobbies' => 'nullable|string|max:255',
            'skills' => 'nullable|string|max:255',
            'extracurricular_interest' => 'nullable|string|max:255',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_address' => 'nullable|string|max:255',
            'emergency_contact_tel' => 'nullable|string|max:15',
            'emergency_contact_mobile' => 'nullable|string|max:15',
            'emergency_contact_email' => 'nullable|email|max:255',
        ]);

        // Retrieve or create the applicant info
        $applicant = ApplicantInfo::where('user_id', Auth::id())->firstOrFail();

        $additionalInfo = ApplicantInfo::updateOrCreate(
            ['applicant_id' => $applicant->id],
            $request->all()
        );

        // Update the additional info
        $additionalInfo->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Additional information saved successfully.',
            'redirect' => route('form.scholarship'), // Update the redirect route as needed
        ]);
    }
}
