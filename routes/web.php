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
Route::get('panel/inicio', 'PanelController@inicio');

// PATRIMONIO
Route::get('patrimonio/formulario/{idPatrimonio}', 'PatrimonioController@formulario');
Route::post('patrimonio/guarda', 'PatrimonioController@guarda');
Route::get('patrimonio/listado', 'PatrimonioController@listado');
Route::get('patrimonio/listadoCuentas', 'PatrimonioController@listadoCuentas');
Route::post('patrimonio/ajaxListadoCuentas', 'PatrimonioController@ajaxListadoCuentas');
Route::get('patrimonio/elimina/{id}', 'PatrimonioController@elimina');
Route::get('patrimonio/migracion', 'PatrimonioController@migracion');
Route::get('patrimonio/ficha/{patrimonioId}', 'PatrimonioController@ficha');
Route::post('patrimonio/ajaxBuscaPatrimonio', 'PatrimonioController@ajaxBuscaPatrimonio');
Route::post('patrimonio/ajaxListado', 'PatrimonioController@ajaxListado');
Route::post('patrimonio/ajaxElimina', 'PatrimonioController@ajaxElimina');
Route::get('patrimonio/impresion/{patrimonioId}', 'PatrimonioController@impresion');
Route::post('patrimonio/ajaxBuscaProvincia', 'PatrimonioController@ajaxBuscaProvincia');
Route::post('patrimonio/ajaxBuscaSubEspecialidad', 'PatrimonioController@ajaxBuscaSubEspecialidad');
Route::post('patrimonio/generaExcel', 'PatrimonioController@generaExcel');
Route::get('patrimonio/revisiones', 'PatrimonioController@revisiones');
Route::post('patrimonio/generaExcelCuentas', 'PatrimonioController@generaExcelCuentas');


// Route::get('patrimonio/impresion/{patrimonioId}', 'PatrimonioController@impresion');

// USUARIOS
Route::get('user/listado', 'UserController@listado');
Route::get('user/formulario/{idUser}', 'UserController@formulario');
Route::post('user/guarda', 'UserController@guarda');
Route::get('user/ajax_listado', 'UserController@ajax_listado');
Route::get('user/edita/{id}', 'UserController@edita');
Route::get('user/elimina/{id}', 'UserController@elimina');

// MIGRACION
Route::get('migracion/patrimonios', 'MigracionController@patrimonios');
Route::get('migracion/regularizaEstados', 'MigracionController@regularizaEstados');
Route::get('migracion/tecnicaMaterial', 'MigracionController@tecnicaMaterial');
Route::get('migracion/gilimana', 'MigracionController@gilimana');
Route::get('migracion/regularizacionAdminMna', 'MigracionController@regularizacionAdminMna');

// ESPECIALIADES
Route::get('especialidad/listado', 'EspecialidadController@listado');
Route::post('especialidad/guarda', 'EspecialidadController@guarda');
Route::get('especialidad/elimina/{id}', 'EspecialidadController@elimina');


// IMAGENES
Route::post('imagen/ajaxElimina', 'ImagenController@ajaxElimina');

// DOCUMENTOS
Route::post('documento/ajaxElimina', 'DocumentoController@ajaxElimina');

// TECNICA/MATERIAL
Route::get('tecnicamaterial/listado', 'TecnicamaterialController@listado');
Route::post('tecnicamaterial/guarda', 'TecnicamaterialController@guarda');
Route::get('tecnicamaterial/elimina/{id}', 'TecnicamaterialController@elimina');

// ESTILOS
Route::get('estilo/listado', 'EstiloController@listado');
Route::post('estilo/guarda', 'EstiloController@guarda');
Route::get('estilo/elimina/{id}', 'EstiloController@elimina');

// UBICACIONES
Route::get('ubicacion/listado', 'UbicacionController@listado');
Route::post('ubicacion/guarda', 'UbicacionController@guarda');
Route::get('ubicacion/elimina/{id}', 'UbicacionController@elimina');

// SITIO
Route::get('sitio/listado', 'SitioController@listado');
Route::post('sitio/guarda', 'SitioController@guarda');
Route::get('sitio/elimina/{id}', 'SitioController@elimina');

// MOVIMIENTOS
Route::get('movimiento/listado/{patrimonioId}', 'MovimientosController@listado');
Route::post('movimiento/guarda', 'MovimientosController@guarda');
Route::get('movimiento/elimina/{id}', 'MovimientosController@elimina');

// INMUEBLES
Route::get('inmueble/listado', 'InmuebleController@listado');
Route::post('inmueble/guarda', 'InmuebleController@guarda');
Route::get('inmueble/elimina/{inmueble_id}', 'InmuebleController@elimina');

// SUB ESPECIALIADES
Route::get('subespecialidad/listado/{especialidad_id}', 'SubEspecialidadController@listado');
Route::post('subespecialidad/guarda', 'SubEspecialidadController@guarda');
Route::get('subespecialidad/elimina/{subespecialidad_id}', 'SubEspecialidadController@elimina');

// TECNICAS
Route::get('tecnica/listado', 'TecnicaController@listado');
Route::post('tecnica/guarda', 'TecnicaController@guarda');
Route::get('tecnica/elimina/{tecnica_id}', 'TecnicaController@elimina');

// MATERIALES
Route::get('material/listado', 'MaterialController@listado');
Route::post('material/guarda', 'MaterialController@guarda');
Route::get('material/elimina/{material_id}', 'MaterialController@elimina');


// CUENTAS
Route::get('cuenta/listado', 'CuentaController@listado');
Route::post('cuenta/guarda', 'CuentaController@guarda');
Route::get('cuenta/elimina/{cuenta_id}', 'CuentaController@elimina');