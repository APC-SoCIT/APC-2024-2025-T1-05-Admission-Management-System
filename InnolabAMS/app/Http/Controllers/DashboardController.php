<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalApplications' => Application::count(),
            'acceptedApplications' => Application::where('status', 'accepted')->count(),
            'rejectedApplications' => Application::where('status', 'rejected')->count(),
        ]);
    }
}
