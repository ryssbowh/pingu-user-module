<?php

namespace Pingu\User\Entities\Policies;

use Pingu\Entity\Entities\Entity;
use Pingu\Entity\Support\BaseEntityPolicy;
use Pingu\User\Entities\Role;
use Pingu\User\Entities\User;

class RolePolicy extends BaseEntityPolicy
{
    protected function userOrGuest(?User $user)
    {
        return $user ? $user : \Permissions::guestRole();
    }

    public function index(?User $user)
    {
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('view roles');
    }

    public function view(?User $user, Entity $entity)
    {
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('view roles');
    }

    public function edit(?User $user, Entity $entity)
    {
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('edit roles');
    }

    public function delete(?User $user, Entity $entity)
    {
        if (in_array($entity->id, [1,2,3,4])) {
            return false;
        }
        if (!$entity->users->isEmpty()) {
            return false;
        }
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('delete roles');
    }

    public function create(?User $user)
    {
        $user = $this->userOrGuest($user);
        return $user->hasPermissionTo('edit roles');
    }
}