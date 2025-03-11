<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddUserController;
use App\Http\Controllers\ApplicantScholarshipController;
use App\Http\Controllers\ApplicantInfoController;
use App\Http\Controllers\DashboardController; //Added dashboard controller
use App\Http\Controllers\FamilyInformationController;
use App\Http\Controllers\EducationalBackgroundController;
use App\Http\Controllers\AdditionalInfoController;
use App\Http\Controllers\LeadInfoController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

$url = config('app.url');
URL::forceRootUrl($url);

//Login Routes
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->hasRole('Applicant')) {
            return redirect('/portal');
        } elseif (auth()->user()->hasRole('Admin')) {
            return redirect('/dashboard');
        } elseif (auth()->user()->hasRole('Staff')) {
            return redirect('/app');
        }
    }
    return view('auth.login');
});

//Admin Panel and Applicant Portal Routes
Route::get('/app', function () {
    if (auth()->check()) {
        if (auth()->user()->hasRole('Admin')) {
            return redirect('/dashboard');  // Redirect Admin to dashboard
        } elseif (auth()->user()->hasRole('Applicant')) {
            return redirect('/portal');
        }
    }
    return view('application');
})->middleware(['auth', 'verified'])->name('application');

Route::get('/portal', function () {
    if (auth()->check() && (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Staff'))) {
        return redirect('/app');
    }
    return view('portal');
})->middleware(['auth', 'verified'])->name('portal');

Route::get('/dashboard', function () {
    if (auth()->check()) {
        if (auth()->user()->hasRole('Staff')) {
            return redirect('/app');
        } elseif (auth()->user()->hasRole('Applicant')) {
            return redirect('/portal');
        }
    }
    return view('dashboard');  // Admin stays here
})->middleware(['auth', 'verified'])->name('dashboard');



//Dashboard Route
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->hasRole('Staff')) {
            return redirect('/app');
        }

        if (auth()->user()->hasRole('Applicant')) {
            return redirect('/portal');
        }
        return view('dashboard');
    })->name('dashboard');

    // Add only the analytics endpoint
    Route::get('/dashboard/analytics', [DashboardController::class, 'getAnalytics'])
        ->name('dashboard.analytics');

    Route::get('/dashboard/export', [DashboardController::class, 'exportAnalytics'])
        ->name('dashboard.export');
});


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
        Route::get('/students/{studentId}', [ApplicantInfoController::class, 'lookup'])
            ->name('student.lookup');
        Route::get('/{id}/download/{documentType}', [ApplicantInfoController::class, 'downloadFile'])
            ->name('admission.download-file');

    });
});

// Scholarship Routes
Route::middleware('auth')->group(function () {
    Route::get('/scholarship', function () {
        if (auth()->user()->hasRole('Staff')) {
            return redirect('/app');
        }
        if (auth()->user()->hasRole('Applicant')) {
            return redirect('/portal');
        }
        return app(ApplicantScholarshipController::class)->show();
    })->name('scholarship.show');

});
// Inquiry routes
Route::middleware('auth')->group(function () {
    Route::prefix('user')->prefix('inquiries')->name('inquiry.')->group(function () {
        Route::get('/', function () {
            if (auth()->user()->hasRole('Staff')) {
                return redirect('/app');
            }
            if (auth()->user()->hasRole('Applicant')) {
                return redirect('/portal');
            }
            return app(LeadInfoController::class)->index();
        })->name('index');

        Route::get('/{id}', function ($id) {
            if (auth()->user()->hasRole('Staff')) {
                return redirect('/app');
            }
            if (auth()->user()->hasRole('Applicant')) {
                return redirect('/portal');
            }
            return app(LeadInfoController::class)->show($id);
        })->name('show');

        Route::put('/{id}', function ($id) {
            if (auth()->user()->hasRole('Staff')) {
                return redirect('/app');
            }
            if (auth()->user()->hasRole('Applicant')) {
                return redirect('/portal');
            }
            return app(LeadInfoController::class)->update(request(), $id);
        })->name('update');

        Route::delete('/{id}', function ($id) {
            if (auth()->user()->hasRole('Staff')) {
                return redirect('/app');
            }
            if (auth()->user()->hasRole('Applicant')) {
                return redirect('/portal');
            }
            return app(LeadInfoController::class)->destroy($id);
        })->name('destroy');
    });
});

// User Routes
Route::middleware('auth')->group(function () {
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', function () {
            if (auth()->user()->hasRole('Staff')) {
                return redirect('/app');
            }
            if (auth()->user()->hasRole('Applicant')) {
                return redirect('/portal');
            }
            return app(UserController::class)->show();
        })->name('show');

        Route::get('/admin', function () {
            if (auth()->user()->hasRole('Staff')) {
                return redirect('/app');
            }
            if (auth()->user()->hasRole('Applicant')) {
                return redirect('/portal');
            }
            return app(UserController::class)->showAdmins();
        })->name('admin');

        Route::get('/staff', function () {
            if (auth()->user()->hasRole('Staff')) {
                return redirect('/app');
            }
            if (auth()->user()->hasRole('Applicant')) {
                return redirect('/portal');
            }
            return app(UserController::class)->showStaffs();
        })->name('staff');

        Route::get('/applicant', function () {
            if (auth()->user()->hasRole('Staff')) {
                return redirect('/app');
            }
            if (auth()->user()->hasRole('Applicant')) {
                return redirect('/portal');
            }
            return app(UserController::class)->showApplicants();
        })->name('applicant');

        Route::post('/', function () {
            if (auth()->user()->hasRole('Staff')) {
                return redirect('/app');
            }
            return app(AddUserController::class)->store(request());
        })->name('store');
    });
});

// Profile Routes
Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'edit')->name('profile.edit');
    Route::patch('/profile', 'update')->name('profile.update');
    Route::delete('/profile', 'destroy')->name('profile.destroy');
});


//Applicant Panel Routes

//Application Form Routes
Route::prefix('form')->name('form.')->group(function () {
    Route::get('/portal/application-form', [ApplicantInfoController::class, 'showApplicationForm'])->name('application'); //Changed Route
    Route::post('/', [ApplicantInfoController::class, 'storeForm'])->name('store');
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
Route::prefix('form')->name('scholarship.')->group(function () {
    Route::get('/portal/scholarship', [ApplicantScholarshipController::class, 'showScholarshipForm'])->name('create');
    Route::post('/portal/scholarship', [ApplicantScholarshipController::class, 'store'])->name('store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admission/{id}/download/{documentType}', [ApplicantInfoController::class, 'downloadFile'])
        ->name('admission.download-file');
});

Route::get('/server-time', function () {
    return response()->json([
        'current_time' => now()->toISOString()
    ]);
});

Route::get('/my-application', [ApplicantInfoController::class, 'viewMyApplication'])
    ->middleware(['auth', 'role:Applicant'])
    ->name('my-application.show');

require __DIR__ . '/auth.php';
