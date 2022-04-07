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
$router->post('/addPermohonan', 'med_permohonanController@register');
$router->post('/permohonan', 'med_permohonanController@show');
$router->get('/permohonan/{id}', 'med_permohonanController@showGet');
$router->get('/permohonanByUsers/{FK_users}', 'med_permohonanController@showGetUsers');
$router->get('/permohonanList', 'med_permohonanController@list');
$router->get('/permohonanListTahun', 'med_permohonanController@listtahun');
$router->get('/permohonanStatus/{status_permohonan}', 'med_permohonanController@listStatus');
$router->post('/permohonanUpdate', 'med_permohonanController@update');
$router->post('/permohonanLuput', 'med_permohonanController@updateLuput');
$router->post('/permohonanDelete', 'med_permohonanController@delete');
$router->post('/permohonanDownload', 'med_permohonanController@download');
$router->post('/permohonanRemove', 'med_permohonanController@remove');

// program api
$router->post('/addProgram', 'med_programController@register');
$router->post('/program', 'med_programController@show');
$router->get('/program/{id}', 'med_programController@showGet');
$router->post('/programLaporan', 'med_programController@laporan');
$router->get('/programList', 'med_programController@list');
$router->get('/programListTahun', 'med_programController@listtahun');
$router->get('/programListPdf', 'med_programController@listpdf');
$router->get('/programListBergambar', 'med_programController@listbergambar');
$router->get('/programListVideo', 'med_programController@listvideo');
$router->get('/programListAll', 'med_programController@listall');
$router->post('/programUpdate', 'med_programController@update');
$router->post('/programTagging', 'med_programController@updateTag');
$router->post('/programUpload/{id}', 'med_programController@upload');
$router->post('/programUpload2/{id}', 'med_programController@upload2');
// $router->post('/programUploadExt/{id}', 'med_programController@extension');
$router->post('/programDelete', 'med_programController@delete');
$router->post('/searchProgram', 'med_programContrller@search');

// kategoriprogram api
$router->post('/addKategoriprogram', 'med_kategoriprogramController@register');
$router->post('/kategoriprogram', 'med_kategoriprogramController@show');
$router->get('/kategoriprogramList', 'med_kategoriprogramController@list');
$router->get('/kategoriprogramListAll', 'med_kategoriprogramController@listall');
$router->post('/kategoriprogramUpdate', 'med_kategoriprogramController@update');
$router->post('/kategoriprogramDelete', 'med_kategoriprogramController@delete');

// status api
$router->post('/addStatus', 'med_statusController@register');
$router->post('/status', 'med_statusController@show');
$router->get('/statusList', 'med_statusController@list');
$router->get('/statusListKelulusan', 'med_statusController@listkelulusan');
$router->post('/statusUpdate', 'med_statusController@update');
$router->post('/statusDelete', 'med_statusController@delete');

// tempoh api
$router->post('/addTempoh', 'med_tempohController@register');
$router->post('/tempoh', 'med_tempohController@show');
$router->get('/tempoh/{id}', 'med_tempohController@showGet');
$router->get('/tempohList', 'med_tempohController@list');
$router->post('/tempohUpdate', 'med_tempohController@update');
$router->post('/tempohDelete', 'med_tempohController@delete');

// format api
$router->post('/addFormat', 'med_formatController@register');
$router->post('/format', 'med_formatController@show');
$router->get('/formatList', 'med_formatController@list');
$router->get('/formatListAll', 'med_formatController@listall');
$router->post('/formatUpdate', 'med_formatController@update');
$router->post('/formatDelete', 'med_formatController@delete');