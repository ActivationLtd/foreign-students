<?php

namespace App\Projects\DgmeStudents\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';
    /**
     * This namespace is applied to your controller routes.
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Projects\DgmeStudents\Http\Controllers';

    protected $webRoutes = [
        'app/Projects/DgmeStudents/routes/auth.php',
        'app/Projects/DgmeStudents/routes/web.php',
        'app/Projects/DgmeStudents/routes/modules.php',
        'app/Projects/DgmeStudents/routes/partials.php',
        'app/Projects/DgmeStudents/routes/services.php',
        'app/Projects/DgmeStudents/routes/superuser.php',
        'app/Projects/DgmeStudents/routes/test.php',
    ];

    protected $apiRoutes = [
        'app/Projects/DgmeStudents/routes/api.php'
    ];

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        foreach ($this->webRoutes as $route) {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path($route));
        }
    }

    /**
     * Define the "api" routes for the application.
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        foreach ($this->apiRoutes as $route) {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path($route));
        }
    }
}