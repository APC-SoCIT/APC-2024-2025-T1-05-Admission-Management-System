<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController; // Added Controller
use App\Http\Controllers\ApplicantScholarshipController; // Added Controller
use App\Http\Controllers\InquiryController; // Added Controller
use App\Http\Controllers\LeadController; // Added Controller
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

$url = config('app.url');
URL::forceRootUrl($url);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/users', [UserController::class, 'show'])->name('user.show'); //Added Route
    Route::get('/dashboard/scholarship', [ApplicantScholarshipController::class, 'show'])->name('scholarship.show'); //Added Route
    Route::get('/dashboard/inquiry', [InquiryController::class, 'show'])->name('inquiry.show'); // Added Route
    Route::get('/dashboard/inquiry', [InquiryController::class, 'index'])->name('inquiry.index'); // Added Route
    Route::get('/inquiry_form', [LeadController::class, 'create'])->name('inquiry_form.form'); // Added Route
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
