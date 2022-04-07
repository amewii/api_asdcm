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

// med_kampus api
$router->post('/addKampus', 'med_kampusController@register');
$router->post('/kampus', 'med_kampusController@show');
$router->get('/kampusList', 'med_kampusController@list');
$router->get('/kampusListAll', 'med_kampusController@listall');
$router->post('/kampusUpdate', 'med_kampusController@update'); //setting tambah baru
$router->post('/kampusDelete', 'med_kampusController@delete');

// agamas api
$router->post('/addAgamas', 'agamasController@register');
$router->post('/agamas/{id}', 'agamasController@show');
$router->get('/agamasList', 'agamasController@list');
$router->get('/agamasListAll', 'agamasController@listall');
$router->post('/agamasUpdate', 'agamasController@update'); //setting tambah baru
$router->post('/agamasDelete', 'agamasController@delete');

// jantinas api
$router->post('/addJantinas', 'jantinasController@register');
$router->post('/jantinas/{id}', 'jantinasController@show');
$router->get('/jantinasList', 'jantinasController@list');
$router->post('/jantinasUpdate', 'jantinasController@update'); //setting tambah baru
$router->post('/jantinasDelete', 'jantinasController@delete');

// bangsas api
$router->post('/addBangsas', 'bangsasController@register');
$router->post('/bangsas', 'bangsasController@show');
$router->get('/bangsasList', 'bangsasController@list');
$router->get('/bangsasListAll', 'bangsasController@listall');
$router->post('/bangsasUpdate', 'bangsasController@update'); //setting tambah baru
$router->post('/bangsasDelete', 'bangsasController@delete');

// etniks api
$router->post('/addEtniks', 'etniksController@register');
$router->post('/etniks', 'etniksController@show');
$router->get('/etniksList', 'etniksController@list');
$router->get('/etniksListAll', 'etniksController@listall');
$router->post('/etniksUpdate', 'etniksController@update'); //setting tambah baru
$router->post('/etniksDelete', 'etniksController@delete');

// med_gelaran api
$router->post('/addGelarans', 'med_gelaranController@register');
$router->post('/gelarans', 'med_gelaranController@show');
$router->get('/gelaransList', 'med_gelaranController@list');
$router->get('/gelaransListAll', 'med_gelaranController@listall');
$router->post('/gelaransUpdate', 'med_gelaranController@update'); //setting tambah baru
$router->post('/gelaransDelete', 'med_gelaranController@delete');

// med_kluster api
$router->post('/addKlusters', 'med_klusterController@register');
$router->post('/klusters', 'med_klusterController@show');
$router->get('/klusters/{FK_kampus}', 'med_klusterController@showGet');
$router->get('/klustersList', 'med_klusterController@list');
$router->post('/klustersUpdate', 'med_klusterController@update'); //setting tambah baru
$router->post('/klustersDelete', 'med_klusterController@delete');

// med_subkluster api
$router->post('/addSubklusters', 'med_subklusterController@register');
$router->post('/subklusters', 'med_subklusterController@show');
$router->get('/subklusters/{FK_kluster}', 'med_subklusterController@showGet');
$router->get('/subklustersList', 'med_subklusterController@list');
$router->post('/subklustersUpdate', 'med_subklusterController@update'); //setting tambah baru
$router->post('/subklustersDelete', 'med_subklusterController@delete');

// med_modul api
$router->post('/addModuls', 'med_modulController@register');
$router->post('/moduls', 'med_modulController@show');
$router->get('/modulsList', 'med_modulController@list');
$router->post('/modulsUpdate', 'med_modulController@update'); //setting tambah baru
$router->post('/modulsDelete', 'med_modulController@delete');

// med_submodul api
$router->post('/addSubmoduls', 'med_submodulController@register');
$router->post('/submoduls', 'med_submodulController@show');
$router->get('/submoduls/{FK_modul}', 'med_submodulController@showSubmodul');
$router->get('/submodulsList', 'med_submodulController@list');
$router->post('/submodulsUpdate', 'med_submodulController@update'); //setting tambah baru
$router->post('/submodulsDelete', 'med_submodulController@delete');

// negara api
$router->post('/addNegaras', 'negarasController@register');
$router->post('/negaras', 'negarasController@show');
$router->get('/negarasList', 'negarasController@list');
$router->post('/negarasUpdate', 'negarasController@update'); //setting tambah baru
$router->post('/negarasDelete', 'negarasController@delete');

// negeri api
$router->post('/addNegeris', 'negerisController@register');
$router->post('/negeris', 'negerisController@show');
$router->get('/negerisList', 'negerisController@list');
$router->post('/negerisUpdate', 'negerisController@update'); //setting tambah baru
$router->post('/negerisDelete', 'negerisController@delete');

// med_unit api
$router->post('/addUnits', 'med_unitController@register');
$router->post('/units', 'med_unitController@show');
$router->get('/units/{FK_kluster}/{FK_subkluster}', 'med_unitController@showGet');
$router->get('/unitsList', 'med_unitController@list');
$router->post('/unitsUpdate', 'med_unitController@update'); //setting tambah baru
$router->post('/unitsDelete', 'med_unitController@delete');

// med_vip api
$router->post('/addVips', 'med_vipController@register');
$router->post('/vips', 'med_vipController@show');
$router->get('/vipsList', 'med_vipController@list');
$router->get('/vipsListAll', 'med_vipController@listall');
$router->post('/vipsUpdate', 'med_vipController@update'); //setting tambah baru
$router->post('/vipsDelete', 'med_vipController@delete');

// warganegara api
$router->post('/addWarganegaras', 'warganegarasController@register');
$router->post('/warganegaras', 'warganegarasController@show');
$router->get('/warganegarasList', 'warganegarasController@list');
$router->post('/warganegarasUpdate', 'warganegarasController@update'); //setting tambah baru
$router->post('/warganegarasDelete', 'warganegarasController@delete');

// useradmin api
$router->post('/addUseradmins', 'user_adminsController@register');
$router->post('/useradmins', 'user_adminsController@show');
$router->get('/useradmins/{id}', 'user_adminsController@showGet');
$router->get('/useradminsModul/{FK_users}', 'user_adminsController@showModul');
$router->get('/useradminsModul/{FK_users}/{FK_modul}', 'user_adminsController@showUserModul');
$router->get('/useradminsList', 'user_adminsController@list');
$router->post('/useradminsUpdate', 'user_adminsController@update'); //setting tambah baru
$router->post('/useradminsDelete', 'user_adminsController@delete');

// usersubmodul api
$router->post('/addUsersubmoduls', 'user_submodulsController@register');
$router->post('/usersubmoduls', 'user_submodulsController@show');
$router->get('/usersubmodulsList', 'user_submodulsController@list');
$router->post('/usersubmodulsUpdate', 'user_submodulsController@update'); //setting tambah baru
$router->post('/usersubmodulsDelete', 'user_submodulsController@delete');

// capaian api
$router->post('/addCapaians', 'capaiansController@register');
$router->post('/capaians', 'capaiansController@show');
$router->get('/capaiansList', 'capaiansController@list');
$router->post('/capaiansUpdate', 'capaiansController@update'); //setting tambah baru
$router->post('/capaiansDelete', 'capaiansController@delete');

// med_menu api
$router->post('/addMenus', 'med_menuController@register');
$router->post('/menus', 'med_menuController@show');
$router->get('/menusList', 'med_menuController@list');
$router->get('/menusTop', 'med_menuController@top');
$router->get('/menusMid/{FK_parent}', 'med_menuController@mid');
$router->get('/menusBot/{FK_parent}', 'med_menuController@bot');
$router->post('/menusUpdate', 'med_menuController@update'); //setting tambah baru
$router->post('/menusDelete', 'med_menuController@delete');

// med_kementerian api
$router->post('/addKementerians', 'med_kementerianController@register');
$router->post('/kementerians', 'med_kementerianController@show');
$router->get('/kementeriansList', 'med_kementerianController@list');
$router->post('/kementeriansUpdate', 'med_kementerianController@update'); //setting tambah baru
$router->post('/kementeriansDelete', 'med_kementerianController@delete');

// med_agensi api
$router->post('/addAgensis', 'med_agensiController@register');
$router->post('/agensis', 'med_agensiController@show');
$router->get('/agensisList', 'med_agensiController@list');
$router->post('/agensisUpdate', 'med_agensiController@update'); //setting tambah baru
$router->post('/agensisDelete', 'med_agensiController@delete');

// med_bahagian api
$router->post('/addBahagians', 'med_bahagianController@register');
$router->post('/bahagians', 'med_bahagianController@show');
$router->get('/bahagians/{kod_kementerian}/{kod_agensi}', 'med_bahagianController@showGet');
$router->get('/bahagiansList', 'med_bahagianController@list');
$router->post('/bahagiansUpdate', 'med_bahagianController@update'); //setting tambah baru
$router->post('/bahagiansDelete', 'med_bahagianController@delete');

// med_ilawam api
$router->post('/addIlawams', 'med_ilawamController@register');
$router->post('/ilawams', 'med_ilawamController@show');
$router->get('/ilawams/{kod_bahagian}', 'med_ilawamController@showGet');
$router->get('/ilawamsList', 'med_ilawamController@list');
$router->post('/ilawamsUpdate', 'med_ilawamController@update'); //setting tambah baru
$router->post('/ilawamsDelete', 'med_ilawamController@delete');

// med_log api
$router->post('/addLogs', 'med_logController@register');
$router->post('/logs', 'med_logController@show');
$router->get('/logsList', 'med_logController@list');

// med_sysposkod api
$router->get('/sysposkod/{poskod}', 'med_sysposkodController@show');
$router->get('/sysposkodList', 'med_sysposkodController@list');