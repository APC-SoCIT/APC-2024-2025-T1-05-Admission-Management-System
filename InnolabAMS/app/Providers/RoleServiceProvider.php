<?php
// app/Providers/RoleServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\CheckRole;

class RoleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('role', function ($app) {
            return new CheckRole();
        });
    }
}
