@extends('layouts.app')

@section('content')

<div class="grid-container">

    <div class="site-title-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="table-2cells-div">
                    <div class="left-div">
                        <div class="site-title">
                            DETALLE PROPUESTA
                        </div>
                    </div>
                    <div class="right-div">
                        <div id="btn-registrar-propuesta" class="site-title-button float-right">
                            Registrar Propuesta
                        </div>
                        <a href="{{ url('/designacion/nuevo',['idDesignacion' => "-"]) }}">
                            <div id="btn-regresar" class="site-title-button site-title-button-padding float-right">
                                Regresar
                            </div>
                        </a>
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
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="numeroExpediente" name="numeroExpediente" class="site-input" value="{{ $objExpediente['numeroExpediente'] }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Cuantía Controversia
                                    </div>
                                </div>
                                <div class="right-div">
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="cuantiaControversia" name="cuantiaControversia" class="site-input" value="{{ $objExpediente['cuantiaControversia'] }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Fecha Solicitud
                                    </div>
                                </div>
                                <div class="right-div">
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="fechaSolicitud" name="fechaSolicitud" class="site-input" value="{{ $objExpediente['fechaSolicitud'] }}" readonly />
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
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Demandante
                                    </div>
                                </div>
                                <div class="right-div">
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="demandante" name="demandante" class="site-input" value="{{ $objExpediente['demandante'] }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Demandado
                                    </div>
                                </div>
                                <div class="right-div">
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="demandado" name="demandado" class="site-input" value="{{ $objExpediente['demandado'] }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                    </div>
                </div>
            </div>
            <div class="cell small-12">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12 large-4">
                        @if(count($consorcioDemandante)>0)
                            <div class="site-line">
                                <div class="table-full-cell-div padding-bottom-5">
                                    <div class="site-label">
                                        <strong>Miembros Demandante</strong>
                                    </div>
                                </div>
                                @foreach($consorcioDemandante as $miembroDemandante)
                                    <div class="site-control">
                                        @if($loop->iteration % 2 == 0)
                                            <div class="site-control-no-border">
                                        @else
                                            <div class="site-control-no-border" style="background-color:#F5F5F5;">
                                        @endif
                                                {{ $miembroDemandante['nombre'] }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="cell small-12 large-4">
                        @if(count($consorcioDemandado)>0)
                            <div class="site-line">
                                <div class="table-full-cell-div padding-bottom-5">
                                    <div class="site-label">
                                        <strong>Miembros Demandado</strong>
                                    </div>
                                </div>
                                @foreach($consorcioDemandado as $miembroDemandado)
                                    <div class="site-control">
                                        @if($loop->iteration % 2 == 0)
                                            <div class="site-control-no-border">
                                        @else
                                            <div class="site-control-no-border" style="background-color:#F5F5F5;">
                                        @endif
                                            {{ $miembroDemandado['nombre'] }}
                                        </div>
                                    </div>
                                @endforeach
                             </div>
                        @endif
                    </div>
                    <div class="cell small-12 large-4">
                    </div>
                </div>
            </div>
            <div class="cell small-12">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Árbitro Demandante
                                    </div>
                                </div>
                                <div class="right-div">
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="arbitroDemandante" name="arbitroDemandante" class="site-input" value="{{ $objExpediente['arbitroDemandante'] }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Árbitro Demandado
                                    </div>
                                </div>
                                <div class="right-div">
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="arbitroDemandado" name="arbitroDemandado" class="site-input" value="{{ $objExpediente['arbitroDemandado'] }}" readonly />
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


    <div class="site-section-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    <strong>PROPUESTA ACTUAL</strong>
                                </div>
                            </div>
                            <div class="right-div">
                                <div id="btn-buscar-personal" class="site-label-button float-right">
                                    registrar personal
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                    </div>
                    @if(count($objDesignacion['propuestas'])>0)
                        @foreach($objDesignacion['propuestas'] as $propuesta)
                            <div class="cell small-12">
                                <div class="list-div" style="background-color:#F5F5F5;">
                                    <div class="list-text-3-div">
                                        <div class="list-label-avant-garde-lite">
                                            Nombre
                                        </div>
                                        <div class="list-biglabel-avant-garde-regular">
                                            {{ $propuesta['nombre'] }}
                                        </div>
                                    </div>
                                    <div class="list-text-3-div">
                                        <div class="list-label-avant-garde-lite">
                                            Especialidad
                                        </div>
                                        <div class="list-biglabel-avant-garde-regular">
                                            {{ $propuesta['especialidad'] }}
                                        </div>
                                    </div>
                                    <div idBorrar="{{ $propuesta['hash'] }}" class="btn-borrar-propuesta list-edit-icon-div">
                                        <img src="{{ asset('images/ico_delete_red.png') }}" />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="cell small-12">
                            <div class="list-edit-no-items-div">
                                <div class="list-edit-text-div">
                                    <div class="list-avant-garde-regular color-9B9B9B">
                                        NO HAY PROPUESTA REGISTRADA
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
        &nbsp
    </div>

</div>

<input type="hidden" id="idDesignacion" name="idDesignacion" value="{{ $objDesignacion['idDesignacion'] }}" />
<input type="hidden" id="borrarItem" name="borrarItem" value="" />

@include('shared.modals')

<script>

    // VARIABLES JS EXTERNAS
    var _token = "{{ csrf_token() }}";
    var urlGuardarDatos = '{{ url('/designacion/sesion/datos') }}';
    var urlBuscarPersonal = '{{ url('/designacion/buscar/personal') }}';
    var urlRegistrarPropuesta = '{{ url('/designacion/nuevo/registrar') }}';
    var urlDesignacionListar = '{{ url('/designacion/lista') }}';


    // =======================
    //  REGISTRAR DESIGNACION
    // =======================

    $("#btn-registrar-propuesta").click(function() {
        $('#modalRegistrarConfirmar').foundation('open');
    });

    $("#btn-registrar").click(function() {
        $('#modalRegistrarConfirmar').foundation('close');
        $('#modalRegistrarMensaje').foundation('open');

        var idDesignacion = $('#idDesignacion').val();

        var designacionData = {
            "_token": _token,
            "idDesignacion" : $('#idDesignacion').val(),
        };

        $.ajax({
            type: 'POST',
            data: designacionData,
            url: urlRegistrarPropuesta,
            success: function (data) {
                window.location=urlDesignacionListar;
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

    $("#btn-buscar-personal").click(function() {
        $('#modalContenidosMensaje').foundation('open');

        var idDesignacion = $('#idDesignacion').val();
        var _urlBuscarPersonal = urlBuscarPersonal;

        var designacionData = {
            "_token": _token,
            "idDesignacion" : $('#idDesignacion').val(),
        };

        $.ajax({
            type: 'POST',
            data: designacionData,
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

    $(".btn-borrar-notificacion").click(function() {
         var idBorrar = $(this).attr("idBorrar");
         $("#borrarItem").val(idBorrar);
         $('#modalBorrarConfirmar01').foundation('open');
    });

    $("#btn-borrar-01").click(function() {
        $('#modalBorrarConfirmar01').foundation('close');
        $('#modalBorrarMensaje').foundation('open');

        var idFactura = $('#idFactura').val();
        var idBorrar = $("#borrarItem").val();
        var _urlNuevaFactura = urlNuevaFactura+'/'+idFactura;
        var _urlNotificacionBorrar = urlNotificacionBorrar+'/'+idBorrar;

        $.ajax({
            type: 'GET',
            url: _urlNotificacionBorrar,
            success: function (data) {
                window.location=_urlNuevaFactura;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalBorrarMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });

    });

    // ==========================================================

    $(".btn-borrar-importe").click(function() {
        var idBorrar = $(this).attr("idBorrar");
        $("#borrarItem").val(idBorrar);
        $('#modalBorrarConfirmar02').foundation('open');
    });

    $("#btn-borrar-02").click(function() {
        $('#modalBorrarConfirmar02').foundation('close');
        $('#modalBorrarMensaje').foundation('open');

        var idFactura = $('#idFactura').val();
        var idBorrar = $("#borrarItem").val();
        var _urlNuevaFactura = urlNuevaFactura+'/'+idFactura;
        var _urlImporteBorrar = urlImporteBorrar+'/'+idBorrar;

        $.ajax({
            type: 'GET',
            url: _urlImporteBorrar,
            success: function (data) {
                window.location=_urlNuevaFactura;
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
        $('#modalBorrarConfirmar03').foundation('open');
    });

    $("#btn-borrar-03").click(function() {
        $('#modalBorrarConfirmar03').foundation('close');
        $('#modalBorrarMensaje').foundation('open');

        var idFactura = $('#idFactura').val();
        var idBorrar = $("#borrarItem").val();
        var _urlNuevaFactura = urlNuevaFactura+'/'+idFactura;
        var _urlObservacionBorrar = urlObservacionBorrar+'/'+idBorrar;

        $.ajax({
            type: 'GET',
            url: _urlObservacionBorrar,
            success: function (data) {
                window.location=_urlNuevaFactura;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalBorrarMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });
    });



</script>


@endsection
