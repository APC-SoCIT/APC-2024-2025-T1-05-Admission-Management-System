<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show()
    {
        $dashboard = 'Welcome to the dashboard'; // Create a variable to hold the dashboard message
        return view('dashboard.show', compact('dashboard')); // Pass users to the view
    }
}
