@extends('layouts.app')

@section('content')

<div class="grid-container">

    <div class="site-title-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="table-2cells-div">
                    <div class="left-div">
                        <div class="site-title">
                            BUSCAR PERSONAL
                        </div>
                    </div>
                    <div class="right-div">
                        @if($objDesignacion['idDesignacion']=="0")
                            <a href="{{ url('/designacion/nuevo/propuesta',['idDesignacion' => $objDesignacion['idDesignacion']]) }}">
                        @else
                            <a href="{{ url('/designacion/editar',['idDesignacion' => $objDesignacion['idDesignacion'],'flgInicio' => 'N']) }}">
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
        <form id="frm_buscar_personal" name="frm_buscar_personal" action="{{ url('/designacion/buscar/personal') }}" method="get">
            <div class="grid-x">
                <div class="cell small-12">
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-12 large-4">
                            <div class="site-line">
                                <div class="site-label padding-bottom-5">
                                    Nombre
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <input type="text" class="site-input" id="nombre" name="nombre" value="{{ $nombre }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cell small-12 large-4">
                            <div class="site-line">
                                <div class="site-label padding-bottom-5">
                                    Apellido Paterno
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <input type="text" class="site-input" id="apellidoPaterno" name="apellidoPaterno" value="{{ $apellidoPaterno }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cell small-12 large-4">
                            <div class="site-label padding-bottom-5">
                                Apellido Materno
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" class="site-input" id="apellidoMaterno" name="apellidoMaterno" value="{{ $apellidoMaterno }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid-x">
                <div class="cell small-12">
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-12 large-4">
                            <div class="site-line">
                                <div class="site-label padding-bottom-5">
                                    Profesión
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <select class="site-select" id="profesion" name="profesion">
                                            <option value="">Seleccione una opción</option>
                                            @foreach($lstProfesion as $profesionPersonal)
                                                @if($profesion==$profesionPersonal['id'])
                                                    <option value="{{ $profesionPersonal['id'] }}" selected="selected">{{ $profesionPersonal['nombre'] }}</option>
                                                @else
                                                    <option value="{{ $profesionPersonal['id'] }}">{{ $profesionPersonal['nombre'] }}</option>
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
                                    Especialidad
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <select class="site-select" id="especialidad" name="especialidad">
                                            <option value="">Seleccione una opción</option>
                                            @foreach($lstEspecialidad as $especialidadPersonal)
                                                @if($especialidad==$especialidadPersonal['id'])
                                                    <option value="{{ $especialidadPersonal['id'] }}" selected="selected">{{ $especialidadPersonal['nombre'] }}</option>
                                                @else
                                                    <option value="{{ $especialidadPersonal['id'] }}">{{ $especialidadPersonal['nombre'] }}</option>
                                                @endif
                                            @endforeach
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
            @foreach($lstPersonal as $personal)
                <div class="cell small-12">
                    @if($loop->iteration % 2 == 0)
                        <div class="list-div">
                    @else
                        <div class="list-div" style="background-color:#F5F5F5;">
                    @endif
                        <div class="list-text-3-div">
                            <div class="list-label-avant-garde-lite">
                                Nombre
                            </div>
                            <div class="list-biglabel-avant-garde-regular">
                                {{ $personal['nombre'] }}
                            </div>
                            <div class="list-biglabel-avant-garde-regular color-F5A623">
                                <strong>{{ $personal['profesion'] }}</strong>
                            </div>
                        </div>
                        <div class="list-text-3-div">
                            <div class="list-label-avant-garde-lite">
                                Especialidad
                            </div>
                            <div class="list-biglabel-avant-garde-regular">
                                @if(count($personal['especialidades'])>0)
                                    @foreach($personal['especialidades'] as $especialidad)
                                        {{ $especialidad['nombre'] }}
                                    @endforeach
                                @else
                                    No presenta especialidades registradas
                                @endif
                            </div>
                        </div>
                        <div class="list-text-5-div">
                            <div class="list-label-avant-garde-lite">
                                Por la corte
                            </div>
                            <div class="list-biglabel-avant-garde-regular">
                                {{ $personal['porLaCorte'] }}
                            </div>
                        </div>
                        <div class="list-text-5-div">
                            <div class="list-label-avant-garde-lite">
                                Por las partes
                            </div>
                            <div class="list-biglabel-avant-garde-regular">
                                {{ $personal['porLaParte'] }}
                            </div>
                        </div>
                        <div idPersonal="{{ $personal['id'] }}" nombrePersonal="{{ $personal['nombre'] }}" class="btn-seleccionar-personal list-icon-div">
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
                    {{ $lstPersonal->appends(['nombre' => $nombre, 'apellidoPaterno' => $apellidoPaterno, 'apellidoMaterno' => $apellidoMaterno, 'profesion' => $profesion, 'especialidad' => $especialidad])->links('vendor.pagination.default') }}
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
    var urlGuardarDatos = '{{ url('/designacion/sesion/datos/personal') }}';
    var urlHistoricoPersonal = '{{ url('/designacion/buscar/personal/historico') }}';

    $("#btn-buscar").click(function() {
        $("#frm_buscar_personal").submit();
    });

    $(".btn-seleccionar-personal").click(function() {
        $('#modalContenidosMensaje').foundation('open');

        var idDesignacion = $('#idDesignacion').val();
        var idPersonal = $(this).attr("idPersonal");
        var _urlHistoricoPersonal = urlHistoricoPersonal+'/'+idPersonal;

        window.location=_urlHistoricoPersonal;

    });

</script>


@endsection
