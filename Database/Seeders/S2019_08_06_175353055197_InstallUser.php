<?php

use Pingu\Core\Seeding\MigratableSeeder;
use Pingu\Core\Seeding\DisableForeignKeysTrait;
use Pingu\Core\Entities\BaseModel;
use Pingu\Menu\Entities\Menu;
use Pingu\Menu\Entities\MenuItem;
use Pingu\Permissions\Entities\Permission;
use Pingu\User\Entities\Role;
use Pingu\User\Entities\User;

class S2019_08_06_175353055197_InstallUser extends MigratableSeeder
{
    use DisableForeignKeysTrait;

    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        /**
         * Roles
         */
        $god = Role::findOrCreate('God', ['description' => 'Has all permissions']);
        $guest = Role::findOrCreate('Guest', ['description' => 'Unauthenticated users have this role']);
        $member = Role::findOrCreate('Member', ['description' => 'Members of the site']);
        $admin = Role::findOrCreate('Admin', ['description' => 'Admins who have access to back-end']);

        /**
         * Permissions
         */
        $browse = \Permissions::getPermissions(['name' => 'browse site'])->first();
        $guest->givePermissionTo($browse);
        $member->givePermissionTo($browse);

        $perm1 = Permission::findOrCreate(['name' => 'view roles', 'section' => 'User']);

        $perm2 = Permission::findOrCreate(['name' => 'view users', 'section' => 'User']);
        $admin->givePermissionTo(
            [
                $perm2,
                $perm1,
                $browse,
                \Permissions::getPermissions(['name' => 'access admin area'])->first(),
                \Permissions::getPermissions(['name' => 'view modules'])->first(),
                \Permissions::getPermissions(['name' => 'activate modules'])->first(),
                \Permissions::getPermissions(['name' => 'manage layouts'])->first(),
                \Permissions::getPermissions(['name' => 'manage fields'])->first(),
                \Permissions::getPermissions(['name' => 'manage display'])->first(),
                \Permissions::getPermissions(['name' => 'manage bundles'])->first(),
                \Permissions::getPermissions(['name' => 'view revisions'])->first(),
                \Permissions::getPermissions(['name' => 'restore revisions'])->first(),
                \Permissions::getPermissions(['name' => 'manage cache'])->first(),
                Permission::findOrCreate(['name' => \Settings::repository('general')->accessPermission(), 'section' => 'Settings']),
                Permission::findOrCreate(['name' => \Settings::repository('general')->editPermission(), 'section' => 'Settings']),
                Permission::findOrCreate(['name' => \Settings::repository('mailing')->accessPermission(), 'section' => 'Settings']),
                Permission::findOrCreate(['name' => \Settings::repository('mailing')->editPermission(), 'section' => 'Settings']),
                Permission::findOrCreate(['name' => 'add roles', 'section' => 'User']),
                Permission::findOrCreate(['name' => 'edit roles', 'section' => 'User']),
                Permission::findOrCreate(['name' => 'delete roles', 'section' => 'User']),
                Permission::findOrCreate(['name' => 'add users', 'section' => 'User']),
                Permission::findOrCreate(['name' => 'edit users', 'section' => 'User']),
                Permission::findOrCreate(['name' => 'delete users', 'section' => 'User']),
                Permission::findOrCreate(['name' => 'reset passwords', 'section' => 'User']),
                Permission::findOrCreate(['name' => 'grant roles', 'section' => 'User']),
                Permission::findOrCreate(['name' => 'revoke roles', 'section' => 'User']),
                Permission::findOrCreate(['name' => 'manage users', 'section' => 'User'])
            ]
        );

        /**
         * Menu items
         */
        $menu = Menu::where(['machineName' => 'admin-menu'])->first();

        $item = MenuItem::create(
            [
                'name' => 'Users',
                'url' => 'user.admin.index',
                'weight' => 3,
                'active' => 1,
                'deletable' => 0,
                'permission_id' => $perm2->id
            ], $menu
        );

        MenuItem::create(
            [
                'name' => 'Roles',
                'url' => 'role.admin.index',
                'active' => 1,
                'deletable' => 0,
                'permission_id' => $perm1->id
            ], $menu, $item
        );
    }

    /**
     * Reverts the database seeder.
     */
    public function down(): void
    {
        // Remove your data
    }
}
