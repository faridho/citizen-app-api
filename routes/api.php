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
            $router->get('/alldatakepalakeluarga/{id}', 'MasterController@allGetKepalaKeluargaID');
            $router->post('/insertwarga', 'MasterController@insertWarga');
            $router->get('/datawarga', 'MasterController@getWarga');
            $router->get('/datawarga/{id}', 'MasterController@getWargaID');
            $router->get('/alldatawarga/{id}', 'MasterController@allGetWargaID');
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
            $router->get('/allkebersihan/{id}', 'RetribusiController@allGetRetribusiKebersihanID');
            $router->post('/keamanan', 'RetribusiController@insertRetribusiKeamanan');
            $router->get('/keamanan', 'RetribusiController@getRetribusiKeamanan');
            $router->get('/keamanan/{id}', 'RetribusiController@getRetribusiKeamananID');
            $router->get('/allkeamanan/{id}', 'RetribusiController@allGetRetribusiKeamananID');
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
            $router->get('/getall/{id}', 'TemporaryController@allGetTemporary');
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
            $router->get('/getllmaster/{tab}/{id}', 'DocumentController@allGetDocumentID');
            $router->get('/getrow/{tab}/{id}', 'DocumentController@getDocumentID');
        }
    );

    //Pengumuman
    $router->group(
        [
            'prefix' => 'anouncement'
        ],
        function ($router) {
            $router->post('/insert', 'PengumumanController@insertPengumuman');
            $router->get('/get', 'PengumumanController@getPengumumanAll');
            $router->get('/get/{id}', 'PengumumanController@getPengumumanID');
        }
    );

    //Siskamling
    $router->group(
        [
            'prefix' => 'siskamling'
        ],
        function ($router) {
            $router->post('/insert', 'SiskamlingController@insertSiskamling');
            $router->get('/get', 'SiskamlingController@getSiskamling');
            $router->get('/getsiskamling/{id}', 'SiskamlingController@getSiskamlingIDSingle');
            $router->post('/insertDetail', 'SiskamlingController@insertSiskmalingDetail');
            $router->get('/get/{id}', 'SiskamlingController@getSiskamlingID');
            $router->get('/getmy/{id}/{profile}', 'SiskamlingController@getSiskamlingMyID');
            $router->get('/getreport/{id}', 'SiskamlingController@getSiskamlingReport');
        }
    );

    $router->group(
        [
            'prefix' => 'anggaran'
        ],
        function ($router) {
            $router->post('/insertdatatetap', 'AnggaranController@insertDanaTetap');
            $router->get('/getdanatetap', 'AnggaranController@getDanaTetap');
            $router->post('/insertpengeluarandatatetap', 'AnggaranController@insertPengeluaranDanaTetap');
        }
    );

    $router->group(
        [
            'prefix' => 'dashboard'
        ],
        function ($router) {
            $router->post('/login', 'DashboardController@login');
            $router->get('/kepalakeluarga', 'DashboardController@getKepalaKeluarga');
            $router->get('/warga/{id}', 'DashboardController@getWarga');

            $router->get('/genderchart', 'DashboardController@getGenderChart');
            $router->get('/agechart', 'DashboardController@getAgeChart');
            $router->get('/jobchart', 'DashboardController@getJobChart');
            $router->get('/religionchart', 'DashboardController@getReligionChart');

            $router->get('/wargatemp/{id}', 'DashboardController@getWargaTemp');
            $router->get('/gendercharttemp', 'DashboardController@getGenderChartTemp');
            $router->get('/agecharttemp', 'DashboardController@getAgeChartTemp');
            $router->get('/jobcharttemp', 'DashboardController@getJobChartTemp');
            $router->get('/religioncharttemp', 'DashboardController@getReligionChartTemp');
            $router->get('/typeplacecharttemp', 'DashboardController@getTypePlaceChartTemp');
        }
    );
});