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

// users api
$router->post('/addUsers', 'usersController@register');
$router->post('/users', 'usersController@show');
$router->get('/usersList', 'usersController@list');
$router->get('/usersListKerajaan', 'usersController@listKerajaan');
$router->get('/usersListSwasta', 'usersController@listSwasta');
$router->get('/usersListPelajar', 'usersController@listPelajar');
$router->post('/usersUpdate', 'usersController@update'); //setting tambah baru
$router->post('/usersDelete', 'usersController@delete');

// usersgovs api
$router->post('/addUsersgovs', 'usersgovsController@register');
$router->post('/usersgovs', 'usersgovsController@show');
$router->get('/usersgovsList', 'usersgovsController@list');
$router->post('/usersgovsUpdate', 'usersgovsController@update'); //setting tambah baru
$router->post('/usersgovsDelete', 'usersgovsController@delete');

// userswastas api
$router->post('/addUserswastas', 'userswastasController@register');
$router->post('/userswastas', 'userswastasController@show');
$router->get('/userswastasList', 'userswastasController@list');
$router->post('/userswastasUpdate', 'userswastasController@update'); //setting tambah baru
$router->post('/userswastasDelete', 'userswastasController@delete');

// userspelajars api
$router->post('/addUserspelajars', 'userspelajarsController@register');
$router->post('/userspelajars', 'userspelajarsController@show');
$router->get('/userspelajarsList', 'userspelajarsController@list');
$router->post('/userspelajarsUpdate', 'userspelajarsController@update'); //setting tambah baru
$router->post('/userspelajarsDelete', 'userspelajarsController@delete');

// maklumatkecemasans api
$router->post('/addMaklumatkecemasans', 'maklumatkecemasansController@register');
$router->post('/maklumatkecemasans', 'maklumatkecemasansController@show');
$router->get('/maklumatkecemasansList', 'maklumatkecemasansController@list');
$router->post('/maklumatkecemasansUpdate', 'maklumatkecemasansController@update'); //setting tambah baru
$router->post('/maklumatkecemasansDelete', 'maklumatkecemasansController@delete');

// kategoriperkhidmatans api
$router->post('/addKategoriperkhidmatans', 'kategoriperkhidmatansController@register');
$router->post('/kategoriperkhidmatans', 'kategoriperkhidmatansController@show');
$router->get('/kategoriperkhidmatansList', 'kategoriperkhidmatansController@list');
$router->post('/kategoriperkhidmatansUpdate', 'kategoriperkhidmatansController@update'); //setting tambah baru
$router->post('/kategoriperkhidmatansDelete', 'kategoriperkhidmatansController@delete');

// skims api
$router->post('/addSkims', 'skimsController@register');
$router->post('/skims', 'skimsController@show');
$router->get('/skimsList', 'skimsController@list');
$router->post('/skimsUpdate', 'skimsController@update'); //setting tambah baru
$router->post('/skimsDelete', 'skimsController@delete');

// greds api
$router->post('/addGreds', 'gredsController@register');
$router->post('/greds', 'gredsController@show');
$router->get('/gredsList', 'gredsController@list');
$router->post('/gredsUpdate', 'gredsController@update'); //setting tambah baru
$router->post('/gredsDelete', 'gredsController@delete');

// tarafjawatans api
$router->post('/addTarafjawatans', 'tarafjawatansController@register');
$router->post('/tarafjawatans', 'tarafjawatansController@show');
$router->get('/tarafjawatansList', 'tarafjawatansController@list');
$router->post('/tarafjawatansUpdate', 'tarafjawatansController@update'); //setting tambah baru
$router->post('/tarafjawatansDelete', 'tarafjawatansController@delete');

// jenispenggunas api
$router->post('/addJenispenggunas', 'jenispenggunasController@register');
$router->post('/jenispenggunas', 'jenispenggunasController@show');
$router->get('/jenispenggunasList', 'jenispenggunasController@list');
$router->post('/jenispenggunasUpdate', 'jenispenggunasController@update'); //setting tambah baru
$router->post('/jenispenggunasDelete', 'jenispenggunasController@delete');

// jenisperkhidmatans api
$router->post('/addJenisperkhidmatans', 'jenisperkhidmatansController@register');
$router->post('/jenisperkhidmatans', 'jenisperkhidmatansController@show');
$router->get('/jenisperkhidmatansList', 'jenisperkhidmatansController@list');
$router->post('/jenisperkhidmatansUpdate', 'jenisperkhidmatansController@update'); //setting tambah baru
$router->post('/jenisperkhidmatansDelete', 'jenisperkhidmatansController@delete');
