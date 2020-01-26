<?php

namespace Pingu\User\Entities;

use Carbon\Carbon;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Auth\{Authenticatable,MustVerifyEmail};
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Pingu\Core\Support\Actions;
use Pingu\Entity\Entities\BundledEntity;
use Pingu\Field\Contracts\HasRevisionsContract;
use Pingu\Field\Traits\HasRevisions;
use Pingu\Permissions\Traits\HasPermissionsThroughRoles;
use Pingu\Permissions\Traits\HasRoles;
use Pingu\User\Entities\Actions\UserActions;
use Pingu\User\Entities\Policies\UserPolicy;
use Pingu\User\Entities\Role;
use Pingu\User\Events\DeletingUser;
use Pingu\User\Events\SavingUser;
use Pingu\User\Events\UpdatingUser;
use Pingu\User\Events\UserDeleted;

class User extends BundledEntity implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    HasRevisionsContract
{
    use Authenticatable, 
        Authorizable, 
        CanResetPassword, 
        MustVerifyEmail, 
        Notifiable, 
        HasRoles, 
        HasPermissionsThroughRoles,
        HasRevisions;

    protected $dispatchesEvents = [
        'deleting' => DeletingUser::class,
        'deleted' => UserDeleted::class,
        'saving' => SavingUser::class,
        'updating' => UpdatingUser::class
    ];

    protected $fillable = ['name', 'email', 'password', 'roles'];

    protected $visible = ['id', 'name', 'email', 'created_at', 'roles'];

    protected $with = ['roles'];

    public $guard = 'web';

    public $adminListFields = [
        'name', 'email'
    ];

    public static function boot()
    {
        parent::boot();

        static::updating(
            function ($user) {
                //Making sure we don't remove 'God' role for user 1
                //or we could be locked out of our website
                if ($user->id == 1) {
                    $user->assignRole(Role::find(1));
                }
            }
        );
    }

    /**
     * @inheritDoc
     */
    public function getPolicy(): string
    {
        return UserPolicy::class;
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
    protected function getActionsInstance(): Actions
    {
        return new UserActions($this);
    }

    /**
     * Form creatded at mutator
     * 
     * @param  mixed $value
     * @return string
     */
    public function formCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    /**
     * Password mutator
     * 
     * @param mixed $value
     */
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = \Hash::make($value);
        }
    }
}