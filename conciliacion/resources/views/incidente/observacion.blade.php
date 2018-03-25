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

<input type="hidden" id="idIncidente" name="idIncidente" value="{{ $objIncidente['idIncidente'] }}" />

@include('shared.modals')

<script>

    // VARIABLES JS EXTERNAS
    var _token = "{{ csrf_token() }}";
    var urlGuardarDatos = '{{ url('/incidente/sesion/datos/observacion') }}';
    var urlNuevoIncidente = '{{ url('/incidente/nuevo') }}';
    var urlEditarIncidente = '{{ url('/incidente/editar') }}';

    $( "#btn-registrar-observacion" ).click(function() {

        if($('#observacion').val()==""){
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
                "observacion" : $('#observacion').val(),
            };

            $.ajax({
                type: 'POST',
                data: incidenteData,
                url: urlGuardarDatos,
                success: function (data) {
                    if(idIncidente=="0"){
                        window.location=_urlNuevoIncidente;
                    } else {
                        window.location=_urlEditarIncidente;
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
