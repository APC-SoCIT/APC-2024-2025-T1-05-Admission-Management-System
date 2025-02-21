<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class AddUserController extends Controller
{
    // Show the form to create a new user
    public function create()
    {
        return view('users.create');
    }

    // Handle the user creation process
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:Admin,Staff,Applicant',
        ]);


        // Create the new user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'), // Ensure role is being saved
        ]);


        // Assign the role to the user
        $role = Role::where('name', $request->role)->first();
        if ($role) {
            $user->assignRole($role);
            // Log the role assignment
            Log::info('Role assigned to user: ' . $role->name);
        }

        // Redirect to a specific route with a success message
        return redirect()->route('user.show')->with('success', 'User created successfully!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}