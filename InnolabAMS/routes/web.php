<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/users', [UserController::class, 'show'])->name('user.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admission_officer'])->group(function () {
    Route::get('/officer/dashboard', [ApplicationController::class, 'officerDashboard'])
        ->name('officer.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/applications', [ApplicationController::class, 'index'])
        ->middleware('role:admission_officer')  // Try this instead of group middleware
        ->name('applications.index');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/documents/{document}', [ApplicationController::class, 'viewDocument'])
        ->name('documents.view');
});

require __DIR__.'/auth.php';

