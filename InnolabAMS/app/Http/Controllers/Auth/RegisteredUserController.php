<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role; // Add this import
use App\Mail\UserWelcomeMail; // Add this import
use Illuminate\Support\Facades\Mail; // Add this import

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create the new user
        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Check if this is the first user being created
        if (User::count() == 1) {
            // Assign the 'Admin' role to the first user
            $adminRole = Role::firstOrCreate(['name' => 'Admin']);
            $user->assignRole($adminRole);
        } else {
            // Assign the 'Applicant' role to subsequent users
            $applicantRole = Role::firstOrCreate(['name' => 'Applicant']);
            $user->assignRole($applicantRole);
        }

        // Fire the Registered event
        event(new Registered($user));

        // Send the user a welcome email
        Mail::to($user->email)->send(new UserWelcomeMail($user));

        // Log in the user
        Auth::login($user);

        // Redirect to the portal
        return redirect()->route('portal');
    }
}
