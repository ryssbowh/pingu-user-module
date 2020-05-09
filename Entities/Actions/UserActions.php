<?php

namespace Pingu\User\Entities\Actions;

use Pingu\Core\Support\Actions\BaseAction;
use Pingu\Entity\Support\Actions\BaseEntityActions;

class UserActions extends BaseEntityActions
{
    /**
     * List of actions 
     * 
     * @return array
     */
    public function actions(): array
    {
        return [
            'password' => new BaseAction(
                'Change Password',
                function ($user, $prefix) {
                    return $user::uris()->make('edit', $user, $prefix);
                },
                function ($user) {
                    return \Gate::check('reset-passwords', $user);
                },
                'admin'
            )
        ];
    }
}