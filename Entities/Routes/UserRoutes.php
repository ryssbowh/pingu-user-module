<?php

namespace Pingu\User\Entities\Routes;

use Pingu\Entity\Support\Routes\BaseEntityRoutes;
use Pingu\User\Http\Controllers\AdminChangePasswordController;

class UserRoutes extends BaseEntityRoutes
{
    /**
     * @inheritDoc
     */
    protected function routes(): array
    {
        return [
            'admin' => [
                'editPassword', 'savePassword'
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    protected function middlewares(): array
    {
        return [
            'editPassword' => 'can:reset-passwords,user',
            'savePassword' => 'can:reset-passwords,user'
        ];
    }

    /**
     * @inheritDoc
     */
    protected function controllers(): array
    {
        return [
            'admin.editPassword' => AdminChangePasswordController::class,
            'admin.savePassword' => AdminChangePasswordController::class
        ];
    }
}