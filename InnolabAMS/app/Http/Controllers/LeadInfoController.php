<?php

namespace App\Http\Controllers;

use App\Models\LeadInfo;
use Illuminate\Http\Request;

class LeadInfoController extends Controller
{
    /**
     * Display a listing of the inquiries.
     */
    public function index()
    {
        $leadInfos = LeadInfo::all(); // Fetch all inquiries
        return view('inquiry.index', compact('leadInfos'));
    }

    /**
     * Display the details of a single inquiry.
     */
    public function show($id)
    {
        $leadInfo = LeadInfo::findOrFail($id);
        return view('inquiry.show', compact('leadInfo'));
    }

    /**
     * Show the form to create a new inquiry.
     */
    public function create()
    {
        return view('lead_info.create');
    }

    /**
     * Store a newly created inquiry.
     */
    public function store(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'lead_given_name' => 'required|string|max:225',
            'lead_surname' => 'required|string|max:225',
            'lead_middle_name' => 'nullable|string|max:225',
            'lead_extension' => 'nullable|string|max:10',
            'lead_email' => 'required|email|max:225',
            'lead_mobile_number' => 'required|string|max:13',
            'lead_address_city' => 'nullable|string|max:225',
            'inquired_details' => 'required|in:Application Requirements,Application Process,Tuition Fees,Scholarship Opportunities,Program Offerings,Admission Deadlines,Others',
            'lead_message' => 'nullable|string',
            'extracurricular_interest_lead' => 'nullable|string|max:225',
            'skills_lead' => 'nullable|in:Communication,Teamwork,Leadership,Problem-Solving,Time Management,Creativity,Adaptability,Technology-related,Others',
            'other_skills_lead' => 'nullable|string|max:225', //added field
            'desired_career' => 'nullable|string|max:225',
            'source' => 'nullable|array', // Source should be an array
        ]);

        // Convert 'source' array to JSON if provided
        $validated['source'] = $request->has('source') ? json_encode($request->source) : null;

        // Set default values
        $validated['inquiry_status'] = 'New';
        $validated['inquiry_submitted'] = now(); // Store current timestamp for submission

        // Create a new LeadInfo record
        LeadInfo::create($validated);

        // Redirect to the inquiry list with success message
        return redirect()->route('lead_info.create')->with('success', 'Inquiry submitted successfully!');
    }

    /**
     * Update an existing inquiry.
     */
    public function update(Request $request, $id)
    {
        // Validate the input data
        $validated = $request->validate([
            'lead_surname' => 'required|string|max:225',
            'lead_given_name' => 'required|string|max:225',
            'lead_email' => 'required|email|max:225',
            'inquired_details' => 'required|in:Application Requirements,Application Process,Tuition Fees,Scholarship Opportunities,Program Offerings,Admission Deadlines,Others',
            'inquiry_submitted' => 'nullable|date',
            'details_sent' => 'nullable|string|max:225',
            'response_date' => 'nullable|date',
        ]);

        // Find the existing inquiry
        $leadInfo = LeadInfo::findOrFail($id);

        // Update the record
        $leadInfo->update($validated);

        // Redirect back to inquiry list
        return redirect()->route('lead_info.index')->with('success', 'Inquiry submitted successfully!');
    }

    /**
     * Delete an inquiry.
     */
    public function destroy($id)
    {
        // Find and delete the inquiry
        $leadInfo = LeadInfo::findOrFail($id);
        $leadInfo->delete();

        // Redirect back to inquiry list with success message
        return redirect()->route('inquiry.index')->with('success', 'Inquiry deleted successfully!');
    }
}