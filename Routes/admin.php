<?php

// use Pingu\User\Entities\Role;
// use Pingu\User\Entities\User;

// Route::get(User::getUri('index'), ['uses' => 'UserJsGridController@index'])
//     ->name('user.admin.users')
//     ->middleware('can:view users');
// Route::get(Role::getUri('index'), ['uses' => 'RoleJsGridController@index'])
//     ->name('user.admin.roles')
//     ->middleware('can:view roles');

// Route::get(Role::getUri('create'), ['uses' => 'RoleAdminController@create'])
//     ->name('user.admin.roles.create')
//     ->middleware('can:add roles');
// Route::post(Role::getUri('store'), ['uses' => 'RoleAdminController@store'])
//     ->middleware('can:add roles');
// Route::get(User::getUri('create'), ['uses' => 'UserAdminController@create'])
//     ->name('user.admin.users.create')
//     ->middleware('can:add users');
// Route::post(User::getUri('store'), ['uses' => 'UserAdminController@store'])
//     ->middleware('can:add users');

// Route::get(User::getUri('edit'), ['uses' => 'UserAdminController@edit'])
//     ->middleware('can:edit users');
// Route::put(User::getUri('update'), ['uses' => 'UserAdminController@update'])
//     ->middleware('can:edit users');
// Route::get(User::routeSlug().'/{'.User::routeSlug().'}/roles', ['uses' => 'UserAdminController@relatedJsGridList', 'contextualLink' => 'roles'])
//     ->middleware('can:view roles');

// Route::get(Role::getUri('edit'), ['uses' => 'RoleAdminController@edit'])
//     ->middleware('can:edit roles');
// Route::put(Role::getUri('update'), ['uses' => 'RoleAdminController@update'])
//     ->middleware('can:edit roles');
// Route::get(Role::routeSlug().'/{'.Role::routeSlug().'}/users', ['uses' => 'RoleUsersJsGridController@index'])
//     ->middleware('can:view users');

// Route::get(User::routeSlug().'/{'.User::routeSlug().'}/password', ['uses' => 'EditPasswordController@editPassword'])
//     ->middleware('can:reset passwords');
// Route::put(User::routeSlug().'/{'.User::routeSlug().'}/password', ['uses' => 'EditPasswordController@savePassword'])
//     ->middleware('can:reset passwords');