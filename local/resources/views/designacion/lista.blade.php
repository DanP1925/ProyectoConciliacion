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

    <div class="site-section-padding">
        <div class="grid-x">
            @foreach($lstDesignaciones as $designacion)
                <div class="cell small-12">
                    @if($loop->iteration % 2 == 0)
                        <div class="list-div">
                    @else
                        <div class="list-div" style="background-color:#F5F5F5;">
                    @endif
                            <div class="list-text-4-div">
                                <div class="list-label-avant-garde-lite">
                                    Número Expediente
                                </div>
                                <div class="list-biglabel-avant-garde-regular">
                                    {{ $designacion['expediente_numero'] }}
                                </div>
                                <div class="list-sublabel-avant-garde-regular">
                                    Propuesta: <strong>{{ $designacion['fecha_designacion'] }}</strong>
                                </div>
                            </div>
                            <div class="list-text-4-div">
                                <div class="list-label-avant-garde-lite">
                                    Tipo Designación
                                </div>
                                <div class="list-biglabel-avant-garde-regular">
                                    {{ $designacion['tipoDesignacion'] }}
                                </div>
                            </div>
                            <div class="list-text-4-div">
                                <div class="list-label-avant-garde-lite">
                                    Demandante
                                </div>
                                <div class="list-biglabel-avant-garde-regular">
                                    {{ $designacion['demandante'] }}
                                </div>
                            </div>
                            <div class="list-text-4-div">
                                <div class="list-label-avant-garde-lite">
                                    Demandado
                                </div>
                                <div class="list-biglabel-avant-garde-regular">
                                    {{ $designacion['demandado'] }}
                                </div>
                            </div>
                            <div idSeleccionar="{{ $designacion['id'] }}" class="btn-seleccionar-designacion list-icon-div">
                                <img src="{{ asset('images/ico_pointer_blue.png') }}" />
                            </div>
                            <div idBorrar="{{ $designacion['id'] }}" class="btn-borrar-designacion list-icon-div">
                                <img src="{{ asset('images/ico_delete_red.png') }}" />
                            </div>
                        </div>
                </div>
            @endforeach
        </div>
        <div class="site-section-padding">
            <div class="grid-x">
                <div class="small-12 cell">
                    <div class="div-pagination">
                        {{ $lstDesignaciones->appends(['numeroExpediente' => $numeroExpediente,'fechaInicio' => $fechaInicio,'fechaFin' => $fechaFin,'tipoDesignacion' => $tipo])->links('vendor.pagination.default') }}
                    </div>
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

    var urlDesignacionListar = '{{ url('/designacion/lista') }}';
    var urlDesignacionEditar = '{{ url('/designacion/editar') }}';
    var urlDesignacionBorrar = '{{ url('/designacion/borrar') }}';

    $("#btn-buscar").click(function() {
        $("#frm_buscar_incidente").submit();
    });

    // =====================
    //  DETALLE DESIGNACION
    // =====================

    $(".btn-seleccionar-designacion").click(function() {
        $('#modalContenidosMensaje').foundation('open');

        var idSeleccionar = $(this).attr("idSeleccionar");
        var _urlDesignacionEditar = urlDesignacionEditar+'/'+idSeleccionar+'/S';

        window.location=_urlDesignacionEditar;

    });

    // =======
    // BORRAR
    // =======

    $(".btn-borrar-designacion").click(function() {
        var idBorrar = $(this).attr("idBorrar");
        $("#borrarItem").val(idBorrar);
        $('#modalBorrarConfirmar01').foundation('open');
    });

    $("#btn-borrar-01").click(function() {
        $('#modalBorrarConfirmar01').foundation('close');
        $('#modalBorrarMensaje').foundation('open');

        var idBorrar = $("#borrarItem").val();
        var _urlDesignacionBorrar = urlDesignacionBorrar+'/'+idBorrar;

        $.ajax({
            type: 'GET',
            url: _urlDesignacionBorrar,
            success: function (data) {
                window.location=urlDesignacionListar;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalBorrarMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });

    });

</script>

@endsection
