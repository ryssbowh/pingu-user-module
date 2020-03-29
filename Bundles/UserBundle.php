<?php

namespace Pingu\User\Bundles;

use Illuminate\Database\Eloquent\Collection;
use Pingu\Entity\Support\Bundle\ClassBundle;
use Pingu\User\Entities\User;

class UserBundle extends ClassBundle
{   
    /**
     * @inheritDoc
     */
    public function friendlyName(): string
    {
        return 'User';
    }

    /**
     * @inheritDoc
     */
    public function name(): string
    {
        return 'user';
    }

    /**
     * @inheritDoc
     */
    public function entityFor(): string
    {
        return User::class;
    }

    /**
     * @inheritDoc
     */
    public function entities(): Collection
    {
        return User::get();
    }
}