<?php

namespace Pingu\User\Entities\Uris;

use Pingu\Entity\Support\BaseEntityUris;

class UserUris extends BaseEntityUris
{
    public function uris(): array
    {
        return [
            'editPassword' => $this->entity::routeSlug().'/{'.$this->entity::routeSlug().'}/password',
            'savePassword' =>$this->entity::routeSlug().'/{'.$this->entity::routeSlug().'}/password',
            'logout' => 'logout',
            'showLoginForm' => 'login',
            'login' => 'login',
            'showRegistrationForm' => 'register',
            'register' => 'register',
            'showLinkRequestForm' => 'password-request',
            'sendResetLinkEmail' => 'password-request',
            'showResetForm' => 'reset-password',
            'reset' =>'reset-password'
        ];
    }
}