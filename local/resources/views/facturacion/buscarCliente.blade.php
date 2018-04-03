@extends('layouts.app')

@section('content')

<div class="grid-container">
    <div class="site-title-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="table-2cells-div">
                    <div class="left-div">
                        <div class="site-title">
                            BUSCAR CLIENTE
                        </div>
                    </div>
                    <div class="right-div">
                        @if($objFactura['idFactura']=="0")
                            <a href="{{ url('/facturacion/nuevo',['idFactura' => $objFactura['idFactura']]) }}">
                        @else
                            <a href="{{ url('/facturacion/editar',['idFactura' => $objFactura['idFactura'],'flgInicio' => 'N']) }}">
                        @endif
                            <div id="btn-regresar" class="site-title-button site-title-button-padding float-right">
                                Regresar
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section-padding">
        <form id="frm_buscar_cliente" name="frm_buscar_cliente" action="{{ url('/facturacion/buscar/cliente') }}" method="get">
            <div class="grid-x">
                <div class="cell small-12">
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-12 large-4">
                            <div class="site-line">
                                <div class="site-label padding-bottom-5">
                                    Nombre / Razon Social
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
                                            Tipo Cliente
                                        </div>
                                    </div>
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <select class="site-select" id="tipoCliente" name="tipoCliente">
                                            @if($tipoCliente=="-")
                                                <option value="-" selected="selected">Seleccione una opción</option>
                                            @else
                                                <option value="-">Seleccione una opción</option>
                                            @endif
                                            @if($tipoCliente=="J")
                                                <option value="J" selected="selected">Persona Jurídica</option>
                                            @else
                                                <option value="J">Persona Jurídica</option>
                                            @endif
                                            @if($tipoCliente=="N")
                                                <option value="N" selected="selected">Persona Natural</option>
                                            @else
                                                <option value="N">Persona Natural</option>
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
            @foreach($lstClientes as $cliente)
                <div class="cell small-12">
                    @if($loop->iteration % 2 == 0)
                        <div class="list-div">
                    @else
                        <div class="list-div" style="background-color:#F5F5F5;">
                    @endif
                        <div class="list-text-2-div">
                            <div class="list-label-avant-garde-lite">
                                Nombre / Razón Social
                            </div>
                            <div class="list-biglabel-avant-garde-regular">
                                {{ $cliente['nombre'] }}
                            </div>
                        </div>
                        <div class="list-text-2-div">
                            <div class="list-label-avant-garde-lite">
                                Tipo
                            </div>
                            <div class="list-biglabel-avant-garde-regular">
                                {{ $cliente['tipo_persona_nombre'] }}
                            </div>
                        </div>
                        <div idCliente="{{ $cliente['id'] }}" tipoCliente="{{ $cliente['tipo_persona'] }}" nombreCliente="{{ $cliente['nombre'] }}" class="btn-seleccionar-cliente list-icon-div">
                            <img src="{{ asset('images/ico_pointer_blue.png') }}" />
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
                    {{ $lstClientes->appends(['razonSocial' => $razonSocial, 'tipoCliente' => $tipoCliente])->links('vendor.pagination.default') }}
                </div>
            </div>
        </div>
    </div>

</div>

<input type="hidden" id="idFactura" name="idFactura" value="{{ $objFactura['idFactura'] }}" />

@include('shared.modals')

<script>

    // VARIABLES JS EXTERNAS
    var _token = "{{ csrf_token() }}";
    var urlGuardarDatos = '{{ url('/facturacion/sesion/datos/cliente') }}';
    var urlNuevaFactura = '{{ url('/facturacion/nuevo') }}';
    var urlEditarFactura = '{{ url('/facturacion/editar') }}';


    $("#btn-buscar").click(function() {
        $("#frm_buscar_cliente").submit();
    });

    $(".btn-seleccionar-cliente").click(function() {
        $('#modalRegistrarMensaje').foundation('open');

        var idFactura = $('#idFactura').val();
        var idCliente = $(this).attr("idCliente");
        var tipoCliente = $(this).attr("tipoCliente");
        var nombreCliente = $(this).attr("nombreCliente");

        var _urlNuevaFactura = urlNuevaFactura+'/'+idFactura;
        var _urlEditarFactura = urlEditarFactura+'/'+idFactura+'/N';

        var facturaData = {
            "_token": _token,
            "idFactura" : $('#idFactura').val(),
            "idCliente" : idCliente,
            "nombreCliente" : nombreCliente,
            "flgClienteTipoPersona" : tipoCliente,
        };

        $.ajax({
            type: 'POST',
            data: facturaData,
            url: urlGuardarDatos,
            success: function (data) {
                if(idFactura=="0"){
                    window.location=_urlNuevaFactura;
                } else {
                    window.location=_urlEditarFactura;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalRegistrarMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });

    });

</script>


@endsection
