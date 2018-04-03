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
                        <a href="{{ url('/designacion/nuevo',['idDesignacion' => "-"]) }}">
                            <div id="btn-regresar" class="site-title-button float-right">
                                Regresar
                            </div>
                        </a>
                        <div id="btn-registrar-propuesta" class="site-title-button site-title-button-padding float-right">
                            Registrar Propuesta
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
                                @if($loop->iteration % 2 == 0)
                                    <div class="list-div">
                                @else
                                    <div class="list-div" style="background-color:#F5F5F5;">
                                @endif
                                    <div class="list-text-2-div">
                                        <div class="list-label-avant-garde-lite">
                                            Nombre
                                        </div>
                                        <div class="list-biglabel-avant-garde-regular">
                                            {{ $propuesta['nombrePersonal'] }}
                                        </div>
                                        <div class="list-sublabel-avant-garde-regular">
                                            Propuesta: <strong>{{ date("d/m/Y", strtotime($propuesta['fecha']))  }}</strong>
                                        </div>
                                    </div>
                                    <div class="list-text-4-div">
                                        <div class="list-label-avant-garde-lite">
                                            Estado
                                        </div>
                                        <div class="list-biglabel-avant-garde-regular">
                                            {{ $propuesta['estado'][0]['nombre'] }}
                                        </div>
                                    </div>
                                    <div class="list-text-4-div">
                                        <div class="list-label-avant-garde-lite">
                                            Tipo Designacion
                                        </div>
                                        <div class="list-biglabel-avant-garde-regular">
                                            @if($propuesta['flgTipoDesignacion']=="")
                                                Por Definir
                                            @endif
                                            @if($propuesta['flgTipoDesignacion']=="C")
                                                Por la Corte
                                            @endif
                                            @if($propuesta['flgTipoDesignacion']=="P")
                                                Por las Partes
                                            @endif
                                        </div>
                                    </div>
                                    <div idSeleccionar="{{ $propuesta['hash'] }}" class="btn-seleccionar-propuesta list-edit-icon-div">
                                        <img src="{{ asset('images/ico_pointer_blue.png') }}" />
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
<input type="hidden" id="idExpediente" name="idExpediente" value="{{ $objDesignacion['expediente'][0]['id'] }}" />
<input type="hidden" id="numeroExpediente" name="numeroExpediente" value="{{ $objDesignacion['expediente'][0]['id'] }}" />
<input type="hidden" id="tipo" name="tipo" value="{{ $objDesignacion['tipoDesignacion'][0]['id'] }}" />

<input type="hidden" id="borrarItem" name="borrarItem" value="" />

@include('shared.modals')

<script>

    // VARIABLES JS EXTERNAS
    var _token = "{{ csrf_token() }}";
    var urlGuardarDatos = '{{ url('/designacion/sesion/datos') }}';
    var urlVerificarPropuesta = '{{ url('/designacion/sesion/datos/verificar') }}';
    var urlRegistrarPropuesta = '{{ url('/designacion/nuevo/registrar') }}';
    var urlDetallePropuesta = '{{ url('/designacion/nuevo/propuesta/detalle') }}';

    var urlBuscarPersonal = '{{ url('/designacion/buscar/personal') }}';
    var urlNuevaPropuesta = '{{ url('/designacion/nuevo/propuesta') }}';
    var urlBorrarPropuesta = '{{ url('/designacion/borrar/propuesta') }}';
    var urlDesignacionListar = '{{ url('/designacion/lista') }}';


    // =======================
    //  REGISTRAR DESIGNACION
    // =======================

    $("#btn-registrar-propuesta").click(function() {

        $('#modalVerificandoMensaje').foundation('open');

        var designacionData = {
            "_token": _token,
            "idDesignacion" : $('#idDesignacion').val(),
        };

        $.ajax({
            type: 'POST',
            data: designacionData,
            url: urlVerificarPropuesta,
            success: function (data) {
                if(data=="false"){
                    $('#modalVerificandoMensaje').foundation('close');
                    $('#modalDesignacionFaltaPropuesta').foundation('open');
                } else {
                    $('#modalVerificandoMensaje').foundation('close');
                    $('#modalRegistrarConfirmar').foundation('open');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalVerificandoMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });
    });

    $("#btn-registrar").click(function() {
        $('#modalRegistrarConfirmar').foundation('close');
        $('#modalRegistrarMensaje').foundation('open');

        var idDesignacion = $('#idDesignacion').val();

        var designacionData = {
            "_token": _token,
            "idDesignacion" : $('#idDesignacion').val(),
            "idExpediente" : $('#idExpediente').val(),
            "numeroExpediente" : $('#numeroExpediente').val(),
            "tipo" : $('#tipo').val(),
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


    // ===================
    //  DETALLE PROPUESTA
    // ===================

    $(".btn-seleccionar-propuesta").click(function() {
        $('#modalContenidosMensaje').foundation('open');

        var idSeleccionar = $(this).attr("idSeleccionar");
        var idDesignacion = $('#idDesignacion').val();
        var _urlDetallePropuesta = urlDetallePropuesta+'/'+idSeleccionar;

        window.location=_urlDetallePropuesta;

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
            "idExpediente" : $('#idExpediente').val(),
            "numeroExpediente" : $('#numeroExpediente').val(),
            "tipo" : $('#tipo').val(),
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

    $(".btn-borrar-propuesta").click(function() {
         var idBorrar = $(this).attr("idBorrar");
         $("#borrarItem").val(idBorrar);
         $('#modalBorrarConfirmar01').foundation('open');
    });

    $("#btn-borrar-01").click(function() {
        $('#modalBorrarConfirmar01').foundation('close');
        $('#modalBorrarMensaje').foundation('open');

        var idDesignacion = $('#idDesignacion').val();
        var idBorrar = $("#borrarItem").val();

        var _urlNuevaPropuesta = urlNuevaPropuesta+'/'+idDesignacion;
        var _urlBorrarPropuesta = urlBorrarPropuesta+'/'+idBorrar;

        $.ajax({
            type: 'GET',
            url: _urlBorrarPropuesta,
            success: function (data) {
                window.location=_urlNuevaPropuesta;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalBorrarMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });

    });


</script>


@endsection
