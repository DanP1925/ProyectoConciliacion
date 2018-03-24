@extends('layouts.app')

@section('content')

<div class="grid-container">

    <div class="site-title-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="table-2cells-div">
                    <div class="left-div">
                        <div class="site-title">
                            BUSCAR EXPEDIENTE
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
        <form id="frm_buscar_expediente" name="frm_buscar_expediente" action="{{ url('/facturacion/buscar/expediente') }}" method="get">
            <div class="grid-x">
                <div class="cell small-12">
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-12 large-4">
                            <div class="site-line">
                                <div class="site-label padding-bottom-5">
                                    Número Expediente
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <input type="text" class="site-input" id="numeroExpediente" name="numeroExpediente" value="{{ $numeroExpediente }}" />
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
            @foreach($lstExpedientes as $expediente)
                <div class="cell small-12">
                    <div class="list-div" style="background-color:#F5F5F5;">
                        <div class="list-text-3-div">
                            <div class="list-label-avant-garde-lite">
                                Número Expediente
                            </div>
                            <div class="list-biglabel-avant-garde-regular">
                                {{ $expediente['numero'] }}
                            </div>
                        </div>
                        <div class="list-text-3-div">
                            <div class="list-label-avant-garde-lite">
                                Demandante
                            </div>
                            <div class="list-biglabel-avant-garde-regular">
                                {{ $expediente['demandante'] }}
                            </div>
                        </div>
                        <div class="list-text-3-div">
                            <div class="list-label-avant-garde-lite">
                                Demandado
                            </div>
                            <div class="list-biglabel-avant-garde-regular">
                                {{ $expediente['demandado'] }}
                            </div>
                        </div>
                        <div idExpediente="{{ $expediente['id'] }}" numeroExpediente="{{ $expediente['numero'] }}" class="btn-seleccionar-expediente list-icon-div">
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
                    {{ $lstExpedientes->appends(['numeroExpediente' => $numeroExpediente])->links('vendor.pagination.default') }}
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
    var urlGuardarDatos = '{{ url('/facturacion/sesion/datos/expediente') }}';
    var urlNuevaFactura = '{{ url('/facturacion/nuevo') }}';
    var urlEditarFactura = '{{ url('/facturacion/editar') }}';


    $("#btn-buscar").click(function() {
        $("#frm_buscar_expediente").submit();
    });

    $(".btn-seleccionar-expediente").click(function() {
        $('#modalRegistrarMensaje').foundation('open');

        var idFactura = $('#idFactura').val();
        var idExpediente = $(this).attr("idExpediente");
        var numeroExpediente = $(this).attr("numeroExpediente");

        var _urlNuevaFactura = urlNuevaFactura+'/'+idFactura;
        var _urlEditarFactura = urlEditarFactura+'/'+idFactura+'/N';

        var facturaData = {
            "_token": _token,
            "idFactura" : $('#idFactura').val(),
            "idExpediente" : idExpediente,
            "numeroExpediente" : numeroExpediente,
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
