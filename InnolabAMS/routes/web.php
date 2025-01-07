<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController; // Added Controller
use App\Http\Controllers\ScholarshipController; // Added Controller
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/users', [UserController::class, 'show'])->name('user.show'); //Added Route
    Route::get('/dashboard/scholarship', [ScholarshipController::class, 'show'])->name('scholarship.show'); //Added Route
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
