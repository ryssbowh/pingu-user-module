<?php

namespace Pingu\User\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Pingu\User\Entities\Role;
use Pingu\User\Entities\User;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The root namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $namespace = 'Pingu\User\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapAjaxRoutes();

        $this->mapAdminRoutes();

        $this->mapWebRoutes();

        $this->mapGuestRoutes();
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
        Route::middleware(['web','permission:browse site'])
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/web.php');
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapGuestRoutes()
    {
        Route::middleware(['web', 'guest'])
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/guest.php');
    }

    /**
     * Define the "ajax" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAjaxRoutes()
    {
        Route::prefix(ajaxPrefix())
            ->middleware('ajax')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/ajax.php');
    }

    /**
     * Define the admin "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::middleware(['web', 'permission:access admin area'])
            ->prefix(adminPrefix())
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/admin.php');
    }
}
