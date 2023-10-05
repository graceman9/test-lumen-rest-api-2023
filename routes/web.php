<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api', 'namespace' => '\App\Http\Controllers'], function () use ($router) {
    // Auth instead of User?
    $router->post('user/register', 'AuthController@register');
    $router->post('user/sign-in', 'AuthController@signIn');
    $router->post('user/recover-password', 'AuthController@recoverPassword');


    // $router->post('login', 'LumenAuthController@login');
    // $router->post('logout', 'LumenAuthController@logout');
    // $router->post('refresh', 'LumenAuthController@refresh');
    // $router->post('me', 'LumenAuthController@me');

    // private content
    $router->group(['middleware' => App\Http\Middleware\Authenticate::class], function () use ($router) {
        $router->get('/user/companies', 'CompanyController@index');
        $router->post('/user/companies', 'CompanyController@create');
    });
});

