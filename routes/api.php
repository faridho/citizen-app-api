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

    //Master
    $router->group(
        [
            'prefix' => 'master'
        ],
        function ($router) {
            $router->post('/insertkepalakeluarga', 'MasterController@insertKepalaKeluarga');
            $router->get('/datakepalakeluarga', 'MasterController@getKepalaKeluarga');
            $router->get('/datakepalakeluarga/{id}', 'MasterController@getKepalaKeluargaID');
            $router->post('/insertwarga', 'MasterController@insertWarga');
            $router->get('/datawarga', 'MasterController@getWarga');
            $router->get('/datawarga/{id}', 'MasterController@getWargaID');
        }
    );

    //Retribusi
    $router->group(
        [
            'prefix' => 'retribusi'
        ],
        function ($router) {
            $router->post('/kebersihan', 'RetribusiController@insertRetribusiKebersihan');
            $router->get('/kebersihan', 'RetribusiController@getRetribusiKebersihan');
            $router->get('/kebersihan/{id}', 'RetribusiController@getRetribusiKebersihanID');
            $router->post('/keamanan', 'RetribusiController@insertRetribusiKeamanan');
            $router->get('/keamanan', 'RetribusiController@getRetribusiKeamanan');
            $router->get('/keamanan/{id}', 'RetribusiController@getRetribusiKeamananID');
        }
    );

    //Temporary Netizen
    $router->group(
        [
            'prefix' => 'temporary'
        ],
        function ($router) {
            $router->post('/insert', 'TemporaryController@insertTemporary');
            $router->get('/get', 'TemporaryController@getTemporary');
            $router->get('/get/{id}', 'TemporaryController@getTemporaryDetail');
        }
    );

    //Permintaan Dokumen
    $router->group(
        [
            'prefix' => 'document'
        ],
        function ($router) {
            $router->post('/insert', 'DocumentController@insertDocument');
            $router->get('/getall/{id}', 'DocumentController@getDocumentAll');
            $router->get('/getrow/{tab}/{id}', 'DocumentController@getDocumentID');
        }
    );
});