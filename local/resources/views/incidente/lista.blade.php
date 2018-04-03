@extends('layouts.app')

@section('content')

<div class="grid-container">

    <div class="site-title-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="table-2cells-div">
                    <div class="left-div">
                        <div class="site-title">
                            INCIDENTES
                        </div>
                    </div>
                    <div class="right-div">
                        <a href="{{ url('/incidente/nuevo',['idIncidente' => "-"]) }}">
                            <div class="site-title-button float-right">
                                Nuevo Incidente
                            </div>
                        </a>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section-padding">
        <form id="frm_buscar_incidente" name="frm_buscar_incidente" action="{{ url('/incidente/lista') }}" method="get">
            <div class="grid-x">
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
                                            Fecha Inicio Incidente
                                        </div>
                                    </div>
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <input type="date" class="site-input" id="fechaInicio" name="fechaInicio" value="{{ $fechaInicio }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cell small-12 large-4">
                            <div class="site-line">
                                <div class="site-label padding-bottom-5">
                                    <div class="left-div">
                                        <div class="site-label">
                                            Fecha Fin Incidente
                                        </div>
                                    </div>
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <input type="date" class="site-input" id="fechaFin" name="fechaFin" value="{{ $fechaFin }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-12 large-4">
                            <div class="site-line">
                                <div class="site-label padding-bottom-5">
                                    <div class="left-div">
                                        <div class="site-label">
                                            Secretario
                                        </div>
                                    </div>
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <input type="text" class="site-input" id="secretario" name="secretario" value="{{ $secretario }}" />
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
                                        <select class="site-select" id="tipoIncidente" name="tipoIncidente">
                                            <option value="">Seleccione una opción</option>
                                            @foreach($lstIncidenteTipo as $incidenteTipo)
                                                @if($incidenteTipo['idIncidenteTipo']==$tipoIncidente)
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
                                <div class="site-label padding-bottom-5">
                                    Estado
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <select class="site-select" id="estado" name="estado">
                                            <option value="">Seleccione una opción</option>
                                            @if($estado=="P")
                                                <option value="P" selected="selected">Pendiente</option>
                                            @else
                                                <option value="P">Pendiente</option>
                                            @endif
                                            @if($estado=="R")
                                                <option value="R" selected="selected">Resuelto</option>
                                            @else
                                                <option value="R">Resuelto</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
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
            @foreach($lstIncidentes as $incidente)
                <div class="cell small-12">
                    @if($loop->iteration % 2 == 0)
                        <div class="list-div">
                    @else
                        <div class="list-div" style="background-color:#F5F5F5;">
                    @endif
                        <div class="list-text-5-div">
                            <div class="list-line-div">
                                <div class="list-label-avant-garde-lite">
                                    Expediente
                                </div>
                                <div class="list-biglabel-avant-garde-regular">
                                    {{ $incidente['numeroExpediente'] }}
                                </div>
                                @if($incidente['estado']=="P")
                                    <div class="list-label-avant-garde-bold color-F5A623">
                                        PENDIENTE
                                    </div>
                                @endif

                                @if($incidente['estado']=="R")
                                    <div class="list-label-avant-garde-bold color-4A90E2">
                                        RESUELTO
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="list-text-5-div">
                            <div class="list-line-div">
                                <div class="list-label-avant-garde-lite">
                                    Fecha
                                </div>
                                <div class="list-biglabel-avant-garde-regular">
                                    {{ $incidente['fecha'] }}
                                </div>
                            </div>
                        </div>
                        <div class="list-text-3-div">
                            <div class="list-line-div">
                                <div class="list-label-avant-garde-lite">
                                    Secretario
                                </div>
                                <div class="list-biglabel-avant-garde-regular">
                                    {{ $incidente['secretario'] }}
                                </div>
                            </div>
                        </div>
                        <div class="list-text-4-div">
                            <div class="list-line-div">
                                <div class="list-label-avant-garde-lite">
                                    Tipo Incidente
                                </div>
                                <div class="list-biglabel-avant-garde-regular">
                                    {{ $incidente['tipo'] }}
                                </div>
                            </div>
                        </div>
                        <div idSeleccionar="{{ $incidente['id'] }}" class="btn-seleccionar-incidente list-icon-div">
                            <img src="{{ asset('images/ico_pointer_blue.png') }}" />
                        </div>
                        <div idBorrar="{{ $incidente['id'] }}" class="btn-borrar-incidente list-icon-div">
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
                    {{ $lstIncidentes->appends(['numeroExpediente' => $numeroExpediente, 'fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin, 'secretario' => $secretario, 'tipoIncidente' => $tipoIncidente, 'estado' => $estado])->links('vendor.pagination.default') }}
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

    var urlListarIncidente = '{{ url('/incidente/lista') }}';
    var urlIncidenteEditar = '{{ url('/incidente/editar') }}';
    var urlIncidenteBorrar = '{{ url('/incidente/borrar') }}';

    $("#btn-buscar").click(function() {
        $("#frm_buscar_incidente").submit();
    });

    // =====================
    //  DETALLE DESIGNACION
    // =====================

    $(".btn-seleccionar-incidente").click(function() {
        $('#modalContenidosMensaje').foundation('open');

        var idSeleccionar = $(this).attr("idSeleccionar");
        var _urlIncidenteEditar = urlIncidenteEditar+'/'+idSeleccionar+'/S';

        window.location=_urlIncidenteEditar;

    });

    // =======
    // BORRAR
    // =======

    $(".btn-borrar-incidente").click(function() {
        var idBorrar = $(this).attr("idBorrar");
        $("#borrarItem").val(idBorrar);
        $('#modalBorrarConfirmar01').foundation('open');
    });

    $("#btn-borrar-01").click(function() {
        $('#modalBorrarConfirmar01').foundation('close');
        $('#modalBorrarMensaje').foundation('open');

        var idBorrar = $("#borrarItem").val();
        var _urlIncidenteBorrar = urlIncidenteBorrar+'/'+idBorrar;

        $.ajax({
            type: 'GET',
            url: _urlIncidenteBorrar,
            success: function (data) {
                window.location=urlListarIncidente;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalBorrarMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });

    });

</script>

@endsection
