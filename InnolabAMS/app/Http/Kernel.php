<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        // Other middlewares
        'role' => \App\Http\Middleware\CheckRole::class,
    ];

    // You can also have other properties and methods
}
