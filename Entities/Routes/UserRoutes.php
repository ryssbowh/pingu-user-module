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
            ]
        ];
    }

    protected function middlewares(): array
    {
        return [
            'editPassword' => 'can:reset-passwords,user',
            'savePassword' => 'can:reset-passwords,user'
        ];
    }
}