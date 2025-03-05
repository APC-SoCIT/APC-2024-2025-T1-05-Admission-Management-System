<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        $users = User::paginate(10); // Fetch all users from the database
        $adminCount = User::where('role', 'admin')->count();
        $staffCount = User::where('role', 'staff')->count();
        $applicantCount = User::where('role', 'applicant')->count();
        return view('user.show', compact('users', 'adminCount', 'staffCount', 'applicantCount')); // Pass users to the view
    }

    public function showAdmins()
    {
        $adminUsers = User::where('role', 'admin')->paginate(10);
        $adminCount = $adminUsers->count();
        $staffCount = User::where('role', 'staff')->count();
        $applicantCount = User::where('role', 'applicant')->count();

        return view('user.admin', compact('adminUsers', 'adminCount', 'staffCount', 'applicantCount'));
    }

    public function showStaffs()
    {
        $staffUsers = User::where('role', 'staff')->paginate(10);
        $staffCount = $staffUsers->count();
        $adminCount = User::where('role', 'admin')->count();
        $applicantCount = User::where('role', 'applicant')->count();

        return view('user.staff', compact('staffUsers', 'adminCount', 'staffCount', 'applicantCount'));
    }

    public function showApplicants()
    {
        $applicantUsers = User::where('role', 'applicant')->paginate(10);
        $applicantCount = $applicantUsers->count(); 
        $adminCount = User::where('role', 'admin')->count();
        $staffCount = User::where('role', 'staff')->count();

        return view('user.applicant', compact('applicantUsers', 'adminCount', 'staffCount', 'applicantCount'));
    }

}
