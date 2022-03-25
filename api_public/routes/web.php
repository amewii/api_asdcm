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

// kampus api
$router->post('/addKampus', 'kampusesController@register');
$router->post('/kampus', 'kampusesController@show');
$router->get('/kampusList', 'kampusesController@list');
$router->get('/kampusListAll', 'kampusesController@listall');
$router->post('/kampusUpdate', 'kampusesController@update'); //setting tambah baru
$router->post('/kampusDelete', 'kampusesController@delete');

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

// gelarans api
$router->post('/addGelarans', 'gelaransController@register');
$router->post('/gelarans', 'gelaransController@show');
$router->get('/gelaransList', 'gelaransController@list');
$router->get('/gelaransListAll', 'gelaransController@listall');
$router->post('/gelaransUpdate', 'gelaransController@update'); //setting tambah baru
$router->post('/gelaransDelete', 'gelaransController@delete');

// klusters api
$router->post('/addKlusters', 'klustersController@register');
$router->post('/klusters', 'klustersController@show');
$router->get('/klustersList', 'klustersController@list');
$router->post('/klustersUpdate', 'klustersController@update'); //setting tambah baru
$router->post('/klustersDelete', 'klustersController@delete');

// subklusters api
$router->post('/addSubklusters', 'subklustersController@register');
$router->post('/subklusters', 'subklustersController@show');
$router->get('/subklusters/{FK_kluster}', 'subklustersController@showGet');
$router->get('/subklustersList', 'subklustersController@list');
$router->post('/subklustersUpdate', 'subklustersController@update'); //setting tambah baru
$router->post('/subklustersDelete', 'subklustersController@delete');

// moduls api
$router->post('/addModuls', 'modulsController@register');
$router->post('/moduls', 'modulsController@show');
$router->get('/modulsList', 'modulsController@list');
$router->post('/modulsUpdate', 'modulsController@update'); //setting tambah baru
$router->post('/modulsDelete', 'modulsController@delete');

// sub_moduls api
$router->post('/addSubmoduls', 'sub_modulsController@register');
$router->post('/submoduls', 'sub_modulsController@show');
$router->get('/submoduls/{FK_modul}', 'sub_modulsController@showSubmodul');
$router->get('/submodulsList', 'sub_modulsController@list');
$router->post('/submodulsUpdate', 'sub_modulsController@update'); //setting tambah baru
$router->post('/submodulsDelete', 'sub_modulsController@delete');

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

// unit api
$router->post('/addUnits', 'unitsController@register');
$router->post('/units', 'unitsController@show');
$router->get('/units/{FK_kluster}/{FK_subkluster}', 'unitsController@showGet');
$router->get('/unitsList', 'unitsController@list');
$router->post('/unitsUpdate', 'unitsController@update'); //setting tambah baru
$router->post('/unitsDelete', 'unitsController@delete');

// vip api
$router->post('/addVips', 'vipsController@register');
$router->post('/vips', 'vipsController@show');
$router->get('/vipsList', 'vipsController@list');
$router->get('/vipsListAll', 'vipsController@listall');
$router->post('/vipsUpdate', 'vipsController@update'); //setting tambah baru
$router->post('/vipsDelete', 'vipsController@delete');

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

// menu api
$router->post('/addMenus', 'menusController@register');
$router->post('/menus', 'menusController@show');
$router->get('/menusList', 'menusController@list');
$router->get('/menusTop', 'menusController@top');
$router->get('/menusMid/{FK_parent}', 'menusController@mid');
$router->get('/menusBot/{FK_parent}', 'menusController@bot');
$router->post('/menusUpdate', 'menusController@update'); //setting tambah baru
$router->post('/menusDelete', 'menusController@delete');

// kementerian api
$router->post('/addKementerians', 'kementeriansController@register');
$router->post('/kementerians', 'kementeriansController@show');
$router->get('/kementeriansList', 'kementeriansController@list');
$router->post('/kementeriansUpdate', 'kementeriansController@update'); //setting tambah baru
$router->post('/kementeriansDelete', 'kementeriansController@delete');

// agensi api
$router->post('/addAgensis', 'agensisController@register');
$router->post('/agensis', 'agensisController@show');
$router->get('/agensisList', 'agensisController@list');
$router->post('/agensisUpdate', 'agensisController@update'); //setting tambah baru
$router->post('/agensisDelete', 'agensisController@delete');

// bahagian api
$router->post('/addBahagians', 'bahagiansController@register');
$router->post('/bahagians', 'bahagiansController@show');
$router->get('/bahagians/{kod_kementerian}/{kod_agensi}', 'bahagiansController@showGet');
$router->get('/bahagiansList', 'bahagiansController@list');
$router->post('/bahagiansUpdate', 'bahagiansController@update'); //setting tambah baru
$router->post('/bahagiansDelete', 'bahagiansController@delete');

// ilawam api
$router->post('/addIlawams', 'ilawamsController@register');
$router->post('/ilawams', 'ilawamsController@show');
$router->get('/ilawams/{kod_bahagian}', 'ilawamsController@showGet');
$router->get('/ilawamsList', 'ilawamsController@list');
$router->post('/ilawamsUpdate', 'ilawamsController@update'); //setting tambah baru
$router->post('/ilawamsDelete', 'ilawamsController@delete');

// log api
$router->post('/addLogs', 'logsController@register');
$router->post('/logs', 'logsController@show');
$router->get('/logsList', 'logsController@list');

// sysposkod api
$router->get('/sysposkod/{poskod}', 'sysposkodController@show');
$router->get('/sysposkodList', 'sysposkodController@list');