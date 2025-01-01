<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    public function index()
    {
        $scholarship = Scholarship::all();
        return view('scholarship.index', compact('scholarship'));
    }

    public function show(Request $request)
    {
        $scholarship = Scholarship::all();
        return view('scholarship.show', compact('scholarship'));
    }
}