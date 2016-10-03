<?php

use Illuminate\Http\Request;

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

    $api->post('authenticate', 'App\Api\V1\Controllers\User\AuthenticateController@authenticate');
    $api->post('logout', 'App\Api\V1\Controllers\User\AuthenticateController@logout');
    $api->post('token', 'App\Api\V1\Controllers\User\AuthenticateController@getToken');
    $api->post('me', 'App\Api\V1\Controllers\User\AuthenticateController@authenticatedUser');

    $api->post('role/create', 'App\Api\V1\Controllers\Role\RoleController@create');
});