@extends('layouts.app')

@section('content')

<div class="grid-container">

    <div class="site-title-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="table-2cells-div">
                    <div class="left-div">
                        <div class="site-title">
                            NUEVA PROPUESTA
                        </div>
                    </div>
                    <div class="right-div">
                        <a href="{{ url('/designacion/lista') }}">
                            <div id="btn-regresar" class="site-title-button float-right">
                                Regresar
                            </div>
                        </a>
                        <div id="btn-iniciar_propuesta" class="site-title-button site-title-button-padding float-right">
                            Iniciar Propuesta
                        </div>
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
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Número Expediente
                                    </div>
                                </div>
                                <div class="right-div">
                                    <div id="btn-buscar-expediente" class="site-label-button float-right">
                                        buscar
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="numeroExpediente" name="numeroExpediente" class="site-input" value="{{ $objDesignacion['expediente'][0]['numero'] }}" readonly />
                                    <input type="hidden" id="idExpediente" name="idExpediente" value="{{ $objDesignacion['expediente'][0]['id'] }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="site-label padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Tipo de Designación
                                    </div>
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <select class="site-select" id="tipo" name="tipo">
                                        <option value="">Seleccione una opción</option>
                                        @foreach($lstTipoDesignacion as $tipoDesignacion)
                                            @if($tipoDesignacion['id']==$objDesignacion['tipoDesignacion'][0]['id'])
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
                    </div>
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

    var urlPropuestaDesignacion = '{{ url('/designacion/nuevo/propuesta') }}';
    var urlGuardarDatos = '{{ url('/designacion/sesion/datos') }}';
    var urlBuscarExpediente = '{{ url('/designacion/buscar/expediente') }}';
    var urlValidarExpediente = '{{ url('/designacion/nuevo/validar/expediente') }}';

    $("#btn-iniciar_propuesta").click(function() {
        var cont = 0;

        if($('#idExpediente').val()==0){
            cont = cont + 1;
        }

        if($('#tipo').val()==""){
            cont = cont + 1;
        }

        if(cont>0){
            $('#modalFaltanDatos').foundation('open');
        } else {
            $('#modalContenidosMensaje').foundation('open');

            var expedienteValidarData = {
                "_token": _token,
                "idExpediente" : $('#idExpediente').val(),
                "tipo" : $('#tipo').val(),
            };

            $.ajax({
                type: 'POST',
                data: expedienteValidarData,
                url: urlValidarExpediente,
                success: function (data) {

                    if(data=="true"){
                        var idDesignacion = $('#idDesignacion').val();
                        var _urlPropuestaDesignacion = urlPropuestaDesignacion+"/"+idDesignacion;

                        var designacionData = {
                            "_token": _token,
                            "idDesignacion" : $('#idDesignacion').val(),
                            "idExpediente" : $('#idExpediente').val(),
                            "numeroExpediente" : $('#numeroExpediente').val(),
                            "tipo" : $('#tipo').val(),
                        };

                        $.ajax({
                            type: 'POST',
                            data: designacionData,
                            url: urlGuardarDatos,
                            success: function (data) {
                                window.location=_urlPropuestaDesignacion;
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                $('#modalContenidosMensaje').foundation('close');
                                $('#modalErrorServer').foundation('open');
                            }
                        });

                    } else {
                        $('#modalContenidosMensaje').foundation('close');
                        $('#modalDesignacionExistePropuesta').foundation('open');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#modalContenidosMensaje').foundation('close');
                    $('#modalErrorServer').foundation('open');
                }
            });






        }

    });

    // =============================================================

    $("#btn-buscar-expediente").click(function() {
        $('#modalContenidosMensaje').foundation('open');

        var _urlBuscarExpediente = urlBuscarExpediente;

        var designacionData = {
            "_token": _token,
            "idDesignacion" : $('#idDesignacion').val(),
            "idExpediente" : $('#idExpediente').val(),
            "numeroExpediente" : $('#numeroExpediente').val(),
            "tipo" : $('#tipo').val(),
        };

        $.ajax({
            type: 'POST',
            data: designacionData,
            url: urlGuardarDatos,
            success: function (data) {
                window.location=_urlBuscarExpediente;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modalContenidosMensaje').foundation('close');
                $('#modalErrorServer').foundation('open');
            }
        });
    });

</script>

@endsection
