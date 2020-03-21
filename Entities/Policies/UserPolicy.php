<?php

namespace Pingu\User\Entities\Policies;

use Pingu\Entity\Contracts\BundleContract;
use Pingu\Entity\Entities\Entity;
use Pingu\Entity\Support\BaseEntityPolicy;
use Pingu\User\Entities\User;

class UserPolicy extends BaseEntityPolicy
{
    protected function userOrGuest(?User $user)
    {
        return $user ? $user : \Permissions::guestRole();
    }

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
        if ($user and $entity->hasRole('God') and !$user->hasRole('God')) {
            return false;
        }
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('edit users');
    }

    public function delete(?User $user, Entity $entity)
    {
        if ($entity->id == 1) {
            return false;
        }
        if ($user and $entity->hasRole('God') and !$user->hasRole('God')) {
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
        if ($user and $entity->hasRole('God') and !$user->hasRole('God')) {
            return false;
        }
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('reset passwords');
    }
}
