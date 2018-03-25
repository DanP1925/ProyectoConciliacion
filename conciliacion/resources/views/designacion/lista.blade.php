@extends('layouts.app')

@section('content')

<div class="grid-container">

    <div class="site-title-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="table-2cells-div">
                    <div class="left-div">
                        <div class="site-title">
                            DESIGNACIONES
                        </div>
                    </div>
                    <div class="right-div">
                        <a href="{{ url('/designacion/nuevo',['idDesignacion' => "-"]) }}">
                            <div class="site-title-button float-right">
                                Nueva Designacion
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
                                    Tipo Designación
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <select class="site-select" id="tipoDesignacion" name="tipoDesignacion">
                                            <option value="">Seleccione una opción</option>
                                            @foreach($lstTipoDesignacion as $tipoDesignacion)
                                                @if($tipoDesignacion['id']==$tipo)
                                                    <option value="{{ $tipoDesignacion['id'] }}" selected="selected">{{ $tipoDesignacion['nombre'] }}</option>
                                                @else
                                                    <option value="{{ $tipoDesignacion['id'] }}">{{ $tipoDesignacion['nombre'] }}</option>
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
                                            Fecha Inicio consulta
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
                    </div>
                    <div class="grid-x grid-margin-x">
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


</div>

<input type="hidden" id="borrarItem" name="borrarItem" value="" />

@include('shared.modals')

<script>

    // VARIABLES JS EXTERNAS
    var _token = "{{ csrf_token() }}";

    var urlListarIncidente = '{{ url('/incidente/lista') }}';
    var urlIncidenteBorrar = '{{ url('/incidente/borrar') }}';

    $("#btn-buscar").click(function() {
        $("#frm_buscar_incidente").submit();
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
