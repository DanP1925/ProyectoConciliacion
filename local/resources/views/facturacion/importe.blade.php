@extends('layouts.app')

@section('content')

<div class="grid-container">

    <div class="site-title-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="table-2cells-div">
                    <div class="left-div">
                        <div class="site-title">
                            IMPORTE PARCIAL
                        </div>
                    </div>
                    <div class="right-div">

                        @if($objFactura['idFactura']=="0")
                            <a href="{{ url('/facturacion/nuevo',['idFactura' => $objFactura['idFactura']]) }}">
                        @else
                            <a href="{{ url('/facturacion/editar',['idFactura' => $objFactura['idFactura'],'flgInicio' => 'N']) }}">
                        @endif
                            <div id="btn-regresar" class="site-title-button float-right">
                                Regresar
                            </div>
                        </a>
                        <div id="btn-registrar-importe" class="site-title-button site-title-button-padding float-right">
                            Registrar Importe
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section-padding">
        <div class="grid-x">
            @if($objFactura['idFactura']!=0)
                <div class="cell small-12">
                    <div class="grid-x grid-margin-x">
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
                                        {{ $objFactura['expediente'][0]['idExpediente'] }}
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
                                        {{ $objFactura['numero_comprobante'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cell small-12 large-4">
                        </div>
                    </div>
                </div>
            @endif
            <div class="cell small-12">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="site-label padding-bottom-5">
                                Importe Parcial
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" class="site-input" id="importeParcial" name="importeParcial" />
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
</div>

<input type="hidden" id="idFactura" name="idFactura" value="{{ $objFactura['idFactura'] }}" />

@include('shared.modals')

<script>

    // VARIABLES JS EXTERNAS
    var _token = "{{ csrf_token() }}";
    var urlGuardarDatos = '{{ url('/facturacion/sesion/datos/importe') }}';
    var urlNuevaFactura = '{{ url('/facturacion/nuevo') }}';
    var urlEditarFactura = '{{ url('/facturacion/editar') }}';

    $( "#btn-registrar-importe" ).click(function() {

        if($('#importeParcial').val()==""){
            $('#modalFaltanDatos').foundation('open');
        }
        else{
            if(!$.isNumeric($('#importeParcial').val())){
                $('#modalFormatoDatos').foundation('open');
            } else {
                $('#modalRegistrarMensaje').foundation('open');

                var idFactura = $('#idFactura').val();
                var _urlNuevaFactura = urlNuevaFactura+'/'+idFactura;
                var _urlEditarFactura = urlEditarFactura+'/'+idFactura+'/N';

                var facturaData = {
                    "_token": _token,
                    "idFactura" : $('#idFactura').val(),
                    "importeParcial" : $('#importeParcial').val(),
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
            }
        }


    });

</script>


@endsection
