<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use App\Models\ApplicantInfo;
use Illuminate\Pagination\Paginator;
use URL;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot()
    {
        Paginator::useTailwind();

        if (App::environment(['staging', 'production'])) {
            URL::forceScheme('https');
        }

        View::composer('dashboard', function ($view) {
            $view->with([
                'newApplicationsCount' => ApplicantInfo::where('status', 'new')->count(),
                'acceptedApplicationsCount' => ApplicantInfo::where('status', 'accepted')->count(),
                'rejectedApplicationsCount' => ApplicantInfo::where('status', 'rejected')->count(),
            ]);
        });

        Validator::extend('phone_format', function ($attribute, $value) {
            return preg_match('/^(09\d{2}-\d{3}-\d{4}|\(02\) \d{4}-\d{4})$/', $value);
        });

        Validator::extend('name_format', function ($attribute, $value) {
            return preg_match('/^[\pL\s\-\.]+$/u', $value);
        });
    }
}