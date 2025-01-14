<?php

namespace App\Http\Controllers;

use App\Models\FamilyInfo;
use App\Models\SiblingInfo;
use App\Models\ApplicantInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilyInformationController extends Controller
{
    public function create()
    {
        // Get the current user's applicant info
        $applicantInfo = ApplicantInfo::where('user_id', Auth::id())->first();
        
        // Check if family info already exists
        $familyInfo = FamilyInfo::where('applicant_id', $applicantInfo->id)->first();
        
        // If exists, redirect to edit
        if ($familyInfo) {
            return redirect()->route('family-information.edit', $familyInfo->id);
        }
        
        return view('family_information.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Father's Information
            'father_surname' => 'nullable|string|max:255',
            'father_given_name' => 'nullable|string|max:255',
            'father_middle_name' => 'nullable|string|max:255',
            'father_occupation' => 'nullable|string|max:255',
            'father_contact_num' => 'nullable|string|max:12',
            
            // Mother's Information
            'mother_surname' => 'nullable|string|max:255',
            'mother_given_name' => 'nullable|string|max:255',
            'mother_middle_name' => 'nullable|string|max:255',
            'mother_occupation' => 'nullable|string|max:255',
            'mother_contact_num' => 'nullable|string|max:12',
            
            // Guardian's Information
            'guardian_info' => 'nullable|in:Same as Father,Same as Mother',
            'guardian_surname' => 'required|string|max:255',
            'guardian_given_name' => 'required|string|max:255',
            'guardian_middle_name' => 'required|string|max:255',
            'guardian_address_street' => 'nullable|string|max:255',
            'guardian_address_city' => 'nullable|string|max:255',
            'guardian_contact_num' => 'required|string|max:255',
            'guardian_email' => 'nullable|email|max:255',
            
            // Siblings Information
            'siblings' => 'nullable|array',
            'siblings.*.sibling_surname' => 'nullable|string|max:255',
            'siblings.*.sibling_given_name' => 'nullable|string|max:255',
            'siblings.*.sibling_age' => 'nullable|integer',
            'siblings.*.sibling_school_name' => 'nullable|string|max:255',
            'siblings.*.sibling_school_address' => 'nullable|string|max:255',
            'siblings.*.sibling_grade_level' => 'nullable|string|max:255',
        ]);

        // Get current user's applicant info
        $applicantInfo = ApplicantInfo::where('user_id', Auth::id())->firstOrFail();

        // Create family info
        $familyInfo = FamilyInfo::create([
            'applicant_id' => $applicantInfo->id,
            ...$validated
        ]);

        // Create siblings if any
        if (isset($validated['siblings'])) {
            foreach ($validated['siblings'] as $siblingData) {
                if (!empty(array_filter($siblingData))) {  // Only create if at least one field is filled
                    $familyInfo->siblings()->create($siblingData);
                }
            }
        }

        // Redirect to the next step or back to the application process
        return redirect()->route('additional-information.create')
            ->with('success', 'Family information saved successfully!');
    }

    public function edit($id)
    {
        $familyInfo = FamilyInfo::with('siblings')->findOrFail($id);
        
        // Check if the family info belongs to the current user
        if ($familyInfo->applicant->user_id !== Auth::id()) {
            abort(403);
        }
        
        return view('family_information.edit', compact('familyInfo'));
    }

    public function update(Request $request, $id)
    {
        // Similar validation as store method
        $validated = $request->validate([/* Same validation rules as store */]);

        $familyInfo = FamilyInfo::findOrFail($id);
        
        // Check if the family info belongs to the current user
        if ($familyInfo->applicant->user_id !== Auth::id()) {
            abort(403);
        }

        // Update family info
        $familyInfo->update($validated);

        // Handle siblings update
        if (isset($validated['siblings'])) {
            // Remove existing siblings
            $familyInfo->siblings()->delete();
            
            // Create new siblings
            foreach ($validated['siblings'] as $siblingData) {
                if (!empty(array_filter($siblingData))) {
                    $familyInfo->siblings()->create($siblingData);
                }
            }
        }

        return redirect()->back()->with('success', 'Family information updated successfully!');
    }
}