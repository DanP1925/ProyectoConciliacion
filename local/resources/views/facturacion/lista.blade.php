@extends('layouts.app')

@section('content')

<div class="grid-container">

    <div class="site-title-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="table-2cells-div">
                    <div class="left-div">
                        <div class="site-title">
                            FACTURAS
                        </div>
                    </div>
                    <div class="right-div">
                        <a href="{{ url('/facturacion/nuevo',['idFactura' => "-"]) }}">
                            <div class="site-title-button float-right">
                                Nueva Factura
                            </div>
                        </a>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section-padding">
        <form id="frm_buscar_factura" name="frm_buscar_factura" action="{{ url('/facturacion/lista') }}" method="get">
            <div class="grid-x">
                <div class="cell small-12">
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-12 large-4">
                            <div class="site-line">
                                <div class="site-label padding-bottom-5">
                                    Nombre / Razon Social Cliente
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <input type="text" class="site-input" id="razonSocial" name="razonSocial" value="{{ $razonSocial }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cell small-12 large-4">
                            <div class="site-line">
                                <div class="site-label padding-bottom-5">
                                    <div class="left-div">
                                        <div class="site-label">
                                            Número Expediente
                                        </div>
                                    </div>
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <input type="text" class="site-input" id="numeroExpediente" name="numeroExpediente" value="{{ $numeroExpediente }}" />
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
                                        <input type="text" class="site-input" id="numeroComprobante" name="numeroComprobante" value="{{ $numeroComprobante }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-12 large-4">
                            <div class="site-line">
                                <div class="site-label padding-bottom-5">
                                    Concepto
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <select class="site-select" id="concepto" name="concepto">
                                            <option value="-">Seleccione una opción</option>
                                            @foreach($lstFacturaConcepto as $facturaConcepto)
                                                @if($facturaConcepto['idFacturaConcepto']==$concepto)
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
                                            <option value="-">Seleccione una opción</option>
                                            @foreach($lstFacturaEstado as $facturaEstado)
                                                @if($facturaEstado['idFacturaEstado']==$estado)
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
                                            Fecha Emisión
                                        </div>
                                    </div>
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <input type="date" class="site-input" id="fechaEmision" name="fechaEmision" value="{{ $fechaEmision }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-12 large-4">
                            <div class="site-line">
                                <div class="site-label padding-bottom-5">
                                    Fecha Vencimiento
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <input type="date" class="site-input" id="fechaVencimiento" name="fechaVencimiento" value="{{ $fechaVencimiento }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cell small-12 large-4">
                        </div>
                        <div class="cell small-12 large-4">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="grid-x">
            <div class="cell small-12">
                <div id="btn-buscar" class="site-form-button float-left">
                    buscar
                </div>
                <div style="clear:both;"></div>
            </div>
        </div>
    </div>
    <div class="site-section-padding">
        <div class="grid-x">
            @foreach($lstFacturas as $factura)
                <div class="cell small-12">
                    @if($loop->iteration % 2 == 0)
                        <div class="list-div">
                    @else
                        <div class="list-div" style="background-color:#F5F5F5;">
                    @endif
                        <div class="list-text-3-div">
                            <div class="list-label-avant-garde-lite">
                                Cliente
                            </div>
                            <div class="list-biglabel-avant-garde-regular">
                                {{ $factura['nombreCliente'] }}
                            </div>
                            <div class="list-sublabel-avant-garde-regular">
                                Emisión: <strong>{{ $factura['fechaEmision'] }}</strong>
                            </div>
                        </div>
                        <div class="list-text-4-div">
                            <div class="list-line-div">
                                <div class="list-sublabel-avant-garde-lite">
                                    Expediente
                                </div>
                                <div class="list-sublabel-avant-garde-regular">
                                    {{ $factura['numeroExpediente'] }}
                                </div>
                            </div>
                            <div class="list-sublabel-avant-garde-lite">
                                Comprobante
                            </div>
                            <div class="list-sublabel-avant-garde-bold color-F5A623">
                                {{ $factura['numeroComprobante'] }}
                            </div>
                        </div>
                        <div class="list-text-4-div">
                            <div class="list-line-div">
                                <div class="list-sublabel-avant-garde-lite">
                                    Concepto
                                </div>
                                <div class="list-sublabel-avant-garde-regular">
                                    {{ $factura['facturaConcepto'] }}
                                </div>
                            </div>
                            <div class="list-sublabel-avant-garde-lite">
                                Estado
                            </div>
                            <div class="list-sublabel-avant-garde-regular">
                                {{ $factura['facturaEstado'] }}
                            </div>
                        </div>
                        <div class="list-text-2-div">
                            <div class="list-line-div">
                                <div class="list-sublabel-avant-garde-lite">
                                    Num.Notificaciones
                                </div>
                                <div class="list-sublabel-avant-garde-regular">
                                    {{ $factura['numNotificaciones'] }}
                                </div>
                            </div>
                            <div class="list-sublabel-avant-garde-lite">
                                Vencimiento
                            </div>
                            <div class="list-sublabel-avant-garde-regular">
                                {{ $factura['fechaVencimiento'] }}
                            </div>
                        </div>
                        <div idSeleccionar="{{ $factura['id'] }}" class="btn-seleccionar-factura list-icon-div">
                            <img src="{{ asset('images/ico_pointer_blue.png') }}" />
                        </div>
                        <div idBorrar="{{ $factura['id'] }}" class="btn-borrar-factura list-icon-div">
                            <img src="{{ asset('images/ico_delete_red.png') }}" />
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="site-section-padding">
        <div class="grid-x">
            <div class="small-12 cell">
                <div class="div-pagination">
                    {{ $lstFacturas->appends(['razonSocial' => $razonSocial,'numeroExpediente' => $numeroExpediente,'numeroComprobante' => $numeroComprobante,'concepto' => $concepto,'estado' => $estado,'fechaEmision' => $fechaEmision,'fechaVencimiento' => $fechaVencimiento])->links('vendor.pagination.default') }}
                </div>
            </div>
        </div>
    </div>

</div>

<input type="hidden" id="borrarItem" name="borrarItem" value="" />

@include('shared.modals')

<script>
    // VARIABLES JS EXTERNAS
    var _token = "{{ csrf_token() }}";

    var urlListarFactura = '{{ url('/facturacion/lista') }}';
    var urlFacturaEditar = '{{ url('/facturacion/editar') }}';
    var urlFacturaBorrar = '{{ url('/facturacion/borrar') }}';


    $("#btn-buscar").click(function() {
        $("#frm_buscar_factura").submit();
    });


    // =====================
    //  DETALLE FACTURACION
    // =====================

    $(".btn-seleccionar-factura").click(function() {
        $('#modalContenidosMensaje').foundation('open');

        var idSeleccionar = $(this).attr("idSeleccionar");
        var _urlFacturaEditar = urlFacturaEditar+'/'+idSeleccionar+'/S';

        window.location=_urlFacturaEditar;

    });


    // =======
    // BORRAR
    // =======

    $(".btn-borrar-factura").click(function() {
        var idBorrar = $(this).attr("idBorrar");
        $("#borrarItem").val(idBorrar);
        $('#modalBorrarConfirmar01').foundation('open');
    });

    $("#btn-borrar-01").click(function() {
        $('#modalBorrarConfirmar01').foundation('close');
        $('#modalBorrarMensaje').foundation('open');

        var idBorrar = $("#borrarItem").val();
        var _urlFacturaBorrar = urlFacturaBorrar+'/'+idBorrar;

        $.ajax({
            type: 'GET',
            url: _urlFacturaBorrar,
            success: function (data) {
                window.location=urlListarFactura;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalBorrarMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });

    });

</script>

@endsection
