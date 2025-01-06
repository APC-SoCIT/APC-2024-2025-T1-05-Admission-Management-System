<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    // Fetch all inquiries for the index page
    public function index()
    {
        return view('inquiry.index'); // Maps to resources/views/inquiry/index.blade.php
    }

    public function show($id)
    {
        return view('inquiry.show', compact('id')); // Maps to resources/views/inquiry/show.blade.php
    }
}
