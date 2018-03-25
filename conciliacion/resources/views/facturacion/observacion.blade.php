@extends('layouts.app')

@section('content')

<div class="grid-container">

    <div class="site-title-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="table-2cells-div">
                    <div class="left-div">
                        <div class="site-title">
                            OBSERVACIÓN
                        </div>
                    </div>
                    <div class="right-div">
                        <div id="btn-registrar-observacion" class="site-title-button float-right">
                            Registrar Observación
                        </div>
                        @if($objFactura['idFactura']=="0")
                            <a href="{{ url('/facturacion/nuevo',['idFactura' => $objFactura['idFactura']]) }}">
                        @else
                            <a href="{{ url('/facturacion/editar',['idFactura' => $objFactura['idFactura'],'flgInicio' => 'N']) }}">
                        @endif
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
                    <div class="cell small-12 large-8">
                        <div class="site-line">
                            <div class="site-label padding-bottom-5">
                                Observacion
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <textarea type="text" class="site-input" id="observacion" name="observacion"></textarea>
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
    var urlGuardarDatos = '{{ url('/facturacion/sesion/datos/observacion') }}';
    var urlNuevaFactura = '{{ url('/facturacion/nuevo') }}';
    var urlEditarFactura = '{{ url('/facturacion/editar') }}';

    $( "#btn-registrar-observacion" ).click(function() {

        if($('#observacion').val()==""){
            $('#modalFaltanDatos').foundation('open');
        }
        else{
            $('#modalRegistrarMensaje').foundation('open');

            var idFactura = $('#idFactura').val();
            var _urlNuevaFactura = urlNuevaFactura+'/'+idFactura;
            var _urlEditarFactura = urlEditarFactura+'/'+idFactura+'/N';

            var facturaData = {
                "_token": _token,
                "idFactura" : $('#idFactura').val(),
                "observacion" : $('#observacion').val(),
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


    });

</script>


@endsection
