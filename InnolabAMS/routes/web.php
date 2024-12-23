<?php

use App\Http\Controllers\ProfileController;
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\ApplicationController;

Route::middleware(['auth'])->group(function () {
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::patch('/applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('applications.status');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/documents/{document}', [ApplicationController::class, 'viewDocument'])
        ->name('documents.view');
});

require __DIR__.'/auth.php';
