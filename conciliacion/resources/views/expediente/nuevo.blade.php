@extends('layouts.app')

@section('content')

<div class="grid-container">
	<div class="grid-x">
    	<div class="cell small-12">
            <div class="table-2cells-div padding-top-30 padding-bottom-40">
                <div class="left-div">
                    <div class="site-title">
                        NUEVO EXPEDIENTE
                    </div>
                </div>
                <div class="right-div">
                	<a href="{{ url('/expediente/lista',[]) }}">
                        <div class="site-title-button float-right">
                            Registrar Expediente
                        </div>
                    </a>
                    <div style="clear:both;"></div>
                </div>
            </div>
		</div>
        <div class="cell small-12 padding-bottom-40">
        	<div class="grid-x grid-margin-x">
            	<div class="cell small-4">
                    <div class="site-line">
                        <div class="site-label padding-bottom-5">
                            Número Expediente
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="numeroExpediente" name="numeroExpediente" />
                            </div>
                        </div>
                    </div>
                </div>
    			<div class="cell small-4">
                    <div class="site-line">
                        <div class="site-label padding-bottom-5">
                            Fecha Solicitud
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="date" class="site-input" id="fechaSolicitud" name="fechaSolicitud" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cell small-4">
                    <div class="site-line">
                        <div class="site-label padding-bottom-5">
                            Estado Expediente
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="estadoExpediente" name="estadoExpediente">
                                    <option value="-">Seleccione una opción</option>
                                    @foreach($objDatosPantalla['expediente_estado'] as $expedienteEstado)
                                        <option value="{{ $expedienteEstado['id'] }}">{{ $expedienteEstado['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid-x grid-margin-x">
                <div class="cell small-4">
                    <div class="site-line">
                        <div class="site-label padding-bottom-5">
                            Número Expediente Asociado
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="numeroExpedienteAsociado" name="numeroExpedienteAsociado" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cell small-4">
                    <div class="site-line">
                        <div class="site-label padding-bottom-5">
                            Tipo Caso
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="tipoCaso" name="tipoCaso">
                                    <option value="-">Seleccione una opción</option>
                                    @foreach($objDatosPantalla['expediente_tipo_caso'] as $tipoCaso)
                                        <option value="{{ $tipoCaso['id'] }}">{{ $tipoCaso['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cell small-4">
                    <div class="site-line">
                        <div class="site-label padding-bottom-5">
                            Subtipo Caso
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="subTipoCaso" name="subTipoCaso">
                                    <option value="-">Seleccione una opción</option>
                                    @foreach($objDatosPantalla['expediente_subtipo_caso'] as $subTipoCaso)
                                        <option value="{{ $subTipoCaso['id'] }}">{{ $subTipoCaso['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="cell small-12 padding-bottom-40">
        	<div class="grid-x grid-margin-x">
            	<div class="cell small-12">
                	<div class="site-subtitle padding-bottom-20">
                        CUANTÍA
                    </div>
                </div>
                <div class="cell small-12">
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-4">
                            <div class="site-line">
                                <div class="site-label padding-bottom-5">
                                    Cuantía Controversia Inicial (S/.)
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <input type="text" class="site-input" id="cuantiaMontoInicial" name="cuantiaMontoInicial" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cell small-4">
                            <div class="site-line">
                                <div class="site-label padding-bottom-5">
                                    Cuantía Controversia Final (S/.)
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <input type="text" class="site-input" id="cuantiaMontoFinal" name="cuantiaMontoFinal" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cell small-4">
                            &nbsp;
                        </div>
                    </div>
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-4">
                            <div class="site-line">
                                <div class="site-label padding-bottom-5">
                                    Tipo Cuantía
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <select class="site-select" id="tipoCuantia" name="tipoCuantia">
                                            <option value="-">Seleccione una opción</option>
                                            @foreach($objDatosPantalla['cuantia_tipo'] as $tipoCuantia)
                                                <option value="{{ $tipoCuantia['id'] }}">{{ $tipoCuantia['nombre'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cell small-4">
                            <div class="site-line">
                                <div class="site-label padding-bottom-5">
                                    Escala de Pago (A-H)
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <select class="site-select" id="tipoCuantia" name="tipoCuantia">
                                            <option value="-">Seleccione una opción</option>
                                            @foreach($objDatosPantalla['cuantia_escala_pago'] as $escalaPago)
                                                <option value="{{ $escalaPago['id'] }}">{{ $escalaPago['nombre'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cell small-4">
                            &nbsp;
                        </div>
                    </div>
                </div>
          	</div>
        </div>
        
        <div class="cell small-12 padding-bottom-40">
        	<div class="grid-x grid-margin-x">
            	<div class="cell small-12">
                	<div class="site-subtitle padding-bottom-20">
                        SECRETARÍA
                    </div>
                </div>
                <div class="cell small-12">
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-4">
                            <div class="site-line">
                                <div class="table-2cells-div padding-bottom-5">
                                    <div class="left-div">
                                        <div class="site-label">
                                            Secretario Respons.
                                        </div>
                                    </div>
                                    <div class="right-div">
                                        <div class="site-label-button float-right">
                                            buscar
                                        </div>
                                        <div style="clear:both;"></div>
                                    </div>
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <input type="text" class="site-input" id="secretarioResponable" name="secretarioResponable" placeholder="Seleccione un personal" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cell small-4">
                            <div class="site-line">
                                <div class="table-2cells-div padding-bottom-5">
                                    <div class="left-div">
                                        <div class="site-label">
                                            Secretario Lider
                                        </div>
                                    </div>
                                    <div class="right-div">
                                        <div class="site-label-button float-right">
                                            buscar
                                        </div>
                                        <div style="clear:both;"></div>
                                    </div>
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <input type="text" class="site-input" id="secretarioLider" name="secretarioLider" placeholder="Seleccione un personal" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cell small-4">
                            &nbsp;
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="cell small-12 padding-bottom-40">
        	<div class="grid-x grid-margin-x">
            	<div class="cell small-12">
                	<div class="site-subtitle padding-bottom-20">
                        PARTES
                    </div>
                </div>
                <div class="cell small-12">
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-4">
                            <div class="site-line">
                                <div class="table-2cells-div padding-bottom-5">
                                    <div class="left-div">
                                        <div class="site-label">
                                            Demandante
                                        </div>
                                    </div>
                                    <div class="right-div">
                                        <div class="site-label-button float-right">
                                            buscar
                                        </div>
                                        <div style="clear:both;"></div>
                                    </div>
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <input type="text" class="site-input" id="demandante" name="demandante" placeholder="Seleccione un personal" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cell small-4">
                            <div class="site-line">
                                <div class="table-2cells-div padding-bottom-5">
                                    <div class="left-div">
                                        <div class="site-label">
                                            Demandado
                                        </div>
                                    </div>
                                    <div class="right-div">
                                        <div class="site-label-button float-right">
                                            buscar
                                        </div>
                                        <div style="clear:both;"></div>
                                    </div>
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <input type="text" class="site-input" id="demandado" name="demandado" placeholder="Seleccione un personal" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cell small-4">
                            &nbsp;
                        </div>
                    </div>
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-4">
                            <div class="site-label padding-bottom-5">
                                Miembros Demandandante
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" class="site-input" id="demandante" name="demandante" placeholder="Seleccione un personal" />
                                </div>
                            </div>
                        </div>
                        <div class="cell small-4">
                            <div class="site-label padding-bottom-5">
                                Miembros Demandado
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" class="site-input" id="demandante" name="demandante" placeholder="Seleccione un personal" />
                                </div>
                            </div>
                        </div>
                        <div class="cell small-4">
                            &nbsp;
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="cell small-12 padding-bottom-40">
        	<div class="grid-x grid-margin-x">
            	<div class="cell small-12">
                	<div class="site-subtitle padding-bottom-20">
                        CONTRATO QUE ORIGINÓ EL ARBITRAJE
                    </div>
                </div>
                <div class="cell small-12">
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-4">
                            <div class="site-line">
                                <div class="site-label padding-bottom-5">
                                    Origen Arbitraje
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <select class="site-select" id="origenArbitraje" name="origenArbitraje">
                                            <option value="">Seleccione una opción</option>
                                            @foreach($objDatosPantalla['arbitraje_origen'] as $origenArbitraje)
                                                <option value="{{ $origenArbitraje['id'] }}">{{ $origenArbitraje['nombre'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cell small-4">
                            <div class="site-line">
                                <div class="site-label padding-bottom-5">
                                    Monto del Contrato (S/.)
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <select class="site-select" id="montoContrato" name="montoContrato">
                                            <option value="">Seleccione una opción</option>
                                            @foreach($objDatosPantalla['arbitraje_monto_contrato'] as $montoContrato)
                                                <option value="{{ $montoContrato['id'] }}">{{ $montoContrato['nombre'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cell small-4">
                            <div class="site-line">
                                <div class="site-label padding-bottom-5">
                                    Año del Contrato
                                </div>
                                <div class="site-control">
                                    <div class="site-control-border">
                                        <input type="text" class="site-input" id="anhoContrato" name="anhoContrato" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-8">
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Regiones de Controversia
                                    </div>
                                </div>
                                <div class="right-div">
                                    <div class="site-label-button float-right">
                                        buscar
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                            </div>
                        </div>

                        <style>
                            .region-div{
                                width:100%;
                                display:table;
                                padding:15px 20px;
                            }

                            .region-text-div{
                                display:table-cell;
                                width:100%;
                                vertical-align:middle;
                            }

                            .region-icon-div{
                                display:table-cell;

                                min-width:30px;
                                max-width:30px;
                            }

                            .region-icon-div img{
                                width:100%;
                            }

                            .list-avant-garde-lite{
                                font-family: 'avantgarde-lite';
                                width:100%;

                                font-size:1em;
                                line-height:1em;
                            }

                            .list-avant-garde-regular{
                                font-family: 'avantgarde-regular';
                                font-weight:bold;
                                width:100%;

                                font-size:1.3em;
                                line-height:1em;
                            }


                        </style>

                        <div class="cell small-8">
                            <div class="region-div" style="background-color:#F5F5F5;">
                                <div class="region-text-div">
                                    <div class="list-avant-garde-lite">
                                        Región
                                    </div>
                                    <div class="list-avant-garde-regular">
                                        Nombre de la región
                                    </div>
                                </div>
                                <div class="region-icon-div">
                                    <img src="{{ asset('images/ico_delete_red.png') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="cell small-8">
                            <div class="region-div">
                                <div class="region-text-div">
                                    <div class="list-avant-garde-lite">
                                        Región
                                    </div>
                                    <div class="list-avant-garde-regular">
                                        Nombre de la región
                                    </div>
                                </div>
                                <div class="region-icon-div">
                                    <img src="{{ asset('images/ico_delete_red.png') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="cell small-8">
                            <div class="region-div" style="background-color:#F5F5F5;">
                                <div class="region-text-div">
                                    <div class="list-avant-garde-lite">
                                        Región
                                    </div>
                                    <div class="list-avant-garde-regular">
                                        Nombre de la región
                                    </div>
                                </div>
                                <div class="region-icon-div">
                                    <img src="{{ asset('images/ico_delete_red.png') }}" />
                                </div>
                            </div>
                        </div>

                    </div>
                 </div>
            </div>
        </div>
        
        <div class="font-avandgarde-bold padding-top-50 padding-bottom-50">
        	(( ... continúan más contenidos ))
        </div>
        
    </div>
</div>
@endsection
