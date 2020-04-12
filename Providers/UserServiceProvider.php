<?php

namespace Pingu\User\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Routing\Router;
use Pingu\Core\Support\ModuleServiceProvider;
use Pingu\User\Bundles\UserBundle;
use Pingu\User\Entities\Policies\UserPolicy;
use Pingu\User\Entities\Role;
use Pingu\User\Entities\User;
use Pingu\User\Http\Middleware\DeletableRole;
use Pingu\User\Http\Middleware\DeletableUser;

class UserServiceProvider extends ModuleServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    protected $entities = [
        User::class,
        Role::class
    ];
    
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerFactories();
        $this->loadModuleViewsFrom(__DIR__ . '/../Resources/views', 'user');
        config(['auth.providers.users.model' => User::class]);
        (new UserBundle)->register();
        $this->registerEntities($this->entities);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'user'
        );
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('user.php')
        ], 'user-config');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/user');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'user');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'user');
        }
    }

    /**
     * Register an additional directory of factories.
     * 
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
