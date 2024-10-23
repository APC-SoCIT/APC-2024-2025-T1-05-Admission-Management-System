<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

$url = config('app.url');
URL::forceRootUrl($url);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/applicants/dashboard', [ApplicantDashboardController::class, 'index'])->name('applicants.dashboard');

Route::post('/applicants/update-profile', [ApplicantDashboardController::class, 'updateProfile'])->name('applicants.updateProfile');

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
