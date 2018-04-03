@extends('layouts.app')

@section('content')

<div class="grid-container">

    <div class="site-title-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="table-2cells-div">
                    <div class="left-div">
                        <div class="site-title">
                            HISTÓRICO ÁRBITRO
                        </div>
                    </div>
                    <div class="right-div">
                        <a href="{{ url('/designacion/buscar/personal') }}">
                            <div id="btn-regresar" class="site-title-button float-right">
                                Regresar
                            </div>
                        </a>
                        <div id="btn-registrar-personal" class="site-title-button site-title-button-padding float-right">
                            Registrar Arbitro
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
                                        Nombre
                                    </div>
                                </div>
                                <div class="right-div">
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="nombre" name="nombre" class="site-input" value="{{ $objPersonal['nombre'] }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Apellido Paterno
                                    </div>
                                </div>
                                <div class="right-div">
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="apPaterno" name="apPaterno" class="site-input" value="{{ $objPersonal['apellidoPaterno'] }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Apellido Materno
                                    </div>
                                </div>
                                <div class="right-div">
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="apMaterno" name="apMaterno" class="site-input" value="{{ $objPersonal['apellidoMaterno'] }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell small-12">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Total Designaciones
                                    </div>
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="totalDesignaciones" name="totalDesignaciones" class="site-input" value="{{ $objPersonal['designaciones_total'] }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Designaciones por las Partes
                                    </div>
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="desigPorLaParte" name="desigPorLaParte" class="site-input" value="{{ $objPersonal['designaciones_parte'] }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Designaciones por la Corte
                                    </div>
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="desigPorLaCorte" name="desigPorLaCorte" class="site-input" value="{{ $objPersonal['designaciones_corte'] }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell small-12">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Designado
                                    </div>
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="desigPropuestas" name="desigPropuestas" class="site-input" value="{{ $objPersonal['designaciones_designado'] }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Propuesto
                                    </div>
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="desigPropuestas" name="desigPropuestas" class="site-input" value="{{ $objPersonal['designaciones_propuestas'] }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Rechazado
                                    </div>
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="desigRechazadas" name="desigRechazadas" class="site-input" value="{{ $objPersonal['designaciones_rechazadas'] }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell small-12">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Renuncias
                                    </div>
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="desigRenunciadas" name="desigRenunciadas" class="site-input" value="{{ $objPersonal['designaciones_renunciadas'] }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-12 large-4">
                        <div class="site-line">
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Recusado
                                    </div>
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" id="desigRecusadas" name="desigRecusadas" class="site-input" value="{{ $objPersonal['designaciones_recusadas'] }}" readonly />
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


    <div class="site-section-padding">
        <div class="grid-x">
            <div class="cell small-12">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    <strong>CASOS RELACIONADOS</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(count($objPersonal['casos'])>0)
                        @foreach($objPersonal['casos'] as $caso)
                            <div class="cell small-12">
                                @if($loop->iteration % 2 == 0)
                                    <div class="list-div">
                                @else
                                    <div class="list-div" style="background-color:#F5F5F5;">
                                @endif
                                    <div class="list-text-4-div">
                                        <div class="list-label-avant-garde-lite">
                                            Expediente
                                        </div>
                                        <div class="list-biglabel-avant-garde-bold color-114168">
                                            {{ $caso['expediente'] }}
                                        </div>
                                        <div class="list-sublabel-avant-garde-regular">
                                            Fecha: <strong>{{ $caso['fecha'] }}</strong>
                                        </div>
                                    </div>
                                    <div class="list-text-4-div">
                                        <div class="list-label-avant-garde-lite">
                                            Estado
                                        </div>
                                        <div class="list-biglabel-avant-garde-regular">
                                            {{ $caso['estado'] }}
                                        </div>
                                    </div>
                                    <div class="list-text-4-div">
                                        <div class="list-label-avant-garde-lite">
                                            Tipo
                                        </div>
                                        <div class="list-biglabel-avant-garde-regular">
                                            {{ $caso['tipo'] }}
                                        </div>
                                    </div>
                                    <div class="list-text-3-div">
                                        <div class="list-label-avant-garde-lite">
                                            Cargo
                                        </div>
                                        <div class="list-biglabel-avant-garde-regular">
                                            {{ $caso['cargo'] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="cell small-12">
                            <div class="list-edit-no-items-div">
                                <div class="list-edit-text-div">
                                    <div class="list-avant-garde-regular color-9B9B9B">
                                        NO PRESENTA CASOS RELACIONADOS
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="site-section-padding">
        &nbsp
    </div>

</div>

<input type="hidden" id="idDesignacion" name="idDesignacion" value="{{ $objDesignacion['idDesignacion'] }}" />
<input type="hidden" id="idPersonal" name="idPersonal" value="{{ $objPersonal['id'] }}" />
<input type="hidden" id="nombrePersonal" name="nombrePersonal" value="{{ $objPersonal['apellidoPaterno'] }} {{ $objPersonal['apellidoMaterno'] }}, {{ $objPersonal['nombre'] }}" />

@include('shared.modals')

<script>

    // VARIABLES JS EXTERNAS
    var _token = "{{ csrf_token() }}";
    var urlGuardarDatos = '{{ url('/designacion/sesion/datos/personal') }}';
    var urlNuevaPropuesta = '{{ url('/designacion/nuevo/propuesta') }}';
    var urlEditarPropuesta = '{{ url('/designacion/editar') }}';

    $("#btn-registrar-personal").click(function() {
        $('#modalRegistrarConfirmar').foundation('open');
    });

    $("#btn-registrar").click(function() {
        $('#modalRegistrarMensaje').foundation('open');

        var idDesignacion = $('#idDesignacion').val();
        var idPersonal = $('#idPersonal').val();
        var nombrePersonal = $('#nombrePersonal').val();;

        var _urlNuevaPropuesta = urlNuevaPropuesta+'/'+idDesignacion;
        var _urlEditarPropuesta = urlEditarPropuesta+'/'+idDesignacion+'/N';

        var designacionData = {
            "_token": _token,
            "idDesignacion" : $('#idDesignacion').val(),
            "idPersonal" : idPersonal,
            "nombrePersonal" : nombrePersonal,
            "estado" : 'PRP',
        };

        $.ajax({
            type: 'POST',
            data: designacionData,
            url: urlGuardarDatos,
            success: function (data) {
                if(data=="false"){
                    $('#modalIncidenteExistePersonal').foundation('open');
                } else {
                    if(idDesignacion=="0"){
                        window.location=_urlNuevaPropuesta;
                    } else {
                        window.location=_urlEditarPropuesta;
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
