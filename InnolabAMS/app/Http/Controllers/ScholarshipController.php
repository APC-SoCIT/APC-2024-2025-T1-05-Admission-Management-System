<?php

namespace App\Http\Controllers;
use App\Models\Scholarship;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    public function show(Request $request)
    {
        $scholarship = Scholarship::all();
        // Fetch all scholarship from the database
        return view('scholarship.show', compact('scholarship')); // Pass users to the view
    }
}
