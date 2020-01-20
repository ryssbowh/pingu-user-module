<?php

use Pingu\User\Entities\Role;
use Pingu\User\Entities\User;

/*
|--------------------------------------------------------------------------
| Ajax Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register ajax web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group prefixed with ajax which
| contains the "ajax" middleware groups.
|
*/

// Route::get(User::getUri('index'), ['uses' => 'UserJsGridController@jsGridIndex'])
//     ->middleware('can:view users');
// Route::delete(User::getUri('delete'), ['uses' => 'UserAjaxController@destroy'])
//     ->middleware('deletableUser')
//     ->middleware('can:delete users');
// Route::put(User::getUri('update'), ['uses' => 'UserAjaxController@update'])
//     ->middleware('can:edit users');

// Route::get(Role::getUri('index'), ['uses' => 'RoleJsGridController@jsGridIndex'])
//     ->middleware('can:view roles');
// Route::put(Role::getUri('update'), ['uses' => 'RoleAjaxController@update'])
//     ->middleware('can:edit roles');
// Route::delete(Role::getUri('delete'), ['uses' => 'RoleAjaxController@destroy'])
//     ->middleware('deletableRole')
//     ->middleware('can:delete roles');