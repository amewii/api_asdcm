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

// med_users api
$router->post('/addUsers', 'med_usersController@register');
$router->post('/users', 'med_usersController@show');
$router->post('/usersIcEmel', 'med_usersController@showIcEmel');
$router->post('/usersReset', 'med_usersController@resetpassword');
$router->post('/usersResetToEmail', 'med_usersController@resetpasswordtomail');
$router->get('/usersResetKatalaluan/{resetkatalaluan}', 'med_usersController@showGetResetKatalaluan');
$router->get('/usersGetIc/{no_kad_pengenalan}', 'med_usersController@showGetIc');
$router->get('/usersList', 'med_usersController@list');
$router->get('/usersgovsIntanList', 'med_usersController@listIntan');
$router->get('/usersgovsIntan/{no_kad_pengenalan}', 'med_usersController@listIntanGetIc');
$router->get('/usersgovsLuarList', 'med_usersController@listLuar');
$router->get('/usersswastaList', 'med_usersController@listSwasta');
$router->get('/userspelajarList', 'med_usersController@listPelajar');
$router->get('/usersListAll', 'med_usersController@listAll');
$router->get('/usersListKerajaan', 'med_usersController@listKerajaan');
$router->get('/usersListKerajaan/{FK_users}', 'med_usersController@listKerajaanSingle');
$router->get('/usersListSwasta', 'med_usersController@listSwasta');
$router->get('/usersListPelajar', 'med_usersController@listPelajar');
$router->post('/usersUpdate', 'med_usersController@update'); //setting tambah baru
$router->post('/usersDelete', 'med_usersController@delete');

// med_usersgov api
$router->post('/addUsersgovs', 'med_usersgovController@register');
$router->post('/usersgovs', 'med_usersgovController@show');
$router->get('/usersgovsList', 'med_usersgovController@list');
$router->post('/usersgovsUpdate', 'med_usersgovController@update'); //setting tambah baru
$router->post('/usersgovsDelete', 'med_usersgovController@delete');

// med_usersswastas api
$router->post('/addUserswastas', 'med_usersswastaController@register');
$router->post('/userswastas', 'med_usersswastaController@show');
$router->get('/userswastasList', 'med_usersswastaController@list');
$router->post('/userswastasUpdate', 'med_usersswastaController@update'); //setting tambah baru
$router->post('/userswastasDelete', 'med_usersswastaController@delete');

// med_userspelajar api
$router->post('/addUserspelajars', 'med_userspelajarController@register');
$router->post('/userspelajars', 'med_userspelajarController@show');
$router->get('/userspelajarsList', 'med_userspelajarController@list');
$router->post('/userspelajarsUpdate', 'med_userspelajarController@update'); //setting tambah baru
$router->post('/userspelajarsDelete', 'med_userspelajarController@delete');

// maklumatkecemasans api
$router->post('/addMaklumatkecemasans', 'maklumatkecemasansController@register');
$router->post('/maklumatkecemasans', 'maklumatkecemasansController@show');
$router->get('/maklumatkecemasansList', 'maklumatkecemasansController@list');
$router->post('/maklumatkecemasansUpdate', 'maklumatkecemasansController@update'); //setting tambah baru
$router->post('/maklumatkecemasansDelete', 'maklumatkecemasansController@delete');

// med_kategoriperkhidmatan api
$router->post('/addKategoriperkhidmatans', 'med_kategoriperkhidmatanController@register');
$router->post('/kategoriperkhidmatans', 'med_kategoriperkhidmatanController@show');
$router->get('/kategoriperkhidmatansList', 'med_kategoriperkhidmatanController@list');
$router->post('/kategoriperkhidmatansUpdate', 'med_kategoriperkhidmatanController@update'); //setting tambah baru
$router->post('/kategoriperkhidmatansDelete', 'med_kategoriperkhidmatanController@delete');

// med_skim api
$router->post('/addSkims', 'med_skimController@register');
$router->post('/skims', 'med_skimController@show');
$router->get('/skimsList', 'med_skimController@list');
$router->post('/skimsUpdate', 'med_skimController@update'); //setting tambah baru
$router->post('/skimsDelete', 'med_skimController@delete');

// med_gred api
$router->post('/addGreds', 'med_gredController@register');
$router->post('/greds', 'med_gredController@show');
$router->get('/gredsList', 'med_gredController@list');
$router->post('/gredsUpdate', 'med_gredController@update'); //setting tambah baru
$router->post('/gredsDelete', 'med_gredController@delete');

// med_tarafjawatan api
$router->post('/addTarafjawatans', 'med_tarafjawatanController@register');
$router->post('/tarafjawatans', 'med_tarafjawatanController@show');
$router->get('/tarafjawatansList', 'med_tarafjawatanController@list');
$router->post('/tarafjawatansUpdate', 'med_tarafjawatanController@update'); //setting tambah baru
$router->post('/tarafjawatansDelete', 'med_tarafjawatanController@delete');

// med_jenispengguna api
$router->post('/addJenispenggunas', 'med_jenispenggunaController@register');
$router->post('/jenispenggunas', 'med_jenispenggunaController@show');
$router->get('/jenispenggunasList', 'med_jenispenggunaController@list');
$router->post('/jenispenggunasUpdate', 'med_jenispenggunaController@update'); //setting tambah baru
$router->post('/jenispenggunasDelete', 'med_jenispenggunaController@delete');

// med_jenisperkhidmatan api
$router->post('/addJenisperkhidmatans', 'med_jenisperkhidmatanController@register');
$router->post('/jenisperkhidmatans', 'med_jenisperkhidmatanController@show');
$router->get('/jenisperkhidmatansList', 'med_jenisperkhidmatanController@list');
$router->post('/jenisperkhidmatansUpdate', 'med_jenisperkhidmatanController@update'); //setting tambah baru
$router->post('/jenisperkhidmatansDelete', 'med_jenisperkhidmatanController@delete');

// med_tetapan api
$router->post('/addTetapans', 'med_tetapanController@register');
$router->post('/tetapans', 'med_tetapanController@show');
$router->get('/tetapansList', 'med_tetapanController@list');
$router->post('/tetapansUpdate', 'med_tetapanController@update'); //setting tambah baru
$router->post('/tetapansDelete', 'med_tetapanController@delete');

// med_peranan api
$router->post('/addPeranan', 'med_perananController@register');
$router->post('/peranan', 'med_perananController@show');
$router->get('/perananList', 'med_perananController@list');
$router->post('/perananUpdate', 'med_perananController@update'); //setting tambah baru
$router->post('/perananDelete', 'med_perananController@delete');

// med_capaian api
$router->post('/addCapaian', 'med_capaianController@register');
$router->post('/capaian', 'med_capaianController@show');
$router->get('/capaian/{FK_users}', 'med_capaianController@showGet');
$router->get('/capaianList', 'med_capaianController@list');
$router->post('/capaianUpdate', 'med_capaianController@update'); //setting tambah baru
$router->post('/capaianDelete', 'med_capaianController@delete');