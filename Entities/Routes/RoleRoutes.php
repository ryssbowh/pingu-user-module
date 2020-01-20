<?php

namespace Pingu\User\Entities\Routes;

use Pingu\Entity\Support\BaseEntityRoutes;
use Pingu\User\Http\Controllers\ForgotPasswordController;
use Pingu\User\Http\Controllers\LoginController;
use Pingu\User\Http\Controllers\RegisterController;
use Pingu\User\Http\Controllers\ResetPasswordController;

class RoleRoutes extends BaseEntityRoutes
{
    protected function names(): array
    {
        return [
            'admin.index' => 'user.admin.roles',
            'admin.create' => 'user.admin.roles.create'
        ];
    }
}