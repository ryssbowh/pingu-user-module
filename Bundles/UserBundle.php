<?php

namespace Pingu\User\Bundles;

use Pingu\Entity\Support\Bundle;
use Pingu\User\Entities\User;

class UserBundle extends Bundle
{   
    /**
     * @inheritDoc
     */
    public function bundleFriendlyName(): string
    {
        return 'User';
    }

    /**
     * @inheritDoc
     */
    public function bundleName(): string
    {
        return 'user.user';
    }

    /**
     * @inheritDoc
     */
    public function getRouteKey(): string
    {
        return 'user.user';
    }

    /**
     * @inheritDoc
     */
    public function entityFor(): string
    {
        return User::class;
    }
}