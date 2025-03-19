<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function showSchoolInfo()
    {
        return view('school.show');
    }
}