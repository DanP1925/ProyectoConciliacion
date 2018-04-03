@extends('layouts.app')

@section('content')

<div class="grid-container">

    <div class="site-title-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="table-2cells-div">
                    <div class="left-div">
                        <div class="site-title">
                            NUEVO INCIDENTE
                        </div>
                    </div>
                    <div class="right-div">
                        <a href="{{ url('/incidente/lista') }}">
                            <div id="btn-regresar" class="site-title-button float-right">
                                Regresar
                            </div>
                        </a>
                        <div id="btn-registrar-incidente" class="site-title-button site-title-button-padding float-right">
                            Registrar Incidente
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Número Expediente
                                    </div>
                                </div>
                                <div class="right-div">
                                    <div id="btn-buscar-expediente" class="site-label-button float-right">
                                        buscar
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="numeroExpediente" name="numeroExpediente" class="site-input" value="{{ $objIncidente['expediente'][0]['numero'] }}" readonly />
                                    <input type="hidden" id="idExpediente" name="idExpediente" value="{{ $objIncidente['expediente'][0]['idExpediente'] }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="site-label padding-bottom-5">
                                Tipo Incidente
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <select class="site-select" id="tipo" name="tipo">
                                        <option value="">Seleccione una opción</option>
                                        @foreach($lstIncidenteTipo as $incidenteTipo)
                                            @if($objIncidente['tipo']==$incidenteTipo['idIncidenteTipo'])
                                                <option value="{{ $incidenteTipo['idIncidenteTipo'] }}" selected="selected">{{ $incidenteTipo['nombre'] }}</option>
                                            @else
                                                <option value="{{ $incidenteTipo['idIncidenteTipo'] }}">{{ $incidenteTipo['nombre'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Secretario
                                    </div>
                                </div>
                                <div class="right-div">
                                    <div id="btn-buscar-secretario" class="site-label-button float-right">
                                        buscar
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="nombreSecretario" name="nombreSecretario" class="site-input" value="{{ $objIncidente['secretario'][0]['nombre'] }}" readonly />
                                    <input type="hidden" id="idSecretario" name="idSecretario" value="{{ $objIncidente['secretario'][0]['idSecretario'] }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell small-12">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="site-label padding-bottom-5">
                                Fecha Incidente
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="date" class="site-input" id="fechaIncidente" name="fechaIncidente" value="{{ $objIncidente['fecha_incidente'] }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="site-label padding-bottom-5">
                                Estado
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <select class="site-select" id="estado" name="estado">
                                        @if($objIncidente['estado']=="P")
                                            <option value="P" selected="selected">Pendiente</option>
                                        @else
                                            <option value="P">Pendiente</option>
                                        @endif
                                        @if($objIncidente['estado']=="R")
                                            <option value="R" selected="selected">Resuelto</option>
                                        @else
                                            <option value="R">Resuelto</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="lstRecusante" style="display:none;" class="site-section-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12 large-8">
                        <div class="site-sublabel">
                            PERSONAL RECUSANTE
                        </div>
                    </div>
                    <div class="cell small-12 large-8">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    Personal Recusante
                                </div>
                            </div>
                            <div class="right-div">
                                <div id="btn-recusante" class="site-label-button float-right">
                                    registrar personal
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                    </div>
                    @if(count($objIncidente['personal_recusante'])>0)
                        <div class="cell small-12 large-8">
                            @foreach($objIncidente['personal_recusante'] as $recusante)
                                @if($loop->iteration % 2 == 0)
                                    <div class="list-edit-div">
                                @else
                                    <div class="list-edit-div" style="background-color:#F5F5F5;">
                                @endif
                                     <div class="list-edit-text-div">
                                        <div class="list-label-avant-garde-lite">
                                            Nombre
                                        </div>
                                        <div class="list-biglabel-avant-garde-regular">
                                            {{ $recusante['nombre'] }}
                                        </div>
                                    </div>
                                    <div idBorrar="{{ $recusante['hash'] }}" class="btn-borrar-recusante list-edit-icon-div">
                                        <img src="{{ asset('images/ico_delete_red.png') }}" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="cell small-12 large-8">
                            <div class="list-edit-no-items-div">
                                <div class="list-edit-text-div">
                                    <div class="list-avant-garde-regular color-9B9B9B">
                                        NO HAY PERSONAL RECUSANTE REGISTRADAS
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="lstRenunciante" style="display:none;" class="site-section-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12 large-8">
                        <div class="site-sublabel">
                            PERSONAL RENUNCIANTE
                        </div>
                    </div>
                    <div class="cell small-12 large-8">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    Personal Renunciante
                                </div>
                            </div>
                            <div class="right-div">
                                <div id="btn-renunciante" class="site-label-button float-right">
                                    registrar personal
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                    </div>
                    @if(count($objIncidente['personal_renunciante'])>0)
                        <div class="cell small-12 large-8">
                            @foreach($objIncidente['personal_renunciante'] as $renunciante)
                                @if($loop->iteration % 2 == 0)
                                    <div class="list-edit-div">
                                @else
                                    <div class="list-edit-div" style="background-color:#F5F5F5;">
                                @endif
                                    <div class="list-edit-text-div">
                                        <div class="list-label-avant-garde-lite">
                                            Nombre
                                        </div>
                                        <div class="list-biglabel-avant-garde-regular">
                                            {{ $renunciante['nombre'] }}
                                        </div>
                                    </div>
                                    <div idBorrar="{{ $renunciante['hash'] }}" class="btn-borrar-renunciante list-edit-icon-div">
                                        <img src="{{ asset('images/ico_delete_red.png') }}" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="cell small-12 large-8">
                            <div class="list-edit-no-items-div">
                                <div class="list-edit-text-div">
                                    <div class="list-avant-garde-regular color-9B9B9B">
                                        NO HAY PERSONAL RENUNCIANTE REGISTRADOS
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="site-section-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12 large-8">
                        <div class="site-sublabel">
                            FECHAS INCIDENTE
                        </div>
                    </div>
                    <div class="cell small-12 large-8">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    Detalle de Fechas
                                </div>
                            </div>
                            <div class="right-div">
                                <div id="btn-fecha" class="site-label-button float-right">
                                    registrar fecha
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                    </div>
                    @if(count($objIncidente['fechas'])>0)
                        <div class="cell small-12 large-8">
                            @foreach($objIncidente['fechas'] as $fecha)
                                @if($loop->iteration % 2 == 0)
                                    <div class="list-edit-div">
                                @else
                                    <div class="list-edit-div" style="background-color:#F5F5F5;">
                                @endif
                                    <div class="list-edit-text-div">
                                        <div class="list-label-avant-garde-lite">
                                            {{ $fecha['fecha_orden'] }}. {{ $fecha['fecha_nombre'] }}
                                        </div>
                                        <div class="list-biglabel-avant-garde-regular">
                                            {{ $fecha['fecha'] }}
                                        </div>
                                    </div>
                                    <div idBorrar="{{ $fecha['hash'] }}" class="btn-borrar-fecha list-edit-icon-div">
                                        <img src="{{ asset('images/ico_delete_red.png') }}" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="cell small-12 large-8">
                            <div class="list-edit-no-items-div">
                                <div class="list-edit-text-div">
                                    <div class="list-avant-garde-regular color-9B9B9B">
                                        NO HAY FECHAS REGISTRADAS
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="site-section-padding site-content-padding-bottom">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12 large-8">
                        <div class="site-sublabel">
                            OBSERVACIONES
                        </div>
                    </div>
                    <div class="cell small-12 large-8">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    Observaciones
                                </div>
                            </div>
                            <div class="right-div">
                                <div id="btn-observacion" class="site-label-button float-right">
                                    registrar observación
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                    </div>
                    @if(count($objIncidente['observaciones'])>0)
                        <div class="cell small-12 large-8">
                            @foreach($objIncidente['observaciones'] as $observacion)
                                @if($loop->iteration % 2 == 0)
                                    <div class="list-edit-div">
                                @else
                                    <div class="list-edit-div" style="background-color:#F5F5F5;">
                                @endif
                                    <div class="list-edit-text-div">
                                        <div class="list-label-avant-garde-lite">
                                            Texto
                                        </div>
                                        <div class="list-biglabel-avant-garde-regular">
                                            {{ $observacion['observacion'] }}
                                        </div>
                                    </div>
                                    <div idBorrar="{{ $observacion['hash'] }}" class="btn-borrar-observacion list-edit-icon-div">
                                        <img src="{{ asset('images/ico_delete_red.png') }}" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="cell small-12 large-8">
                            <div class="list-edit-no-items-div">
                                <div class="list-edit-text-div">
                                    <div class="list-avant-garde-regular color-9B9B9B">
                                        NO HAY OBSERVACIONES REGISTRADAS
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

<input type="hidden" id="idIncidente" name="idIncidente" value="{{ $objIncidente['idIncidente'] }}" />
<input type="hidden" id="borrarItem" name="borrarItem" value="" />

@include('shared.modals')

<script>

    // VARIABLES JS EXTERNAS
    var _token = "{{ csrf_token() }}";

    var urlNuevoIncidente = '{{ url('/incidente/nuevo') }}';
    var urlGuardarDatos = '{{ url('/incidente/sesion/datos') }}';

    var urlListarIncidente = '{{ url('/incidente/lista') }}';
    var urlRegistrarIncidente = '{{ url('/incidente/nuevo/registrar') }}';

    var urlFecha = '{{ url('/incidente/nuevo/fecha') }}';
    var urlFechaBorrar = '{{ url('/incidente/nuevo/borrar/fecha') }}';

    var urlObservacion = '{{ url('/incidente/nuevo/observacion') }}';
    var urlObservacionBorrar = '{{ url('/incidente/nuevo/borrar/observacion') }}';

    var urlBuscarExpediente = '{{ url('/incidente/buscar/expediente') }}';
    var urlBuscarPersonal = '{{ url('/incidente/buscar/personal') }}';

    var urlRecusanteBorrar = '{{ url('/incidente/nuevo/borrar/recusante') }}';
    var urlRenuncianteBorrar = '{{ url('/incidente/nuevo/borrar/renunciante') }}';


    // ===============================
    //  MOSTRAR RECUSACION / RENUNCIA
    // ===============================

    if($('#tipo').val()==1){  // Lista Recusacion
        $('#lstRecusante').show();
        $('#lstRenunciante').hide();
    } else {
        if($('#tipo').val()==2){  // Lista Renuncia
            $('#lstRecusante').hide();
            $('#lstRenunciante').show();
        } else {
            $('#lstRecusante').hide();
            $('#lstRenunciante').hide();
        }
    }

    $('#tipo').on('change', function() {
        if(this.value==1){  // Lista Recusacion
            $('#lstRecusante').show();
            $('#lstRenunciante').hide();
        } else {
            if(this.value==2){  // Lista Renuncia
                $('#lstRecusante').hide();
                $('#lstRenunciante').show();
            } else {
                $('#lstRecusante').hide();
                $('#lstRenunciante').hide();
            }
        }
    })

    // =====================
    //  REGISTRAR INCIDENTE
    // =====================

    $("#btn-registrar-incidente").click(function() {
        var cont = 0;

        if($('#idExpediente').val()=="0"){
            cont = cont + 1;
        }

        if($('#idSecretario').val()=="0"){
            cont = cont + 1;
        }

        if($('#tipo').val()==""){
            cont = cont + 1;
        }

        if($('#fechaIncidente').val()==""){
            cont = cont + 1;
        }

        if(cont>0){
            $('#modalFaltanDatos').foundation('open');
        } else {
            $('#modalRegistrarConfirmar').foundation('open');
        }
    });

    $("#btn-registrar").click(function() {
        $('#modalRegistrarConfirmar').foundation('close');
        $('#modalRegistrarMensaje').foundation('open');

        var idIncidente = $('#idIncidente').val();

        var incidenteData = {
            "_token": _token,
            "idIncidente" : $('#idIncidente').val(),
            "idExpediente" : $('#idExpediente').val(),
            "tipo" : $('#tipo').val(),
            "idSecretario" : $('#idSecretario').val(),
            "fechaIncidente" : $('#fechaIncidente').val(),
            "estado" : $('#estado').val(),
        };

        $.ajax({
            type: 'POST',
            data: incidenteData,
            url: urlRegistrarIncidente,
            success: function (data) {
                window.location=urlListarIncidente;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalRegistrarMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });
    });



    // =====================
    //  REGISTRAR SUB DATOS
    // =====================


    $("#btn-recusante").click(function() {

        $('#modalContenidosMensaje').foundation('open');

        var idIncidente = $('#idIncidente').val();
        var _urlBuscarPersonal = urlBuscarPersonal+'/REC';

        var incidenteData = {
            "_token": _token,
            "idIncidente" : $('#idIncidente').val(),
            "idExpediente" : $('#idExpediente').val(),
            "numeroExpediente" : $('#numeroExpediente').val(),
            "tipo" : $('#tipo').val(),
            "idSecretario" : $('#idSecretario').val(),
            "nombreSecretario" : $('#nombreSecretario').val(),
            "fechaIncidente" : $('#fechaIncidente').val(),
            "estado" : $('#estado').val(),
        };

        $.ajax({
            type: 'POST',
            data: incidenteData,
            url: urlGuardarDatos,
            success: function (data) {
                window.location=_urlBuscarPersonal;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalContenidosMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });
    });

    $("#btn-renunciante").click(function() {

        $('#modalContenidosMensaje').foundation('open');

        var idIncidente = $('#idIncidente').val();
        var _urlBuscarPersonal = urlBuscarPersonal+'/REN';

        var incidenteData = {
            "_token": _token,
            "idIncidente" : $('#idIncidente').val(),
            "idExpediente" : $('#idExpediente').val(),
            "numeroExpediente" : $('#numeroExpediente').val(),
            "tipo" : $('#tipo').val(),
            "idSecretario" : $('#idSecretario').val(),
            "nombreSecretario" : $('#nombreSecretario').val(),
            "fechaIncidente" : $('#fechaIncidente').val(),
            "estado" : $('#estado').val(),
        };

        $.ajax({
            type: 'POST',
            data: incidenteData,
            url: urlGuardarDatos,
            success: function (data) {
                window.location=_urlBuscarPersonal;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalContenidosMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });
    });


    $("#btn-fecha").click(function() {

        if($('#tipo').val()==""){
            $('#modalIncidenteFaltaTipo').foundation('open');
        } else {
            $('#modalContenidosMensaje').foundation('open');

            var idIncidente = $('#idIncidente').val();
            var _urlFecha = urlFecha+'/'+idIncidente;

            var incidenteData = {
                "_token": _token,
                "idIncidente" : $('#idIncidente').val(),
                "idExpediente" : $('#idExpediente').val(),
                "tipo" : $('#tipo').val(),
                "idSecretario" : $('#idSecretario').val(),
                "fechaIncidente" : $('#fechaIncidente').val(),
                "estado" : $('#estado').val(),
            };

            $.ajax({
                type: 'POST',
                data: incidenteData,
                url: urlGuardarDatos,
                success: function (data) {
                    window.location=_urlFecha;
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#modalContenidosMensaje').foundation('close');
                    $('#modalErrorServer').foundation('open');
                }
            });
        }
    });

    $("#btn-observacion").click(function() {
        $('#modalContenidosMensaje').foundation('open');

        var idIncidente = $('#idIncidente').val();
        var _urlObservacion = urlObservacion+'/'+idIncidente;

        var incidenteData = {
            "_token": _token,
            "idIncidente" : $('#idIncidente').val(),
            "idExpediente" : $('#idExpediente').val(),
            "tipo" : $('#tipo').val(),
            "idSecretario" : $('#idSecretario').val(),
            "fechaIncidente" : $('#fechaIncidente').val(),
            "estado" : $('#estado').val(),
        };

        $.ajax({
            type: 'POST',
            data: incidenteData,
            url: urlGuardarDatos,
            success: function (data) {
                window.location=_urlObservacion;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalContenidosMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });
    });

    // ====================

    $("#btn-buscar-expediente").click(function() {
        $('#modalContenidosMensaje').foundation('open');

        var idIncidente = $('#idIncidente').val();
        var _urlBuscarExpediente = urlBuscarExpediente;

        var incidenteData = {
            "_token": _token,
            "idIncidente" : $('#idIncidente').val(),
            "idExpediente" : $('#idExpediente').val(),
            "numeroExpediente" : $('#numeroExpediente').val(),
            "tipo" : $('#tipo').val(),
            "idSecretario" : $('#idSecretario').val(),
            "nombreSecretario" : $('#nombreSecretario').val(),
            "fechaIncidente" : $('#fechaIncidente').val(),
            "estado" : $('#estado').val(),
        };

        $.ajax({
            type: 'POST',
            data: incidenteData,
            url: urlGuardarDatos,
            success: function (data) {
                window.location=_urlBuscarExpediente;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalContenidosMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });
    });

    $("#btn-buscar-secretario").click(function() {

        $('#modalContenidosMensaje').foundation('open');

        var idIncidente = $('#idIncidente').val();
        var _urlBuscarPersonal = urlBuscarPersonal+'/SCR';

        var incidenteData = {
            "_token": _token,
            "idIncidente" : $('#idIncidente').val(),
            "idExpediente" : $('#idExpediente').val(),
            "numeroExpediente" : $('#numeroExpediente').val(),
            "tipo" : $('#tipo').val(),
            "idSecretario" : $('#idSecretario').val(),
            "nombreSecretario" : $('#nombreSecretario').val(),
            "fechaIncidente" : $('#fechaIncidente').val(),
            "estado" : $('#estado').val(),
        };

        $.ajax({
            type: 'POST',
            data: incidenteData,
            url: urlGuardarDatos,
            success: function (data) {
                window.location=_urlBuscarPersonal;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalContenidosMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });
    });


    // =======
    // BORRAR
    // =======

    $(".btn-borrar-fecha").click(function() {
         var idBorrar = $(this).attr("idBorrar");
         $("#borrarItem").val(idBorrar);
         $('#modalBorrarConfirmar01').foundation('open');
    });

    $("#btn-borrar-01").click(function() {
        $('#modalBorrarConfirmar01').foundation('close');
        $('#modalBorrarMensaje').foundation('open');

        var idIncidente = $('#idIncidente').val();
        var idBorrar = $("#borrarItem").val();
        var _urlNuevoIncidente = urlNuevoIncidente+'/'+idIncidente;
        var _urlFechaBorrar = urlFechaBorrar+'/'+idBorrar;

        $.ajax({
            type: 'GET',
            url: _urlFechaBorrar,
            success: function (data) {
                window.location=_urlNuevoIncidente;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalBorrarMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });

    });

    // ==========================================================

    $(".btn-borrar-observacion").click(function() {
        var idBorrar = $(this).attr("idBorrar");
        $("#borrarItem").val(idBorrar);
        $('#modalBorrarConfirmar02').foundation('open');
    });

    $("#btn-borrar-02").click(function() {
        $('#modalBorrarConfirmar02').foundation('close');
        $('#modalBorrarMensaje').foundation('open');

        var idIncidente = $('#idIncidente').val();
        var idBorrar = $("#borrarItem").val();
        var _urlNuevoIncidente = urlNuevoIncidente+'/'+idIncidente;
        var _urlObservacionBorrar = urlObservacionBorrar+'/'+idBorrar;

        $.ajax({
            type: 'GET',
            url: _urlObservacionBorrar,
            success: function (data) {
                window.location=_urlNuevoIncidente;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalBorrarMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });
    });

    // ==========================================================

    $(".btn-borrar-recusante").click(function() {
        var idBorrar = $(this).attr("idBorrar");
        $("#borrarItem").val(idBorrar);
        $('#modalBorrarConfirmar03').foundation('open');
    });

    $("#btn-borrar-03").click(function() {
        $('#modalBorrarConfirmar03').foundation('close');
        $('#modalBorrarMensaje').foundation('open');

        var idIncidente = $('#idIncidente').val();
        var idBorrar = $("#borrarItem").val();
        var _urlNuevoIncidente = urlNuevoIncidente+'/'+idIncidente;
        var _urlRecusanteBorrar = urlRecusanteBorrar+'/'+idBorrar;

        $.ajax({
            type: 'GET',
            url: _urlRecusanteBorrar,
            success: function (data) {
                window.location=_urlNuevoIncidente;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalBorrarMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });

    });

    // ==========================================================

    $(".btn-borrar-renunciante").click(function() {
        var idBorrar = $(this).attr("idBorrar");
        $("#borrarItem").val(idBorrar);
        $('#modalBorrarConfirmar04').foundation('open');
    });

    $("#btn-borrar-04").click(function() {
        $('#modalBorrarConfirmar04').foundation('close');
        $('#modalBorrarMensaje').foundation('open');

        var idIncidente = $('#idIncidente').val();
        var idBorrar = $("#borrarItem").val();
        var _urlNuevoIncidente = urlNuevoIncidente+'/'+idIncidente;
        var _urlRenuncianteBorrar = urlRenuncianteBorrar+'/'+idBorrar;

        $.ajax({
            type: 'GET',
            url: _urlRenuncianteBorrar,
            success: function (data) {
                window.location=_urlNuevoIncidente;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalBorrarMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });

    });


</script>


@endsection
