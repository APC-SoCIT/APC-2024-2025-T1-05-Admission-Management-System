<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApplicantScholarshipController;
use App\Http\Controllers\ApplicantInfoController;
use App\Http\Controllers\FamilyInformationController;
use App\Http\Controllers\EducationalBackgroundController;
use App\Http\Controllers\AdditionalInfoController;
use App\Http\Controllers\LeadInfoController;
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

//Lead_Info routes
Route::prefix('lead_info')->name('lead_info.')->group(function () {
    // Route to display the inquiry form (create)
    Route::get('/create', [LeadInfoController::class, 'create'])->name('create');
    // Route to store a new inquiry
    Route::post('/store', [LeadInfoController::class, 'store'])->name('store');
    // Route to display the edit form for an inquiry
    // Route::get('/{id}/edit', [LeadInfoController::class, 'edit'])->name('edit');
});

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
        Route::get('/', [LeadInfoController::class, 'index'])->name('inquiry.index'); // List all inquiries
        Route::get('/{id}', [LeadInfoController::class, 'show'])->name('inquiry.show'); // Show single inquiry details
        // Route to update the inquiry
        Route::put('/{id}', [LeadInfoController::class, 'update'])->name('update');
        // Route to delete an inquiry
        Route::delete('/{id}', [LeadInfoController::class, 'destroy'])->name('destroy');
    });

    // User Routes
    Route::get('/dashboard/users', [UserController::class, 'show'])->name('user.show');

    // Profile Routes
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    //Personal Information Routes
    Route::prefix('form')->name('form.')->group(function () {
        Route::get('/portal/personal-information', [ApplicantInfoController::class, 'showPersonalInfoForm'])->name('personal_info'); //Added Route
        Route::post('/', [ApplicantInfoController::class, 'storeForm'])->name('store'); //Added Route
    });


    //Family Information Routes
    Route::prefix('family-information')->name('family-information.')->group(function () {
        Route::get('/create', [FamilyInformationController::class, 'create'])->name('create');
        Route::post('/', [FamilyInformationController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [FamilyInformationController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [FamilyInformationController::class, 'update'])->name('update');
    });

    //Educational Background Routes
    Route::prefix('educational-background')->name('educational-background.')->group(function () {
        Route::get('/create', [EducationalBackgroundController::class, 'create'])->name('create');
        Route::post('/', [EducationalBackgroundController::class, 'store'])->name('store');
        Route::patch('/{id}', [EducationalBackgroundController::class, 'update'])->name('update');
    });

    //Additional InfoRoutes
    Route::prefix('additional_info')->name('additional_info.')->group(function () {
        Route::get('/create', [AdditionalInfoController::class, 'create'])->name('create');
        Route::post('/', [AdditionalInfoController::class, 'store'])->name('store');
    });

    //Personal Information Routes
    Route::prefix('form')->name('scholarship.')->group(function() {
        Route::get('/portal/scholarship', [ApplicantInfoController::class, 'showScholarshipForm'])->name('create'); //Added Route
        
    });

});

require __DIR__ . '/auth.php';