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
                        @if($objIncidente['idIncidente']=="0")
                            <a href="{{ url('/incidente/nuevo',['idIncidente' => $objIncidente['idIncidente']]) }}">
                        @else
                            <a href="{{ url('/incidente/editar',['idIncidente' => $objIncidente['idIncidente'],'flgInicio' => 'N']) }}">
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
        <form id="frm_buscar_personal" name="frm_buscar_personal" action="{{ url('/incidente/buscar/personal',['tipoPersonal' => $tipoPersonal]) }}" method="get">
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
                                    País
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <select class="site-select" id="pais" name="pais">
                                            <option value="">Seleccione una opción</option>
                                            @foreach($lstPais as $paisPersonal)
                                                @if($pais==$paisPersonal['id'])
                                                    <option value="{{ $paisPersonal['id'] }}" selected="selected">{{ $paisPersonal['nombre'] }}</option>
                                                @else
                                                    <option value="{{ $paisPersonal['id'] }}">{{ $paisPersonal['nombre'] }}</option>
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
                        </div>
                        <div class="list-text-3-div">
                            <div class="list-label-avant-garde-lite">
                                Profesión
                            </div>
                            <div class="list-biglabel-avant-garde-regular">
                                {{ $personal['profesion'] }}
                            </div>
                        </div>
                        <div class="list-text-3-div">
                            <div class="list-label-avant-garde-lite">
                                País
                            </div>
                            <div class="list-biglabel-avant-garde-regular">
                                {{ $personal['pais'] }}
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
                    {{ $lstPersonal->appends(['nombre' => $nombre, 'apellidoPaterno' => $apellidoPaterno, 'apellidoMaterno' => $apellidoMaterno, 'profesion' => $profesion, 'pais' => $pais])->links('vendor.pagination.default') }}
                </div>
            </div>
        </div>
    </div>

</div>

<input type="hidden" id="idIncidente" name="idIncidente" value="{{ $objIncidente['idIncidente'] }}" />
<input type="hidden" id="tipoPersonal" name="tipoPersonal" value="{{ $tipoPersonal }}" />

@include('shared.modals')

<script>

    // VARIABLES JS EXTERNAS
    var _token = "{{ csrf_token() }}";
    var urlGuardarDatos = '{{ url('/incidente/sesion/datos/personal') }}';
    var urlNuevoIncidente = '{{ url('/incidente/nuevo') }}';
    var urlEditarIncidente = '{{ url('/incidente/editar') }}';


    $("#btn-buscar").click(function() {
        $("#frm_buscar_personal").submit();
    });

    $(".btn-seleccionar-personal").click(function() {
        $('#modalRegistrarMensaje').foundation('open');

        var idIncidente = $('#idIncidente').val();
        var idPersonal = $(this).attr("idPersonal");
        var nombrePersonal = $(this).attr("nombrePersonal");
        var tipoPersonal = $('#tipoPersonal').val();

        var _urlNuevoIncidente = urlNuevoIncidente+'/'+idIncidente;
        var _urlEditarIncidente = urlEditarIncidente+'/'+idIncidente+'/N';

        var incidenteData = {
            "_token": _token,
            "idIncidente" : $('#idIncidente').val(),
            "idPersonal" : idPersonal,
            "nombrePersonal" : nombrePersonal,
            "tipoPersonal" : tipoPersonal,
        };

        $.ajax({
            type: 'POST',
            data: incidenteData,
            url: urlGuardarDatos,
            success: function (data) {
                if(data=="false"){
                    $('#modalIncidenteExistePersonal').foundation('open');
                } else {
                    if(idIncidente=="0"){
                        window.location=_urlNuevoIncidente;
                    } else {
                        window.location=_urlEditarIncidente;
                    }
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
