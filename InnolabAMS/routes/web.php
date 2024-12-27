<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Auth required routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Applications routes
    Route::middleware('role:admission_officer')->group(function () {
        Route::get('/applications/new', [ApplicationController::class, 'newApplications'])->name('applications.new');
        Route::get('/applications/accepted', [ApplicationController::class, 'acceptedApplications'])->name('applications.accepted');
        Route::get('/applications/rejected', [ApplicationController::class, 'rejectedApplications'])->name('applications.rejected');
    });

    // Scholarship routes
    Route::get('/scholarship', function () {
        return view('scholarship.index');
    })->name('scholarship');

    // Inquiries routes
    Route::get('/inquiries', function () {
        return view('inquiries.index');
    })->name('inquiries');

    // Users routes
    Route::get('/users', function () {
        return view('users.index');
    })->name('users');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
