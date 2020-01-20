<?php

namespace Pingu\User\Entities\Routes;

use Pingu\Entity\Support\BaseEntityRoutes;
use Pingu\User\Http\Controllers\ForgotPasswordController;
use Pingu\User\Http\Controllers\LoginController;
use Pingu\User\Http\Controllers\RegisterController;
use Pingu\User\Http\Controllers\ResetPasswordController;

class UserRoutes extends BaseEntityRoutes
{
    protected function routes(): array
    {
        return [
            'admin' => [
                'editPassword', 'savePassword'
            ],
            'guest' => [
                'showLoginForm', 'login', 'showRegistrationForm', 'register', 'showLinkRequestForm', 'sendResetLinkEmail', 'showResetForm', 'reset'
            ],
            'web' => [
                'logout'
            ]
        ];
    }

    protected function methods(): array
    {
        return [
            'editPassword' => 'get',
            'savePassword' => 'put',
            'showLoginForm' => 'get',
            'login' => 'post',
            'showRegistrationForm' => 'get',
            'register' => 'post',
            'showLinkRequestForm' => 'get',
            'sendResetLinkEmail' => 'post',
            'showResetForm' => 'get',
            'reset' => 'post',
            'logout' => 'post'
        ];
    }

    protected function middlewares(): array
    {
        return [
            'editPassword' => 'can:reset-passwords,user',
            'savePassword' => 'can:reset-passwords,user'
        ];
    }

    protected function names(): array
    {
        return [
            'admin.index' => 'user.admin.users',
            'admin.create' => 'user.admin.users.create',
            'guest.showLoginForm' => 'user.showLoginForm', 
            'guest.login' => 'user.login', 
            'guest.showRegistrationForm' => 'user.register', 
            'guest.showLinkRequestForm' => 'user.password.request', 
            'guest.showResetForm' => 'user.password.reset',
            'web.logout' => 'user.logout'
        ];
    }

    protected function controllers(): array
    {
        return [
            'guest.showLoginForm' => LoginController::class, 
            'guest.login' => LoginController::class, 
            'guest.showRegistrationForm' => RegisterController::class, 
            'guest.register' => RegisterController::class, 
            'guest.showLinkRequestForm' => ForgotPasswordController::class, 
            'guest.sendResetLinkEmail' => ForgotPasswordController::class, 
            'guest.showResetForm' => ResetPasswordController::class,
            'guest.reset' => ResetPasswordController::class,
            'web.logout' => LoginController::class
        ];
    }

    protected function mapGuestRoutes()
    {
        $routes = $this;
        \Route::middleware(['web', 'guest'])
            ->group(
                function () use ($routes) {
                    $routes->mapEntityRoutes('guest');
                }
            );
    }

    public function register()
    {
        parent::register();
        $this->mapGuestRoutes();
    }
}