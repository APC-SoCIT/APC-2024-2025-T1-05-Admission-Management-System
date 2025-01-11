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

 //Admin Panel and Online Appplication Portal Routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/portal', function () {
    return view('portal');
})->middleware(['auth', 'verified'])->name('portal'); //Added Route

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

    // Inquiry routes
    Route::prefix('inquiries')->group(function () {
        Route::get('/', [InquiryController::class, 'index'])->name('inquiry.index'); // List all inquiries
        Route::get('/{id}', [InquiryController::class, 'show'])->name('inquiry.show'); // Show single inquiry details
    });

    // Lead routes
    Route::prefix('inquiry_form')->group(function () {
        Route::get('/form', [LeadController::class, 'submit'])->name('inquiry_form.form'); // Display the inquiry form
        Route::post('/form', [LeadController::class, 'store'])->name('inquiry_form.store'); // Handle form submission
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