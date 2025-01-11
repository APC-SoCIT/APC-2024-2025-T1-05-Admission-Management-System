<?php

namespace App\Http\Controllers;

use App\Models\LeadInfo;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    // Show the form
    public function create()
    {
        return view('inquiry_form.form', compact("inquiry_form")); // Blade file for the form
    }

    // Store the form data in the database
    public function store(Request $request)
    {
        // Validate the form inputs
        $validated = $request->validate([
            'lead_given_name' => 'required|string|max:225',
            'lead_surname' => 'required|string|max:225',
            'lead_middle_name' => 'nullable|string|max:225',
            'lead_extension' => 'nullable|string|max:10',
            'lead_email' => 'required|email|max:225',
            'lead_mobile_number' => 'required|string|max:13',
            'lead_address_city' => 'nullable|string|max:225',
            'inquired_details' => 'required|string',
            'lead_message' => 'nullable|string',
        ]);

        // Save the data to the database
        LeadInfo::submit([
            'lead_given_name' => $validated['lead_given_name'],
            'lead_surname' => $validated['lead_surname'],
            'lead_middle_name' => $validated['lead_middle_name'],
            'lead_extension' => $validated['lead_extension'],
            'lead_email' => $validated['lead_email'],
            'lead_mobile_number' => $validated['lead_mobile_number'],
            'lead_address_city' => $validated['lead_address_city'],
            'inquired_details' => $validated['inquired_details'],
            'lead_message' => $validated['lead_message'],
            'extracurricular_interest_lead' => implode(',', $request->input('source', [])), // Handle checkboxes
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Your inquiry has been submitted successfully!');
    }
}
