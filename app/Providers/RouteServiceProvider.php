<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $themeNamespace = 'Theme\Controllers';
    protected $namespace = 'App\Http\Controllers';
    protected $apiNamespace = 'App\Http\Controllers\Api';
    protected $adminNamespace = 'App\Http\Controllers\Admin';
    protected $adminApiNamespace = 'App\Http\Controllers\Admin\Axios';
    protected $rmmNamespace = 'App\Http\Controllers\RbtMediaManager';

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
        $this->mapAdminWebRoutes();

        $this->mapAdminApiRoutes();

        $this->mapRmmRoutes();

        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapThemeWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware(['web', 'query'])
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "admin web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminWebRoutes()
    {
        Route::middleware(['web', 'checkSA'])
            ->prefix('bs-admin')
            ->namespace($this->adminNamespace)
            ->group(base_path('routes/admin.php'));
    }

    /**
     * Define the "admin api" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminApiRoutes()
    {
        Route::middleware(['web', 'checkSA'])
            ->prefix('bs-admin-api')
            ->namespace($this->adminApiNamespace)
            ->group(base_path('routes/admin-api.php'));
    }

    /**
     * Define the "rmm" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapRmmRoutes()
    {
        Route::middleware(['web', 'checkSA'])
            ->prefix('bs-mm-api')
            ->namespace($this->rmmNamespace)
            ->group(base_path('routes/rmm.php'));
    }

    /**
     * Define the "theme web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapThemeWebRoutes()
    {
        Route::middleware(['web', 'query'])
            ->namespace($this->themeNamespace)
            ->group(base_path('routes/theme.php'));
    }


    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('bs-client-api')
            ->middleware('api')
            ->namespace($this->apiNamespace)
            ->group(base_path('routes/api.php'));
    }
}
