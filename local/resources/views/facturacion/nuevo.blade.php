@extends('layouts.app')

@section('content')

<div class="grid-container">

    <div class="site-title-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="table-2cells-div">
                    <div class="left-div">
                        <div class="site-title">
                            NUEVA FACTURA
                        </div>
                    </div>
                    <div class="right-div">
                        <a href="{{ url('/facturacion/lista') }}">
                            <div id="btn-regresar" class="site-title-button float-right">
                                Regresar
                            </div>
                        </a>
                        <div id="btn-registrar-factura" class="site-title-button site-title-button-padding float-right">
                            Registrar Factura
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
                                        Cliente
                                    </div>
                                </div>
                                <div class="right-div">
                                    <div id="btn-buscar-cliente" class="site-label-button float-right">
                                        buscar
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="nombreCliente" name="nombreCliente" class="site-input" value="{{ $objFactura['cliente'][0]['nombreCliente'] }}" readonly />
                                    <input type="hidden" id="idCliente" name="idCliente" value="{{ $objFactura['cliente'][0]['idCliente'] }}" />
                                    <input type="hidden" id="flgClienteTipoPersona" name="idCliente" value="{{ $objFactura['cliente'][0]['flgClienteTipoPersona'] }}" />
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <input type="text" id="numeroExpediente" name="numeroExpediente" class="site-input" value="{{ $objFactura['expediente'][0]['numeroExpediente'] }}" readonly />
                                    <input type="hidden" id="idExpediente" name="idExpediente" value="{{ $objFactura['expediente'][0]['idExpediente'] }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="site-label padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Número Comprobante
                                    </div>
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" class="site-input" id="numeroComprobante" name="numeroComprobante" value="{{ $objFactura['numero_comprobante'] }}" />
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
                                Concepto
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <select class="site-select" id="concepto" name="concepto">
                                        <option value="">Seleccione una opción</option>
                                        @foreach($lstFacturaConcepto as $facturaConcepto)
                                            @if($objFactura['concepto'][0]['idConcepto']==$facturaConcepto['idFacturaConcepto'])
                                                <option value="{{ $facturaConcepto['idFacturaConcepto'] }}" selected="selected">{{ $facturaConcepto['nombre'] }}</option>
                                            @else
                                                <option value="{{ $facturaConcepto['idFacturaConcepto'] }}">{{ $facturaConcepto['nombre'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="site-label padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Estado
                                    </div>
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <select class="site-select" id="estado" name="estado">
                                        <option value="">Seleccione una opción</option>
                                        @foreach($lstFacturaEstado as $facturaEstado)
                                            @if($objFactura['estado'][0]['idEstado']==$facturaEstado['idFacturaEstado'])
                                                <option value="{{ $facturaEstado['idFacturaEstado'] }}" selected="selected">{{ $facturaEstado['nombre'] }}</option>
                                            @else
                                                <option value="{{ $facturaEstado['idFacturaEstado'] }}">{{ $facturaEstado['nombre'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="site-label padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Importe Facturación (S/.)
                                    </div>
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" class="site-input" id="importeFacturacion" name="importeFacturacion" value="{{ $objFactura['importe_facturacion'] }}" />
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
                                Fecha Emisión
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="date" class="site-input" id="fechaEmision" name="fechaEmision" value="{{ $objFactura['fecha_emision'] }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="site-label padding-bottom-5">
                                Fecha Vencimiento
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="date" class="site-input" id="fechaVencimiento" name="fechaVencimiento" value="{{ $objFactura['fecha_vencimiento'] }}" />
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
                    <div class="cell small-12 large-8">
                        <div class="site-sublabel">
                            FECHAS NOTIFICACIÓN
                        </div>
                    </div>
                    <div class="cell small-12 large-8">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    Fecha de notificación
                                </div>
                            </div>
                            <div class="right-div">
                                <div id="btn-notificacion" class="site-label-button float-right">
                                    registrar notificación
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                    </div>
                    @if(count($objFactura['fechas_notificacion'])>0)
                        <div class="cell small-12 large-8">
                            @foreach($objFactura['fechas_notificacion'] as $fechaNotificacion)
                                @if($loop->iteration % 2 == 0)
                                    <div class="list-edit-div">
                                @else
                                    <div class="list-edit-div" style="background-color:#F5F5F5;">
                                @endif
                                    <div class="list-edit-text-div">
                                        <div class="list-label-avant-garde-lite">
                                            Fecha
                                        </div>
                                        <div class="list-biglabel-avant-garde-regular">
                                            {{ $fechaNotificacion['fecha'] }}
                                        </div>
                                    </div>
                                    <div idBorrar="{{ $fechaNotificacion['hash'] }}" class="btn-borrar-notificacion list-edit-icon-div">
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
    <div class="site-section-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12 large-8">
                        <div class="site-sublabel">
                            IMPORTES FACTURADOS
                        </div>
                    </div>
                    <div class="cell small-12 large-8">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    Importes Parciales
                                </div>
                            </div>
                            <div class="right-div">
                                <div id="btn-importe" class="site-label-button float-right">
                                    registrar importe
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                    </div>
                    @if(count($objFactura['importes_facturados'])>0)
                        <div class="cell small-12 large-8">
                            @foreach($objFactura['importes_facturados'] as $importeFacturado)
                                @if($loop->iteration % 2 == 0)
                                    <div class="list-edit-div">
                                @else
                                    <div class="list-edit-div" style="background-color:#F5F5F5;">
                                @endif
                                    <div class="list-edit-text-div">
                                        <div class="list-label-avant-garde-lite">
                                            Importe
                                        </div>
                                        <div class="list-biglabel-avant-garde-regular">
                                            S/.{{ $importeFacturado['importeParcial'] }}
                                        </div>
                                    </div>
                                    <div idBorrar="{{ $importeFacturado['hash'] }}" class="btn-borrar-importe list-edit-icon-div">
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
                                        NO HAY IMPORTES REGISTRADOS
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
                    @if(count($objFactura['observaciones'])>0)
                        <div class="cell small-12 large-8">
                            @foreach($objFactura['observaciones'] as $observacion)
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

<input type="hidden" id="idFactura" name="idFactura" value="{{ $objFactura['idFactura'] }}" />
<input type="hidden" id="borrarItem" name="borrarItem" value="" />

@include('shared.modals')

<script>

    // VARIABLES JS EXTERNAS
    var _token = "{{ csrf_token() }}";

    var urlNuevaFactura = '{{ url('/facturacion/nuevo') }}';
    var urlGuardarDatos = '{{ url('/facturacion/sesion/datos') }}';

    var urlListarFactura = '{{ url('/facturacion/lista') }}';
    var urlRegistrarFactura = '{{ url('/facturacion/nuevo/registrar') }}';

    var urlNotificacion = '{{ url('/facturacion/nuevo/notificacion') }}';
    var urlNotificacionBorrar = '{{ url('/facturacion/nuevo/borrar/notificacion') }}';

    var urlImporte = '{{ url('/facturacion/nuevo/importe') }}';
    var urlImporteBorrar = '{{ url('/facturacion/nuevo/borrar/importe') }}';

    var urlObservacion = '{{ url('/facturacion/nuevo/observacion') }}';
    var urlObservacionBorrar = '{{ url('/facturacion/nuevo/borrar/observacion') }}';

    var urlBuscarCliente = '{{ url('/facturacion/buscar/cliente') }}';
    var urlBuscarExpediente = '{{ url('/facturacion/buscar/expediente') }}';


    // ===================
    //  REGISTRAR FACTURA
    // ===================

    $("#btn-registrar-factura").click(function() {
        var cont = 0;

        if($('#idCliente').val()=="0"){
            cont = cont + 1;
        }

        if($('#idExpediente').val()=="0"){
            cont = cont + 1;
        }

        if($('#numeroComprobante').val()==""){
            cont = cont + 1;
        }

        if($('#concepto').val()==""){
            cont = cont + 1;
        }

        if($('#estado').val()==""){
            cont = cont + 1;
        }

        if($('#importeFacturacion').val()==""){
            cont = cont + 1;
        }

        if($('#fechaEmision').val()==""){
            cont = cont + 1;
        }

        if($('#fechaVencimiento').val()==""){
            cont = cont + 1;
        }

        if(cont>0){
            $('#modalFaltanDatos').foundation('open');
        } else {
            if(!$.isNumeric($('#importeFacturacion').val())){
                $('#modalFormatoDatos').foundation('open');
            } else {
                $('#modalRegistrarConfirmar').foundation('open');
            }
        }
    });

    $("#btn-registrar").click(function() {
        $('#modalRegistrarConfirmar').foundation('close');
        $('#modalRegistrarMensaje').foundation('open');

        var idFactura = $('#idFactura').val();

        var facturaData = {
            "_token": _token,
            "idFactura" : $('#idFactura').val(),
            "idCliente" : $('#idCliente').val(),
            "flgClienteTipoPersona" : $('#flgClienteTipoPersona').val(),
            "idExpediente" : $('#idExpediente').val(),
            "numeroComprobante" : $('#numeroComprobante').val(),
            "concepto" : $('#concepto').val(),
            "estado" : $('#estado').val(),
            "importeFacturacion" : $('#importeFacturacion').val(),
            "fechaEmision" : $('#fechaEmision').val(),
            "fechaVencimiento" : $('#fechaVencimiento').val(),
        };

        $.ajax({
            type: 'POST',
            data: facturaData,
            url: urlRegistrarFactura,
            success: function (data) {
                window.location=urlListarFactura;
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

    $("#btn-notificacion").click(function() {
        $('#modalContenidosMensaje').foundation('open');

        var idFactura = $('#idFactura').val();
        var _urlNotificacion = urlNotificacion+'/'+idFactura;

        var facturaData = {
            "_token": _token,
            "idFactura" : $('#idFactura').val(),
            "idCliente" : $('#idCliente').val(),
            "nombreCliente" : $('#nombreCliente').val(),
            "flgClienteTipoPersona" : $('#flgClienteTipoPersona').val(),
            "idExpediente" : $('#idExpediente').val(),
            "numeroComprobante" : $('#numeroComprobante').val(),
            "concepto" : $('#concepto').val(),
            "estado" : $('#estado').val(),
            "importeFacturacion" : $('#importeFacturacion').val(),
            "fechaEmision" : $('#fechaEmision').val(),
            "fechaVencimiento" : $('#fechaVencimiento').val(),
        };

        $.ajax({
            type: 'POST',
            data: facturaData,
            url: urlGuardarDatos,
            success: function (data) {
                window.location=_urlNotificacion;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalContenidosMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });
    });

    $("#btn-importe").click(function() {
        $('#modalContenidosMensaje').foundation('open');

        var idFactura = $('#idFactura').val();
        var _urlImporte = urlImporte+'/'+idFactura;

        var facturaData = {
            "_token": _token,
            "idFactura" : $('#idFactura').val(),
            "idCliente" : $('#idCliente').val(),
            "nombreCliente" : $('#nombreCliente').val(),
            "flgClienteTipoPersona" : $('#flgClienteTipoPersona').val(),
            "idExpediente" : $('#idExpediente').val(),
            "numeroComprobante" : $('#numeroComprobante').val(),
            "concepto" : $('#concepto').val(),
            "estado" : $('#estado').val(),
            "importeFacturacion" : $('#importeFacturacion').val(),
            "fechaEmision" : $('#fechaEmision').val(),
            "fechaVencimiento" : $('#fechaVencimiento').val(),
        };

        $.ajax({
            type: 'POST',
            data: facturaData,
            url: urlGuardarDatos,
            success: function (data) {
                window.location=_urlImporte;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalContenidosMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });
    });

    $("#btn-observacion").click(function() {
        $('#modalContenidosMensaje').foundation('open');

        var idFactura = $('#idFactura').val();
        var _urlObservacion = urlObservacion+'/'+idFactura;

        var facturaData = {
            "_token": _token,
            "idFactura" : $('#idFactura').val(),
            "idCliente" : $('#idCliente').val(),
            "nombreCliente" : $('#nombreCliente').val(),
            "flgClienteTipoPersona" : $('#flgClienteTipoPersona').val(),
            "idExpediente" : $('#idExpediente').val(),
            "numeroComprobante" : $('#numeroComprobante').val(),
            "concepto" : $('#concepto').val(),
            "estado" : $('#estado').val(),
            "importeFacturacion" : $('#importeFacturacion').val(),
            "fechaEmision" : $('#fechaEmision').val(),
            "fechaVencimiento" : $('#fechaVencimiento').val(),
        };

        $.ajax({
            type: 'POST',
            data: facturaData,
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

    $("#btn-buscar-cliente").click(function() {
        $('#modalContenidosMensaje').foundation('open');

        var idFactura = $('#idFactura').val();
        var _urlBuscarCliente = urlBuscarCliente;

        var facturaData = {
            "_token": _token,
            "idFactura" : $('#idFactura').val(),
            "idCliente" : $('#idCliente').val(),
            "nombreCliente" : $('#nombreCliente').val(),
            "flgClienteTipoPersona" : $('#flgClienteTipoPersona').val(),
            "idExpediente" : $('#idExpediente').val(),
            "numeroComprobante" : $('#numeroComprobante').val(),
            "concepto" : $('#concepto').val(),
            "estado" : $('#estado').val(),
            "importeFacturacion" : $('#importeFacturacion').val(),
            "fechaEmision" : $('#fechaEmision').val(),
            "fechaVencimiento" : $('#fechaVencimiento').val(),
        };

        $.ajax({
            type: 'POST',
            data: facturaData,
            url: urlGuardarDatos,
            success: function (data) {
                window.location=_urlBuscarCliente;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalContenidosMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });
    });


    $("#btn-buscar-expediente").click(function() {
        $('#modalContenidosMensaje').foundation('open');

        var idFactura = $('#idFactura').val();
        var _urlBuscarExpediente = urlBuscarExpediente;

        var facturaData = {
            "_token": _token,
            "idFactura" : $('#idFactura').val(),
            "idCliente" : $('#idCliente').val(),
            "nombreCliente" : $('#nombreCliente').val(),
            "flgClienteTipoPersona" : $('#flgClienteTipoPersona').val(),
            "idExpediente" : $('#idExpediente').val(),
            "numeroComprobante" : $('#numeroComprobante').val(),
            "concepto" : $('#concepto').val(),
            "estado" : $('#estado').val(),
            "importeFacturacion" : $('#importeFacturacion').val(),
            "fechaEmision" : $('#fechaEmision').val(),
            "fechaVencimiento" : $('#fechaVencimiento').val(),
        };

        $.ajax({
            type: 'POST',
            data: facturaData,
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
