<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApplicantScholarshipController;
use App\Http\Controllers\ApplicantInfoController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\LeadController;
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
    // Admission Routes - grouping related routes together
    Route::prefix('admission')->name('admission.')->group(function () {
        Route::get('/', [ApplicantInfoController::class, 'index'])->name('index');
        Route::get('/new', [ApplicantInfoController::class, 'new'])->name('new');
        Route::get('/accepted', [ApplicantInfoController::class, 'accepted'])->name('accepted');
        Route::get('/rejected', [ApplicantInfoController::class, 'rejected'])->name('rejected');
        Route::get('/create', [ApplicantInfoController::class, 'create'])->name('create');
        Route::post('/', [ApplicantInfoController::class, 'store'])->name('store');
        Route::get('/{id}', [ApplicantInfoController::class, 'show'])->name('show');
        Route::patch('/{id}/status', [ApplicantInfoController::class, 'updateStatus'])->name('update-status'); // New route for updating status
    });

    // Scholarship Routes
    Route::get('/dashboard/scholarship', [ApplicantScholarshipController::class, 'show'])->name('scholarship.show');

    // Inquiry Routes
    Route::prefix('inquiry')->name('inquiry.')->group(function () {
        Route::get('/', [InquiryController::class, 'index'])->name('index');
        Route::get('/form', [LeadController::class, 'create'])->name('form');
    });

    // User Routes
    Route::get('/dashboard/users', [UserController::class, 'show'])->name('user.show');

    // Profile Routes
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';