<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ScholarshipController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::middleware(['auth'])->group(function () {
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
        // Applications
        Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
        Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
        Route::patch('/applications/{application}/status', [StatusController::class, 'update'])
            ->name('applications.status.update');

        // Application status routes
        Route::get('/applications/new', [ApplicationController::class, 'newApplications'])->name('applications.new');
        Route::get('/applications/accepted', [ApplicationController::class, 'acceptedApplications'])->name('applications.accepted');
        Route::get('/applications/rejected', [ApplicationController::class, 'rejectedApplications'])->name('applications.rejected');

        // Scholarship route
        Route::get('/scholarship', [ScholarshipController::class, 'index'])->name('scholarship');
    });
});

require __DIR__.'/auth.php';
