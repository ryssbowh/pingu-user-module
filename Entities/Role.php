<?php

namespace Pingu\User\Entities;

use Illuminate\Database\Eloquent\Builder;
use Pingu\Core\Contracts\Models\HasAdminRoutesContract;
use Pingu\Core\Entities\BaseModel;
use Pingu\Entity\Support\Entity;
use Pingu\Jsgrid\Fields\{Text as JsGridText, Control};
use Pingu\Jsgrid\Traits\Models\JsGridable;
use Pingu\Permissions\Contracts\Role as RoleContract;
use Pingu\Permissions\Entities\Permission;
use Pingu\Permissions\Exceptions\RoleDoesNotExist;
use Pingu\Permissions\Guard;
use Pingu\Permissions\Traits\HasPermissions;
use Pingu\User\Contexts\EditContext;
use Pingu\User\Entities\Policies\RolePolicy;
use Pingu\User\Entities\User;
use Pingu\User\Events\DeletingRole;
use Pingu\User\Events\RoleCreated;
use Pingu\User\Events\RoleDeleted;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Role extends Entity implements RoleContract
{
    use HasPermissions;

    protected $dispatchesEvents = [
        'deleting' => DeletingRole::class,
        'deleted' => RoleDeleted::class,
        'created' => RoleCreated::class
    ];

    public $fillable = ['description', 'name'];

    public $visible = ['id', 'name', 'description'];

    public $guard = 'web';

    public $adminListFields = ['name', 'description'];

    public $descriptiveField = 'name';

    public static function boot()
    {
        parent::boot();

        static::retrieved(function($role){
            $role->fillable = ['description'];
        });
    }

    /**
     * Get users associated to this role
     * 
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('Pingu\User\Entities\User')->withTimestamps();
    }

    /**
     * Permission relationship
     * 
     * @return BelongToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Finds a Role by name
     * 
     * @param string  $name
     * @param ?string $guardName
     * 
     * @return Role
     * @throws RoleDoesNotExist
     */
    public static function findByName(string $name, $guardName = null): RoleContract
    {
        $guardName = $guardName ?? Guard::getDefaultName(static::class);
        $role = static::where('name', $name)->where('guard', $guardName)->first();
        if (! $role) {
            throw RoleDoesNotExist::named($name);
        }
        return $role;
    }

    /**
     * Finds a role by id
     *
     * @param  int     $id
     * @param  ?string $guardName
     * @return Role
     * @throws RoleDoesNotExist
     */
    public static function findById(int $id, $guardName = null): RoleContract
    {
        $guardName = $guardName ?? Guard::getDefaultName(static::class);
        $role = static::where('id', $id)->where('guard', $guardName)->first();
        if (! $role) {
            throw RoleDoesNotExist::withId($id);
        }
        return $role;
    }

    /**
     * Assign default guard when creating
     *
     * @param  array $options
     * @return bool
     * @throws RoleAlreadyExists
     */
    public static function create(array $attributes = [])
    {
        $attributes['guard'] = $attributes['guard'] ?? Guard::getDefaultName(static::class);

        if (static::where('name', $attributes['name'])->where('guard', $attributes['guard'])->first()) {
            throw RoleAlreadyExists::create($attributes['name'], $attributes['guard']);
        }

        return static::query()->create($attributes);
    }

    /**
     * Find or create a role.
     *
     * @param array $attributes
     * @param array $extra
     *
     * @return Role
     */
    public static function findOrCreate(string $name, $extra = [], $guardName = null)
    {
        $where['guard'] = $guardName ?? Guard::getDefaultName(static::class);
        $where['name'] = $name;

        $role = static::where($where)->first();

        if (! $role) {
            return static::query()->create(array_merge($where, $extra));
        }

        return $role;
    }

    /**
     * Assign default guard when saving
     *
     * @param  array $options
     * @return bool
     */
    public function save(array $options = [])
    {
        $this->attributes['guard'] = $this->attributes['guard'] ?? Guard::getDefaultName(static::class);

        return parent::save($options);
    }
}
