<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            // ... other validation rules ...

            // At least one guardian must be present
            'father_name' => 'required_without_all:mother_name,guardian_name',
            'mother_name' => 'required_without_all:father_name,guardian_name',
            'guardian_name' => 'required_without_all:father_name,mother_name',

            // If a guardian is specified, their contact is required
            'father_contact' => 'required_with:father_name',
            'mother_contact' => 'required_with:mother_name',
            'guardian_contact' => 'required_with:guardian_name',
        ], [
            'father_name.required_without_all' => 'Please provide information for at least one guardian (Father, Mother, or Guardian)',
            'mother_name.required_without_all' => 'Please provide information for at least one guardian (Father, Mother, or Guardian)',
            'guardian_name.required_without_all' => 'Please provide information for at least one guardian (Father, Mother, or Guardian)',
        ]);

        // ... rest of the store logic ...
    }
}
