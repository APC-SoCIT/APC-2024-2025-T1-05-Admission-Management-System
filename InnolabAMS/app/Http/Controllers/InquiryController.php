<?php

namespace App\Http\Controllers;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{

    public function show(Request $request)
    {
        $scholarship = Inquiry::all();
        return view('inquiry.show', compact('inquiry'));
    }
}
