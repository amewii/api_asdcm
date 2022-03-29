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

$router->get('key', function () {
    return MD5('ASDCM-PROTIGAT');
});

// permohonan api
$router->post('/addPermohonan', 'med_permohonansController@register');
$router->post('/permohonan', 'med_permohonansController@show');
$router->get('/permohonan/{id}', 'med_permohonansController@showGet');
$router->get('/permohonanByUsers/{FK_users}', 'med_permohonansController@showGetUsers');
$router->get('/permohonanList', 'med_permohonansController@list');
$router->get('/permohonanListTahun', 'med_permohonansController@listtahun');
$router->get('/permohonanStatus/{status_permohonan}', 'med_permohonansController@listStatus');
$router->post('/permohonanUpdate', 'med_permohonansController@update');
$router->post('/permohonanLuput', 'med_permohonansController@updateLuput');
$router->post('/permohonanDelete', 'med_permohonansController@delete');
$router->post('/permohonanDownload', 'med_permohonansController@download');
$router->post('/permohonanRemove', 'med_permohonansController@remove');

// program api
$router->post('/addProgram', 'med_programsController@register');
$router->post('/program', 'med_programsController@show');
$router->get('/program/{id}', 'med_programsController@showGet');
$router->get('/programList', 'med_programsController@list');
$router->get('/programListTahun', 'med_programsController@listtahun');
$router->get('/programListPdf', 'med_programsController@listpdf');
$router->get('/programListBergambar', 'med_programsController@listbergambar');
$router->get('/programListAll', 'med_programsController@listall');
$router->post('/programUpdate', 'med_programsController@update');
$router->post('/programTagging', 'med_programsController@updateTag');
$router->post('/programUpload/{id}', 'med_programsController@upload');
$router->post('/programUpload2/{id}', 'med_programsController@upload2');
$router->post('/programDelete', 'med_programsController@delete');

// kategoriprogram api
$router->post('/addKategoriprogram', 'med_kategoriprogramsController@register');
$router->post('/kategoriprogram', 'med_kategoriprogramsController@show');
$router->get('/kategoriprogramList', 'med_kategoriprogramsController@list');
$router->get('/kategoriprogramListAll', 'med_kategoriprogramsController@listall');
$router->post('/kategoriprogramUpdate', 'med_kategoriprogramsController@update');
$router->post('/kategoriprogramDelete', 'med_kategoriprogramsController@delete');

// status api
$router->post('/addStatus', 'med_statusController@register');
$router->post('/status', 'med_statusController@show');
$router->get('/statusList', 'med_statusController@list');
$router->post('/statusUpdate', 'med_statusController@update');
$router->post('/statusDelete', 'med_statusController@delete');

// tempoh api
$router->post('/addTempoh', 'med_tempohsController@register');
$router->post('/tempoh', 'med_tempohsController@show');
$router->get('/tempoh/{id}', 'med_tempohsController@showGet');
$router->get('/tempohList', 'med_tempohsController@list');
$router->post('/tempohUpdate', 'med_tempohsController@update');
$router->post('/tempohDelete', 'med_tempohsController@delete');

// format api
$router->post('/addFormat', 'med_formatsController@register');
$router->post('/format', 'med_formatsController@show');
$router->get('/formatList', 'med_formatsController@list');
$router->get('/formatListAll', 'med_formatsController@listall');
$router->post('/formatUpdate', 'med_formatsController@update');
$router->post('/formatDelete', 'med_formatsController@delete');