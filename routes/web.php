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
Route::get('/', 'UserController@listado');
// Route::get('/', 'home');

Auth::routes();

// PANEL DE CONTROL
Route::get('/home', 'PanelController@inicio');
Route::get('Panel/inicio', 'PanelController@inicio');

// PATRIMONIO
Route::get('patrimonio/formulario', 'PatrimonioController@formulario');
Route::post('patrimonio/guarda', 'PatrimonioController@guarda');
Route::get('patrimonio/listado', 'PatrimonioController@listado');

// RED SOCIAL
Route::get('Social/inicio', 'SocialController@inicio');
Route::post('User/ajaxDistrito', 'UserController@ajaxDistrito');

// USUARIOS
Route::get('User/listado', 'UserController@listado');
Route::get('User/nuevo', 'UserController@nuevo');
Route::post('User/ajaxOtb', 'UserController@ajaxOtb');
Route::post('User/guarda', 'UserController@guarda');
Route::get('User/ajax_listado', 'UserController@ajax_listado');
Route::get('User/edita/{id}', 'UserController@edita');
Route::get('User/elimina/{id}', 'UserController@elimina');