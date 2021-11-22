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

// Route::get('/', 'SocialController@inicio');
Route::get('/', 'PanelController@inicio');
// Route::get('/', 'home');

Auth::routes();

// PANEL DE CONTROL
Route::get('/home', 'PanelController@inicio');
Route::get('panel/inicio', 'panelController@inicio');

// PATRIMONIO
Route::get('patrimonio/formulario/{idPatrimonio}', 'PatrimonioController@formulario');
Route::post('patrimonio/guarda', 'PatrimonioController@guarda');
Route::get('patrimonio/listado', 'PatrimonioController@listado');
Route::get('patrimonio/elimina/{id}', 'PatrimonioController@elimina');
Route::get('patrimonio/migracion', 'PatrimonioController@migracion');
Route::get('patrimonio/ficha/{patrimonioId}', 'PatrimonioController@ficha');
Route::post('patrimonio/ajaxBuscaPatrimonio', 'PatrimonioController@ajaxBuscaPatrimonio');
Route::post('patrimonio/ajaxListado', 'PatrimonioController@ajaxListado');

// USUARIOS
Route::get('User/listado', 'UserController@listado');
Route::get('User/nuevo', 'UserController@nuevo');
Route::post('User/ajaxOtb', 'UserController@ajaxOtb');
Route::post('User/guarda', 'UserController@guarda');
Route::get('User/ajax_listado', 'UserController@ajax_listado');
Route::get('User/edita/{id}', 'UserController@edita');
Route::get('User/elimina/{id}', 'UserController@elimina');

// MIGRACION
Route::get('migracion/patrimonios', 'MigracionController@patrimonios');
Route::get('migracion/regularizaEstados', 'MigracionController@regularizaEstados');

// ESPECIALIADES
Route::get('especialidad/listado', 'EspecialidadController@listado');