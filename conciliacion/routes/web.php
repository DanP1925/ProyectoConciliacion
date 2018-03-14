<?php

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

Route::get('/', function () {
    return view('index');
})->name('index');

Auth::routes();

Route::get('/obtenerSesion','SesionController@obtenerSesion');   // LOGICA DE NEGOCIO PARA CARGAR LA SESION USUARIO

Route::middleware(['auth'])->group(function () {

    Route::get('/usuario/nuevo','UsuarioController@nuevo');

    Route::post('/usuario/registrar','UsuarioController@registar')->name('registrar');

    Route::get('/expediente/lista','ExpedienteController@lista');

    Route::get('/expediente/nuevo','ExpedienteController@nuevo');

    Route::post('/expediente/nuevo','ExpedienteController@nuevo');

    Route::post('/expediente/lista','ExpedienteController@guardar');

    Route::get('/expediente/info/{idExpediente}','ExpedienteController@info');

    Route::get('/expediente/editar/{idExpediente}','ExpedienteController@editar');

    Route::get('/mantenimiento/personaNatural/nuevo','PersonaNaturalController@nuevo');

    Route::get('/mantenimiento/personaNatural/lista','PersonaNaturalController@lista');

    Route::get('/designacion/lista','DesignacionController@lista');

    Route::get('/designacion/info','DesignacionController@info');

    Route::get('/propuesta/lista','PropuestaController@lista');

    Route::get('/propuesta/nuevo','PropuestaController@nuevo');
    
    Route::get('/propuesta/detallearbitro','PropuestaController@detallearbitro');

    Route::get('/usuariolegal/arbitros','UsuarioLegalController@buscarArbitro');

    Route::post('/usuariolegal/directorio','UsuarioLegalController@buscarPersonal');

    Route::post('/clientelegal/directorio','ClienteLegalController@buscarCliente');

    Route::post('/region/directorio','RegionController@buscarRegion');

});
