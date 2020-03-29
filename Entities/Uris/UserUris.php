<?php

namespace Pingu\User\Entities\Uris;

use Pingu\Entity\Support\Uris\BaseEntityUris;

class UserUris extends BaseEntityUris
{
    public function uris(): array
    {
        return [
            'editPassword' => $this->entity::routeSlug().'/{'.$this->entity::routeSlug().'}/password',
            'savePassword' =>$this->entity::routeSlug().'/{'.$this->entity::routeSlug().'}/password'
        ];
    }
}