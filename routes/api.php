<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1',  function ($api) {
    $api->post('users', 'App\Api\V1\Controllers\User\UserController@all');
    $api->post('user/{id}', 'App\Api\V1\Controllers\User\UserController@show')->where('id', '[0-9]+');
    $api->post('user/create', 'App\Api\V1\Controllers\User\UserController@create');
    $api->post('registration', 'App\Api\V1\Controllers\User\UserController@registration');
    $api->post('activation/{code}', 'App\Api\V1\Controllers\User\UserController@activation');
    $api->post('reminder/{code?}', 'App\Api\V1\Controllers\User\UserController@reminder');

    $api->post('authenticate', 'App\Api\V1\Controllers\User\AuthenticateController@authenticate');
    $api->post('logout', 'App\Api\V1\Controllers\User\AuthenticateController@logout');
    $api->post('token', 'App\Api\V1\Controllers\User\AuthenticateController@getToken');
    $api->post('me', 'App\Api\V1\Controllers\User\AuthenticateController@authenticatedUser');

    $api->post('roles', 'App\Api\V1\Controllers\Role\RoleController@all');
    $api->post('role/create', 'App\Api\V1\Controllers\Role\RoleController@create');
    $api->post('role/{id}', 'App\Api\V1\Controllers\Role\RoleController@show')->where('id', '[0-9]+');
    $api->post('role/store/{id}', 'App\Api\V1\Controllers\Role\RoleController@store')->where('id', '[0-9]+');
    $api->post('role/delete/{id}', 'App\Api\V1\Controllers\Role\RoleController@delete')->where('id', '[0-9]+');

    $api->post('permissions', 'App\Api\V1\Controllers\Permission\PermissionController@all');
    $api->post('permission/create', 'App\Api\V1\Controllers\Permission\PermissionController@create');
    $api->post('permission/{id}', 'App\Api\V1\Controllers\Permission\PermissionController@show')->where('id', '[0-9]+');
    $api->post('permission/store/{id}', 'App\Api\V1\Controllers\Permission\PermissionController@store')->where('id', '[0-9]+');
    $api->post('permission/delete/{id}', 'App\Api\V1\Controllers\Permission\PermissionController@delete')->where('id', '[0-9]+');
});