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
                        <a href="{{ url('/designacion/nuevo',['idDesignacion' => 0]) }}">
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
        <form id="frm_buscar_expediente" name="frm_buscar_expediente" action="{{ url('/designacion/buscar/expediente') }}" method="get">
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
                    @if($loop->iteration % 2 == 0)
                        <div class="list-div">
                    @else
                        <div class="list-div" style="background-color:#F5F5F5;">
                    @endif
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

<input type="hidden" id="idDesignacion" name="idDesignacion" value="{{ $objDesignacion['idDesignacion'] }}" />

@include('shared.modals')

<script>

    // VARIABLES JS EXTERNAS
    var _token = "{{ csrf_token() }}";
    var urlGuardarDatos = '{{ url('/designacion/sesion/datos/expediente') }}';
    var urlNuevaDesignacion = '{{ url('/designacion/nuevo') }}';

    $("#btn-buscar").click(function() {
        $("#frm_buscar_expediente").submit();
    });

    $(".btn-seleccionar-expediente").click(function() {
        $('#modalRegistrarMensaje').foundation('open');

        var idDesignacion = $('#idDesignacion').val();
        var idExpediente = $(this).attr("idExpediente");
        var numeroExpediente = $(this).attr("numeroExpediente");

        var _urlNuevaDesignacion = urlNuevaDesignacion+'/'+idDesignacion;

        var designacionData = {
            "_token": _token,
            "idDesignacion" : $('#idDesignacion').val(),
            "idExpediente" : idExpediente,
            "numeroExpediente" : numeroExpediente,
        };

        $.ajax({
            type: 'POST',
            data: designacionData,
            url: urlGuardarDatos,
            success: function (data) {
                window.location=_urlNuevaDesignacion;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalRegistrarMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });

    });

</script>


@endsection
