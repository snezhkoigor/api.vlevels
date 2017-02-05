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

$api->version('v1',  ['middleware' => 'cors', 'namespace' => 'App\Http\Controllers\Api\V1'], function ($api) {
    $api->post('users', 'User\UserController@all');
    $api->post('user/{id}', 'User\UserController@show')->where('id', '[0-9]+');
    $api->post('user/create', 'User\UserController@create');
    $api->post('registration', 'User\UserController@registration');
    $api->post('refreshVerificationCode', 'User\UserController@refreshActivationCode');
    $api->post('activation', 'User\UserController@activation');
    $api->post('recovery', 'User\UserController@recoveryPassword');

    $api->post('authenticate', 'User\AuthenticateController@authenticate');
    $api->post('logout', 'User\AuthenticateController@logout');
    $api->post('token', 'User\AuthenticateController@getToken');
    $api->post('me', 'User\AuthenticateController@authenticatedUser');
    $api->post('isAuthenticated', 'User\AuthenticateController@isAuthenticated');

    $api->post('roles', 'Role\RoleController@all');
    $api->post('role/create', 'Role\RoleController@create');
    $api->post('role/{id}', 'Role\RoleController@show')->where('id', '[0-9]+');
    $api->post('role/store/{id}', 'Role\RoleController@store')->where('id', '[0-9]+');
    $api->post('role/delete/{id}', 'Role\RoleController@delete')->where('id', '[0-9]+');

    $api->post('permissions', 'Permission\PermissionController@all');
    $api->post('permission/create', 'Permission\PermissionController@create');
    $api->post('permission/{id}', 'Permission\PermissionController@show')->where('id', '[0-9]+');
    $api->post('permission/store/{id}', 'Permission\PermissionController@store')->where('id', '[0-9]+');
    $api->post('permission/delete/{id}', 'Permission\PermissionController@delete')->where('id', '[0-9]+');

    $api->post('invoice/add', 'User\UserController@create');
});

$api->version('lp',  ['middleware' => 'cors', 'namespace' => 'App\Http\Controllers\Api\Lp'], function ($api) {
    $api->post('registration', 'CmeInfoController@registration');
    $api->post('payment.add', 'PaymentController@add');
});