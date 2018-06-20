@extends('layouts.app')

@section('content')

<div class="grid-container">

    <div class="site-title-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="table-2cells-div">
                    <div class="left-div">
                        <div class="site-title">
                            DETALLE PROPUESTA
                        </div>
                    </div>
                    <div class="right-div">
                        <a href="{{ url('/designacion/nuevo/propuesta',['idDesignacion' => $objDesignacion['idDesignacion']]) }}">
                            <div id="btn-regresar" class="site-title-button float-right">
                                Regresar
                            </div>
                        </a>
                        <div id="btn-actualizar-detalle" class="site-title-button site-title-button-padding float-right">
                            Actualizar Detalle
                        </div>
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
                                Nombre
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" class="site-input" id="nombre" name="nombre" value="{{ $nombreCompleto }}" readonly />
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
                                        @if($estado=="PRP")
                                            <option value="PRP" selected="selected">Propuesto</option>
                                        @else
                                            <option value="PRP">Propuesto</option>
                                        @endif
                                        @if($estado=="DES")
                                            <option value="DES" selected="selected">Designado</option>
                                        @else
                                                <option value="DES">Designado</option>
                                        @endif
                                        @if($estado=="RCH")
                                            <option value="RCH" selected="selected">Rechazado</option>
                                        @else
                                                <option value="RCH">Rechazado</option>
                                        @endif
                                        @if($estado=="RCH")
                                            <option value="REN" selected="selected">Renunciado</option>
                                        @else
                                                <option value="REN">Renunciado</option>
                                        @endif
                                        @if($estado=="RCH")
                                            <option value="REC" selected="selected">Recusado</option>
                                        @else
                                            <option value="REC">Recusado</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="site-label padding-bottom-5">
                                Tipo Designacion
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <select class="site-select" id="flgTipoDesignacion" name="flgTipoDesignacion">
                                        @if($flgTipoDesignacion=="")
                                            <option value="" selected="selected">Por Definir</option>
                                        @else
                                            <option value="">Por Definir</option>
                                        @endif
                                        @if($flgTipoDesignacion=="C")
                                            <option value="C" selected="selected">Por la Corte</option>
                                        @else
                                            <option value="C">Por la Corte</option>
                                        @endif
                                        @if($flgTipoDesignacion=="P")
                                            <option value="P" selected="selected">Por las Partes</option>
                                        @else
                                            <option value="P">Por las Partes</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell small-12">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12">
                        <div class="site-line">
                            <div class="site-label padding-bottom-5">
                                Observación
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <textarea type="text" class="site-textarea" id="observacion" name="observacion">{{ $observacion }}</textarea>
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
<input type="hidden" id="hash" name="hash" value="{{ $hash }}" />

@include('shared.modals')

<script>

    // VARIABLES JS EXTERNAS
    var _token = "{{ csrf_token() }}";
    var urlGuardarDatos = '{{ url('/designacion/sesion/datos/propuesta') }}';
    var urlNuevaPropuesta = '{{ url('/designacion/nuevo/propuesta') }}';
    var urlEditarPropuesta = '{{ url('/designacion/editar') }}';

    $("#btn-actualizar-detalle").click(function() {
        $('#modalRegistrarMensaje').foundation('open');

        var idDesignacion = $('#idDesignacion').val();
        var _urlNuevaPropuesta = urlNuevaPropuesta+'/'+idDesignacion;
        var _urlEditarPropuesta = urlEditarPropuesta+'/'+idDesignacion+'/N';

        var designacionData = {
            "_token": _token,
            "idDesignacion" : $('#idDesignacion').val(),
            "hash" : $('#hash').val(),
            "estado" : $('#estado').val(),
            "flgTipoDesignacion" : $('#flgTipoDesignacion').val(),
            "observacion" : $('#observacion').val(),
        };

        $.ajax({
            type: 'POST',
            data: designacionData,
            url: urlGuardarDatos,
            success: function (data) {
                if(idDesignacion=="0"){
                    window.location=_urlNuevaPropuesta;
                } else {
                    window.location=_urlEditarPropuesta;
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
