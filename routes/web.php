<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('home', 'SocialController@inicio')->name('home');


/*Route::get('/home', function () {
    return view('home');
});*/

Route::get('/', 'SocialController@inicio');
// Route::get('/', 'home');

Auth::routes();

// PANEL DE CONTROL
Route::get('/home', 'PanelController@inicio');
Route::get('Panel/inicio', 'PanelController@inicio');

// RED SOCIAL
Route::get('Social/inicio', 'SocialController@inicio');

// USUARIOS
Route::get('User/listado', 'UserController@listado');
Route::get('User/nuevo', 'UserController@nuevo');
Route::post('User/ajaxDistrito', 'UserController@ajaxDistrito');
Route::post('User/ajaxOtb', 'UserController@ajaxOtb');
Route::post('User/guarda', 'UserController@guarda');
Route::get('User/ajax_listado', 'UserController@ajax_listado');
Route::get('User/edita/{id}', 'UserController@edita');
Route::get('User/elimina/{id}', 'UserController@elimina');

// SECTORES
Route::get('Sector/distritos', 'SectorController@distritos');
Route::post('Sector/guarda', 'SectorController@guarda');
Route::get('Sector/elimina/{sector_id}', 'SectorController@elimina');
Route::get('Sector/otbs/{distrito_id}', 'SectorController@otbs');
Route::post('Sector/guardaOtb', 'SectorController@guardaOtb');
Route::get('Sector/eliminaOtb/{otb_id}', 'SectorController@eliminaOtb');

// EVENTOS
Route::get('Evento/listado', 'EventoController@listado');
Route::get('Evento/ajax_listado', 'EventoController@ajax_listado');
Route::get('Evento/nuevo', 'EventoController@nuevo');
Route::get('Evento/nuevo', 'EventoController@nuevo');
Route::get('Evento/edita/{id}', 'EventoController@edita');
Route::post('Evento/guarda', 'EventoController@guarda');