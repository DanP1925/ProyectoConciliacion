@extends('layouts.app')

@section('content')

<div class="grid-container">

    <div class="site-title-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="table-2cells-div">
                    <div class="left-div">
                        <div class="site-title">
                            FECHA NOTIFICACIÓN
                        </div>
                    </div>
                    <div class="right-div">
                        <div id="btn-registrar-fecha" class="site-title-button float-right">
                            Registrar Fecha
                        </div>
                        @if($objIncidente['idIncidente']=="0")
                            <a href="{{ url('/incidente/nuevo',['idIncidente' => $objIncidente['idIncidente']]) }}">
                        @else
                            <a href="{{ url('/incidente/editar',['idIncidente' => $objIncidente['idIncidente'],'flgInicio' => 'N']) }}">
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
            @if($objIncidente['expediente'][0]['numero']!="")
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
                                        {{ $objIncidente['expediente'][0]['numero'] }}
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
                                Nombre Fecha Incidente
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <select class="site-select" id="idIncidenteFecha" name="idIncidenteFecha">
                                        <option value="">Seleccione una opción</option>
                                        @foreach($lstIncidenteFecha as $incidenteFecha)
                                            <option value="{{ $incidenteFecha['idIncidenteFecha'] }}">{{ $incidenteFecha['orden'] }}. {{ $incidenteFecha['nombre'] }}</option>
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
            <div class="cell small-12">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="site-label padding-bottom-5">
                                Fecha Incidente
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="date" class="site-input" id="fecha" name="fecha" />
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

<input type="hidden" id="idIncidente" name="idIncidente" value="{{ $objIncidente['idIncidente'] }}" />

@include('shared.modals')

<script>

    // VARIABLES JS EXTERNAS
    var _token = "{{ csrf_token() }}";
    var urlGuardarDatos = '{{ url('/incidente/sesion/datos/fecha') }}';
    var urlNuevoIncidente = '{{ url('/incidente/nuevo') }}';
    var urlEditarIncidente = '{{ url('/incidente/editar') }}';

    $( "#btn-registrar-fecha" ).click(function() {

        if($('#idIncidenteFecha').val()==""){
            $('#modalFaltanDatos').foundation('open');
        } else {
            if($('#fecha').val()==""){
                $('#modalFaltanDatos').foundation('open');
            }
            else{
                $('#modalRegistrarMensaje').foundation('open');
                var idIncidente = $('#idIncidente').val();
                var _urlNuevoIncidente = urlNuevoIncidente+'/'+idIncidente;
                var _urlEditarIncidente = urlEditarIncidente+'/'+idIncidente+'/N';

                var incidenteData = {
                    "_token": _token,
                    "idIncidente" : $('#idIncidente').val(),
                    "idIncidenteFecha" : $('#idIncidenteFecha').val(),
                    "fecha" : $('#fecha').val(),
                };

                $.ajax({
                    type: 'POST',
                    data: incidenteData,
                    url: urlGuardarDatos,
                    success: function (data) {
                        if(data=="false"){
                            $('#modalIncidenteExisteFecha').foundation('open');
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
            }
        }
    });

</script>


@endsection
