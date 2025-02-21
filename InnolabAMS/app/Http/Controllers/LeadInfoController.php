<?php

namespace App\Http\Controllers;

use App\Models\LeadInfo;
use Illuminate\Http\Request;

class LeadInfoController extends Controller
{
    // Display a listing of the inquiries
    public function index()
    {
        $leadInfos = LeadInfo::all(); // Fetch all the inquiries from lead_info table
        return view('inquiry.index', compact('leadInfos'));
    }

    // Display the details of a single inquiry
    public function show($id)
    {
        $leadInfo = LeadInfo::findOrFail($id); // Find the lead info by ID
        return view('inquiry.show', compact('leadInfo'));
    }

    // Show the form to create a new inquiry
    public function create()
    {
        return view('lead_info.create');
    }


    // Store a newly created inquiry
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lead_given_name' => 'required|string|max:225',
            'lead_surname' => 'required|string|max:225',
            'lead_middle_name' => 'nullable|string|max:225',
            'lead_extension' => 'nullable|string|max:10',
            'lead_email' => 'required|email|max:225',
            'lead_mobile_number' => 'required|string|max:13',
            'lead_address_city' => 'nullable|string|max:225',
            'inquired_details' => 'required|in:OPTION_1,OPTION_2,OPTION_3',
            'lead_message' => 'nullable|string',
<<<<<<< HEAD
            'extracurricular_interest_lead' => 'nullable|string|max:225',
            'skills_lead' => 'nullable|in:Communication,Teamwork,Leadership,Problem-Solving,Time Management,Creativity,Adaptability,Technology-related,Others',
            'other_skills_lead' => 'nullable|string|max:225', //added field
            'desired_career' => 'nullable|string|max:225',
            'source' => 'nullable|array', // Source should be an array
=======
            'source' => 'nullable|array', // Validate source as an array
>>>>>>> 851876b (Revert "Merge branch 'feature/77_implement_admin_admission_management' of https://github.com/APC-SoCIT/APC-2024-2025-T1-05-Admission-Management-System into feature/77_implement_admin_admission_management")
        ]);
        
        // Convert 'source' to a JSON string or handle it as needed
        $validated['source'] = $request->has('source') ? json_encode($request->source) : null;        

        // Set default 'inquiry_status' to 'New' before creating
        $validated['inquiry_status'] = 'New';

        // Create a new LeadInfo record
        LeadInfo::create($validated);

        // Redirect to the inquiry form or wherever appropriate
        return redirect()->route('lead_info.create')->with('success', 'Inquiry submitted successfully!');
    }

    // // Show the form to edit an inquiry
    // public function edit($id)
    // {
    //     $leadInfo = LeadInfo::findOrFail($id); // Retrieve the inquiry to edit
    //     return view('lead_info.edit', compact('leadInfo')); // Show the edit form
    // }

    // Update an existing inquiry
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'lead_surname' => 'required|string|max:225',
            'lead_given_name' => 'required|string|max:225',
            'lead_email' => 'required|email|max:225',
<<<<<<< HEAD
            'inquired_details' => 'required|in:Application Requirements,Application Process,Tuition Fees,Scholarship Opportunities,Program Offerings,Admission Deadlines,Others',
=======
            'inquired_details' => 'required|in:OPTION_1,OPTION_2,OPTION_3',
>>>>>>> 851876b (Revert "Merge branch 'feature/77_implement_admin_admission_management' of https://github.com/APC-SoCIT/APC-2024-2025-T1-05-Admission-Management-System into feature/77_implement_admin_admission_management")
            'inquiry_submitted' => 'nullable|date',
            'details_sent' => 'nullable|string|max:225',
            'response_date' => 'nullable|date',
            // Add other fields as necessary
        ]);

        // Find the existing LeadInfo record
        $leadInfo = LeadInfo::findOrFail($id);

        // Update the inquiry
        $leadInfo->update($validated);

        // Redirect back to the inquiry list or wherever appropriate
        return redirect()->route('lead_info.create')->with('success', 'Inquiry updated successfully!');
    }

    // Delete an inquiry
    public function destroy($id)
    {
        // Find the inquiry and delete it
        $leadInfo = LeadInfo::findOrFail($id);
        $leadInfo->delete();

        // Redirect back to the list of inquiries
        return redirect()->route('inquiry.index')->with('success', 'Inquiry deleted successfully!');
    }
}