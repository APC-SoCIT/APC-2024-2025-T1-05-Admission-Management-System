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

        // Register components for SRCCMSTHS site
        Blade::component('layouts.srccmsths', 'srccmsths-layout');

        // Share school data with SRCCMSTHS views
        View::composer('srccmsths.*', function ($view) {
            $view->with([
                'schoolName' => 'SENATOR RENATO "COMPAÑERO" CAYETANO MEMORIAL SCIENCE AND TECHNOLOGY HIGH SCHOOL',
                'schoolTagline' => 'Developing globally competitive students.',
                'schoolAchievements' => [
                    'best_performing' => 'BEST PERFORMING SCHOOL in DepEd TAPAT, Secondary Level alongside Taguig Science High School in the #DepEdStakeholdersSummit2019.'
                ]
            ]);
        });
    }

    public const HOME = '/';  // Change this if needed
    public const LOGIN = '/login';  // Add this for login redirects
}
