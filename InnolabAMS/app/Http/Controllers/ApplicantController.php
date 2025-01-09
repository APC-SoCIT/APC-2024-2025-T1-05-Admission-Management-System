<?php

namespace App\Http\Controllers;

use App\Models\ApplicantInfo;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function index()
    {
        $applicants = ApplicantInfo::with('user')->get();
        return view('applicants.index', compact('applicants'));
    }

    public function show($id)
    {
        $applicant = ApplicantInfo::with('user')->findOrFail($id);
        return view('applicants.show', compact('applicant'));
    }

    public function create()
    {
        return view('applicants.create');
    }

    public function store(Request $request)
    {
        // Add validation and storage logic here
    }
}