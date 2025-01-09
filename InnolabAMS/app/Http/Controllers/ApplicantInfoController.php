<?php

namespace App\Http\Controllers;

use App\Models\ApplicantInfo;
use App\Models\User;
use Illuminate\Http\Request;

class ApplicantInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ApplicantInfo $applicantInfo)
    {
       
    }

    public function new()
    {
        $applicants = ApplicantInfo::all();

        return view('admission.new', compact('applicants'));
    }

    // Method to return accepted.blade.php
    public function accepted()
    {
        return view('admission.accepted');
    }

    // Method to return rejected.blade.php
    public function rejected()
    {
        return view('admission.rejected');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApplicantInfo $applicantInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ApplicantInfo $applicantInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApplicantInfo $applicantInfo)
    {
        //
    }
}
