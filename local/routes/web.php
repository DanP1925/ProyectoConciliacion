<?php


Route::get('/', function () {
    return view('index');
})->name('index');

Auth::routes();

Route::get('/obtenerSesion','SesionController@obtenerSesion');   // LOGICA DE NEGOCIO PARA CARGAR LA SESION USUARIO

// EXTERNAL NEW USER
Route::get('/n7mnEtdhsPYDAxK/usuario/nuevo','UsuarioController@nuevoExternal');
Route::post('/n7mnEtdhsPYDAxK/usuario/registrar','UsuarioController@registar')->name('registrarExternal');


Route::middleware(['auth'])->group(function () {

    Route::get('/usuario/nuevo','UsuarioController@nuevo');

    Route::post('/usuario/registrar','UsuarioController@registar')->name('registrar');

    Route::get('/expediente/lista','ExpedienteController@lista');

    Route::get('/expediente/nuevo','ExpedienteController@nuevo');

    Route::get('/expediente/info/{idExpediente}','ExpedienteController@info');

    Route::get('/expediente/editar/{idExpediente}','ExpedienteController@editar');


    // ==============
    // DESIGNACIONES
    // ==============
    Route::get('/designacion/lista','DesignacionController@lista');

    // >> Designacion Nuevo
    Route::get('/designacion/nuevo/{idDesignacion}','DesignacionController@nuevo');
    Route::get('/designacion/nuevo/propuesta/{idDesignacion}','DesignacionController@propuesta');
    Route::get('/designacion/nuevo/propuesta/detalle/{hash}','DesignacionController@propuestaDetalle');
    Route::post('/designacion/nuevo/registrar','DesignacionController@registrar');
    Route::post('/designacion/nuevo/validar/expediente','DesignacionController@validarExpedientePropuesta');


    // >> Designacion Sesion datos
    Route::post('/designacion/sesion/datos','DesignacionController@sesionDatos');
    Route::post('/designacion/sesion/datos/expediente','DesignacionController@sesionDatosExpediente');
    Route::post('/designacion/sesion/datos/personal','DesignacionController@sesionDatosPersonal');
    Route::post('/designacion/sesion/datos/propuesta','DesignacionController@sesionDatosPropuesta');
    Route::post('/designacion/sesion/datos/verificar','DesignacionController@sesionVerificarPropuesta');

    // >> Designacion Buscar
    Route::get('/designacion/buscar/expediente','DesignacionController@buscarExpediente');
    Route::get('/designacion/buscar/personal','DesignacionController@buscarPersonal');
    Route::get('/designacion/buscar/personal/historico/{idPersonal}','DesignacionController@buscarPersonalHistorico');

    // >> Designacion Editar
    Route::get('/designacion/editar/{idDesignacion}/{flgInicio}','DesignacionController@editar');
    Route::post('/designacion/editar/registrar','DesignacionController@registrarEditar');

    // >> Designacion Borrar
    Route::get('/designacion/borrar/{idDesignacion}','DesignacionController@borrar');
    Route::get('/designacion/borrar/propuesta/{hash}','DesignacionController@sesionBorrarPersonal');

    // ============
    // INCIDENTES
    // ============
    Route::get('/incidente/lista','IncidenteController@lista');

    // >> Incidente Nuevo
    Route::get('/incidente/nuevo/{idIncidente}','IncidenteController@nuevo');
    Route::get('/incidente/nuevo/fecha/{idIncidente}','IncidenteController@nuevaFecha');
    Route::get('/incidente/nuevo/observacion/{idIncidente}','IncidenteController@nuevaObservacion');
    Route::post('/incidente/nuevo/registrar','IncidenteController@registrar');
    Route::get('/incidente/nuevo/borrar/fecha/{hash}','IncidenteController@sesionBorrarFecha');
    Route::get('/incidente/nuevo/borrar/observacion/{hash}','IncidenteController@sesionBorrarObservacion');
    Route::get('/incidente/nuevo/borrar/recusante/{hash}','IncidenteController@sesionBorrarRecusante');
    Route::get('/incidente/nuevo/borrar/renunciante/{hash}','IncidenteController@sesionBorrarRenunciante');

    // >> Incidente Editar
    Route::get('/incidente/editar/{idIncidente}/{flgInicio}','IncidenteController@editar');
    Route::post('/incidente/editar/registrar','IncidenteController@registrarEditar');

    // >> Incidente Borrar
    Route::get('/incidente/borrar/{idIncidente}','IncidenteController@borrar');

    // >> Incidente Sesion datos
    Route::post('/incidente/sesion/datos','IncidenteController@sesionDatos');
    Route::post('/incidente/sesion/datos/fecha','IncidenteController@sesionDatosFecha');
    Route::post('/incidente/sesion/datos/observacion','IncidenteController@sesionDatosObservacion');
    Route::post('/incidente/sesion/datos/personal','IncidenteController@sesionDatosPersonal');
    Route::post('/incidente/sesion/datos/expediente','IncidenteController@sesionDatosExpediente');

    // >> Incidente Buscar
    Route::get('/incidente/buscar/expediente','IncidenteController@buscarExpediente');
    Route::get('/incidente/buscar/personal/{tipoPersonal}','IncidenteController@buscarPersonal');


    // ============
    // FACTURACION
    // ============
    Route::get('/facturacion/lista','FacturacionController@lista');

    // >> Facturacion Nuevo
    Route::get('/facturacion/nuevo/{idFactura}','FacturacionController@nuevo');
    Route::get('/facturacion/nuevo/notificacion/{idFactura}','FacturacionController@nuevaNotificacion');
    Route::get('/facturacion/nuevo/importe/{idFactura}','FacturacionController@nuevoImporte');
    Route::get('/facturacion/nuevo/observacion/{idFactura}','FacturacionController@nuevaObservacion');
    Route::post('/facturacion/nuevo/registrar','FacturacionController@registrar');
    Route::get('/facturacion/nuevo/borrar/notificacion/{hash}','FacturacionController@sesionBorrarNotificacion');
    Route::get('/facturacion/nuevo/borrar/importe/{hash}','FacturacionController@sesionBorrarImporte');
    Route::get('/facturacion/nuevo/borrar/observacion/{hash}','FacturacionController@sesionBorrarObservacion');

    // >> Facturacion Editar
    Route::get('/facturacion/editar/{idFactura}/{flgInicio}','FacturacionController@editar');
    Route::post('/facturacion/editar/registrar','FacturacionController@registrarEditar');

    // >> Facturacion Borrar
    Route::get('/facturacion/borrar/{idFactura}','FacturacionController@borrar');

    // >> Facturacion Sesion datos
    Route::post('/facturacion/sesion/datos','FacturacionController@sesionDatos');
    Route::post('/facturacion/sesion/datos/notificacion','FacturacionController@sesionDatosNotificacion');
    Route::post('/facturacion/sesion/datos/importe','FacturacionController@sesionDatosImporte');
    Route::post('/facturacion/sesion/datos/observacion','FacturacionController@sesionDatosObservacion');
    Route::post('/facturacion/sesion/datos/cliente','FacturacionController@sesionDatosCliente');
    Route::post('/facturacion/sesion/datos/expediente','FacturacionController@sesionDatosExpediente');

    // >> Facturacion Buscar
    Route::get('/facturacion/buscar/cliente','FacturacionController@buscarCliente');
    Route::get('/facturacion/buscar/expediente','FacturacionController@buscarExpediente');


    // ============
    // EXPEDIENTE
    // ============
    Route::get('/expediente/lista','ExpedienteController@lista');

    // >> Expediente Nuevo
    Route::get('/expediente/nuevo','ExpedienteController@nuevo');
    Route::post('/expediente/nuevo','ExpedienteController@nuevo');
    Route::post('/expediente/lista','ExpedienteController@guardar');

    // >> Expediente Editar
    Route::get('/expediente/editar/{idExpediente}','ExpedienteController@editar');

    // >> Expediente Borrar
    Route::post('/expediente/borrar/{idExpediente}','ExpedienteController@borrar');

    // >> Expediente Buscar
    Route::get('/expediente/lista','ExpedienteController@lista');
    Route::get('/expediente/info/{id}', 'ExpedienteController@info');
    Route::post('/expediente/info/{id}','ExpedienteController@info');

    // >> Expediente Directorios Auxiliares
    Route::get('/expediente/usuariolegal/directorio','ExpedienteController@buscarPersonal');
    Route::get('/expediente/clientelegal/directorio','ExpedienteController@buscarCliente');
    Route::get('/expediente/region/directorio','ExpedienteController@buscarRegion');

    // >> Expediente Recursos Laudado
    Route::post('/expediente/recurso/nuevo','ExpedienteController@nuevoRecurso');
    Route::post('/expediente/recurso/editar','ExpedienteController@editarRecurso');


});
