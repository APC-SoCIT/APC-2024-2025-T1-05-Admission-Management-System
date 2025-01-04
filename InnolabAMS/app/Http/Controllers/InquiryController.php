<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    // Fetch all inquiries for the index page
    public function index()
    {
        $inquiries = Inquiry::all(); // Fetch all inquiries
        return view('inquiry.index', compact('inquiries'));
    }

    // Fetch a single inquiry for the show page
    public function show($id)
    {
        $inquiry = Inquiry::findOrFail($id); // Fetch a single inquiry by ID
        return view('inquiry.show', compact('inquiry'));
    }
}
