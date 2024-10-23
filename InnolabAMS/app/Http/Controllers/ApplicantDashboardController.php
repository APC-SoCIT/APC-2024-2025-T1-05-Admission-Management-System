<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ApplicantDashboardController extends Controller
{
    // Method to display the applicants' dashboard
    public function index()
    {
        return view('applicants.dashboard');
    }

    // Method to handle profile update
    public function updateProfile(Request $request)
    {
        // Validate and save the applicant's data
        $request->validate([
            'birthday' => 'required|date',
            'age' => 'required|numeric',
        ]);

        $applicant = Auth::user(); // Retrieve the authenticated applicant
        $applicant->birthday = $request->birthday;
        $applicant->age = $request->age;
        $applicant->save();

        return redirect()->route('applicants.dashboard')->with('success', 'Profile updated successfully.');
    }
}
