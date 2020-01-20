<?php

namespace Pingu\User\Entities\Actions;

use Pingu\Entity\Support\BaseEntityActions;

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
            'password' => [
                'label' => 'Change Password',
                'url' => function ($user) {
                    return $user::uris()->make('editPassword', $user, adminPrefix());
                },
                'access' => function ($user) {
                    return \Gate::check('reset-passwords', $user);
                }
            ]
        ];
    }
}