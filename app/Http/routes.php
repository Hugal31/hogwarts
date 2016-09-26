<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return view('index');
});

$app->get('/admin', function () use ($app) {
    return view('admin');
});

$app->get('/app/config.js', function () {
    return 'api_host="' . env('API_HOST', '') . '"';
});

$app->group([
    'prefix' => 'api/v1/',
    'namespace' => 'App\Http\Controllers\Api\v1'], function () use ($app) {

    $app->get('houses', [
        'as' => 'api.v1.houses',
        'uses' => 'HouseController@houses'
    ]);

    $app->get('houses/{house}', [
        'as' => 'api.v1.houses.house',
        'uses' => 'HouseController@house',
    ]);

    $app->put('houses/{house}', [
        'as' => 'api.v1.houses.putHouse',
        'uses' => 'HouseController@putHouse',
        'middleware' => 'apiAuth'
    ]);

    $app->post('auth', [
        'as' => 'api.v1.auth',
        'uses' => 'AuthController@postLogin'
    ]);

    $app->get('operations', [
        'as' => 'api.v1.operations',
        'uses' => 'OperationController@getAccesses',
        'middleware' => 'apiAuth'
    ]);

    $app->get('user', [
        'as' => 'api.v1.user',
        'uses' => 'UserController@getUser',
        'middleware' => 'apiAuth'
    ]);

    $app->put('user', [
        'as' => 'api.v1.putUser',
        'uses' => 'UserController@putUser',
        'middleware' => 'apiAuth'
    ]);

    $app->get('users', [
        'as' => 'api.v1.users',
        'uses' => 'UserController@getUsers',
        'middleware' => 'apiAdmin'
    ]);

    $app->post('users', [
        'as' => 'api.v1.postUser',
        'uses' => 'UserController@postUser',
        'middleware' => 'apiAdmin'
    ]);
});
