<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\InquiryController;
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

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admission Officer routes
    Route::middleware('role:admission_officer')->group(function () {
        // User routes
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

        // Applications routes
        Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
        Route::get('/applications/new', [ApplicationController::class, 'newApplications'])->name('applications.new');
        Route::get('/applications/accepted', [ApplicationController::class, 'acceptedApplications'])->name('applications.accepted');
        Route::get('/applications/rejected', [ApplicationController::class, 'rejectedApplications'])->name('applications.rejected');
        Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
        Route::patch('/applications/{application}/status', [StatusController::class, 'update'])
            ->name('applications.status.update');

        // Scholarship routes
        Route::get('/scholarship', [ScholarshipController::class, 'index'])->name('scholarship');
        Route::get('/scholarship/show', [ScholarshipController::class, 'show'])->name('scholarship.show');

        // Inquiries route
        Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');

    });
});

require __DIR__.'/auth.php';
