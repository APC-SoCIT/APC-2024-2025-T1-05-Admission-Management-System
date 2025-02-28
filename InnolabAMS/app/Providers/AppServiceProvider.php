<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use App\Models\ApplicantInfo;
use Illuminate\Pagination\Paginator;
use URL;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
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

        Blade::component('layouts.srccmsths', 'srccmsths-layout');
    }

    public const HOME = '/';  // Change this if needed
    public const LOGIN = '/login';  // Add this for login redirects
}
