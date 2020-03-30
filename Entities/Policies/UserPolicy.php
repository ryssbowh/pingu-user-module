<?php

namespace Pingu\User\Entities\Policies;

use Pingu\Entity\Contracts\BundleContract;
use Pingu\Entity\Support\Entity;
use Pingu\Entity\Support\Policies\BaseEntityPolicy;
use Pingu\User\Entities\User;

class UserPolicy extends BaseEntityPolicy
{
    public function index(?User $user)
    {
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('view users');
    }

    public function view(?User $user, Entity $entity)
    {
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('view users');
    }

    public function edit(?User $user, Entity $entity)
    {
        if (!$user
            or ($entity->hasRole(1) and !$user->hasRole(1))
        ) {
            return false;
        }
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('edit users');
    }

    public function delete(?User $user, Entity $entity)
    {
        if (!$user
            or $entity->id == 1
            or ($entity->hasRole(1) and !$user->hasRole(1))
        ) {
            return false;
        }
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('delete users');
    }

    public function create(?User $user, ?BundleContract $bundle = null)
    {
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('add users');
    }

    public function resetPasswords(?User $user, User $entity)
    {
        if (!$user
            or ($entity->user == 1 and !$user->id ==1)
            or ($entity->hasRole(1) and !$user->hasRole(1))
        ) {
            return false;
        }
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('reset passwords');
    }
}
