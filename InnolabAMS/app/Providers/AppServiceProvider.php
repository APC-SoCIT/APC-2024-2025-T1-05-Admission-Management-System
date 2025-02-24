<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use App\Models\ApplicantInfo;
use Illuminate\Pagination\Paginator;
use URL;

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
    }
}