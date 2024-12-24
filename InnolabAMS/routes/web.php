<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\StatusController;
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

    // User routes
    Route::get('/dashboard/users', [UserController::class, 'show'])->name('user.show');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Document viewing (accessible by all authenticated users)
    Route::get('/documents/{document}', [ApplicationController::class, 'viewDocument'])
        ->name('documents.view');

    // Admission Officer routes
    Route::middleware('role:admission_officer')->group(function () {
        // Applications
        Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
        Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
        Route::patch('/applications/{application}/status', [StatusController::class, 'update'])
            ->name('applications.status.update');

        // Officer Dashboard
        Route::get('/officer/dashboard', [ApplicationController::class, 'officerDashboard'])
            ->name('officer.dashboard');
    });
});

require __DIR__.'/auth.php';
