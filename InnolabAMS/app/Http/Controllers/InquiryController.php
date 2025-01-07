<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    // Fetch all inquiries for the index page
    public function index()
    {
        $inquiries = Inquiry::all(); // Fetch all inquiries from the database
        return view('inquiry.index', compact('inquiries'));
    }

    public function show($id)
    {
        return view('inquiry.show', compact('id')); // Maps to resources/views/inquiry/show.blade.php
    }
}
