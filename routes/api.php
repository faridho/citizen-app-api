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
$router->group(
    [
        'prefix' => 'v1',
        'namespace' => 'V1'
    ], function ($router) {

    // List OP
    $router->group(
        [
            'prefix' => 'hello'
        ],
        function ($router) {
            $router->get('/', 'HelloAPIController@index');
        }
    );

    //Auth
    $router->group(
        [
            'prefix' => 'auth'
        ],
        function ($router) {
            $router->get('/getall', 'AuthController@getAll');
            $router->post('/login', 'AuthController@getLogin');
        }
    );
});