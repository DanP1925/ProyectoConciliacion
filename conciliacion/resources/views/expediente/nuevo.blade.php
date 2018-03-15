@extends('layouts.app')

@section('title', 'Nuevo Expediente')

@section('content')

<div class="grid-container">
    <form method="POST" action="/expediente/lista">
        {{ csrf_field() }}

        <div class="grid-x">
            <div class="cell small-12">
                <div class="table-2cells-div padding-top-30 padding-bottom-40">
                    <div class="left-div">
                        <div class="site-title">
                            DETALLE DE EXPEDIENTE
                        </div>
                    </div>
                    <div class="right-div">
                        <button type="submit" class="site-title-button float-right">
                            Registrar Expediente
                        </button>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
            <div class="cell small-12 padding-bottom-20">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Número Expediente
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="numeroExpediente" name="numeroExpediente" @if (!is_null($expedienteTemporal->numeroExpediente)) value="{{$expedienteTemporal->numeroExpediente}}" @endif/>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    Fecha Inicio de Solicitud
                                </div>
                            </div>
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="date" class="site-input" id="fechaSolicitud" name="fechaSolicitud" @if (!is_null($expedienteTemporal->fechaSolicitud)) value="{{$expedienteTemporal->fechaSolicitud}}" @endif//>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    Estado de Expediente
                                </div>
                            </div>
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="estadoExpediente" name="estadoExpediente">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($estadosExpediente as $estadoExpediente)
                                    <option value="{{$estadoExpediente->idExpedienteEstado}}" @if ($estadoExpediente->idExpedienteEstado == $expedienteTemporal->estadoExpediente) selected @endif>{{$estadoExpediente->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="cell small-12 padding-bottom-20">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Número Expediente Asociado
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="numeroExpedienteAsociado" name="numeroExpedienteAsociado" />
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    Tipo de Caso
                                </div>
                            </div>
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="tipoCaso" name="tipoCaso">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($tipos as $tipo)
                                    <option value="{{$tipo->idExpedienteTipoCaso}}" @if ($tipo->idExpedienteTipoCaso == $expedienteTemporal->tipoCaso) selected @endif>{{$tipo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    Subtipo de Caso
                                </div>
                            </div>
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="subtipoCaso" name="subtipoCaso">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($subtipos as $subtipo)
                                    <option value="{{$subtipo->idExpedienteSubtipoCaso}}" @if ($subtipo->idExpedienteSubtipoCaso == $expedienteTemporal->subtipoCaso) selected @endif>{{$subtipo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
            
            <div class="cell small-12 padding-bottom-20">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12">
                        <div class="site-subtitle padding-bottom-20">
                            CUANTÍA
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Cuantía Controversia Inicial (S/.)
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="cuantiaControversiaInicial" name="cuantiaControversiaInicial" @if (!is_null($expedienteTemporal->cuantiaControversiaInicial)) value="{{$expedienteTemporal->cuantiaControversiaInicial}}" @endif/>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Cuantía Controversia Final (S/.)
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="cuantiaControversiaFinal" name="cuantiaControversiaFinal" @if (!is_null($expedienteTemporal->cuantiaControversiaFinal)) value="{{$expedienteTemporal->cuantiaControversiaFinal}}" @endif/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell small-12 padding-bottom-40">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Tipo Cuantía
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="tipoCuantia" name="tipoCuantia">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($tiposCuantia as $tipoCuantia)
                                    <option value="{{$tipoCuantia->idCuantiaTipo}}" @if ($tipoCuantia->idCuantiaTipo == $expedienteTemporal->tipoCuantia) selected @endif>{{$tipoCuantia->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Escala de Pago (A-H)
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="escalaPago" name="escalaPago">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($escalasDePago as $escalaDePago)
                                    <option value="{{$escalaDePago->idCuantiaEscalaPago}}" @if ($escalaDePago->idCuantiaEscalaPago == $expedienteTemporal->escalaPago) selected @endif>{{$escalaDePago->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="cell small-12 padding-bottom-40">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12">
                        <div class="site-subtitle padding-bottom-20">
                            SECRETARÍA ARBITRAL
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    Secretario Res.
                                </div>
                            </div>
                            <div class="right-div">
                                <button type="submit" formaction="/usuariolegal/directorio" name="accion" value="buscarSecretario" class="site-label-button float-right">
                                    <div class="site-label-button float-right">
                                        buscar
                                    </div>
                                </button>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="secretarioResponable" name="secretarioResponsable" placeholder="Seleccione un personal" @if (!is_null($expedienteTemporal->secretarioArbitral)) value="{{$expedienteTemporal->secretarioArbitral}}" @endif/>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    Secretario Lider
                                </div>
                            </div>
                            <div class="right-div">
                                <button type="submit" formaction="/usuariolegal/directorio" name="accion" value="buscarLider" class="site-label-button float-right">
                                    buscar
                                </button>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="secretarioLider" name="secretarioLider" placeholder="Seleccione un personal" @if (!is_null($expedienteTemporal->secretarioArbitralLider)) value="{{$expedienteTemporal->secretarioArbitralLider}}" @endif/>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        &nbsp;
                    </div>
                </div>
            </div>
            
            <div class="cell small-12 padding-bottom-20">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12">
                        <div class="site-subtitle padding-bottom-20">
                            PARTES
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    Demandante
                                </div>
                            </div>
                            <div class="right-div">
                                <button type="submit" formaction="/clientelegal/directorio" name="accion" value="buscarDemandante" class="site-label-button float-right">
                                    buscar
                                </button>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="demandante" name="demandante" placeholder="Seleccione un personal" @if (!is_null($expedienteTemporal->demandante)) value="{{$expedienteTemporal->demandante}}" @endif/>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    Demandado
                                </div>
                            </div>
                            <div class="right-div">
                                <button type="submit" formaction="/clientelegal/directorio" name="accion" value="buscarDemandado" class="site-label-button float-right">
                                    buscar
                                </button>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="demandado" name="demandado" placeholder="Seleccione un personal" @if (!is_null($expedienteTemporal->demandado)) value="{{$expedienteTemporal->demandado}}" @endif />
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        &nbsp;
                    </div>
                </div>
            </div>
			@if (!is_null($expedienteTemporal->consorcioDemandante) || !is_null($expedienteTemporal->consorcioDemandado))
			<div class="cell small-12 padding-bottom-40">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-4">
					@if (!is_null($expedienteTemporal->consorcioDemandante))
						<input type="hidden" name="consorcioDemandante" value="{{$expedienteTemporal->consorcioDemandante}}" />
						<div class="site-list-item-label padding-bottom-3">
							Nombre Consorcio
						</div>
						<div class="site-list-item-text padding-bottom-5">
							{{$expedienteTemporal->consorcioDemandante}}
						</div>
						@foreach ($expedienteTemporal->miembrosDemandante as $miembro)
						<input type="hidden" name="miembrosDemandante[]" value="{{$miembro}}" />
						@if ($loop->index % 2 == 0)
							<div class="site-list-item-div background-color-F5F5F5">
						@else
							<div class="site-list-item-div background-color-FFFFFF">
						@endif
							<div class="grid-x grid-margin-x">
								<div class="cell small-12">
									<div class="site-list-item-label padding-bottom-3">
										Miembro {{$loop->index + 1}}
									</div>
									<div class="site-list-item-text">
										{{$miembro}}
									</div>
								</div>
							</div>
						</div>
						@endforeach
					@endif
					</div>
                    <div class="cell small-4">
					@if (!is_null($expedienteTemporal->consorcioDemandado))
						<input type="hidden" name="consorcioDemandado" value="{{$expedienteTemporal->consorcioDemandado}}" />
						<div class="site-list-item-label padding-bottom-3">
							Nombre Consorcio
						</div>
						<div class="site-list-item-text padding-bottom-5">
							{{$expedienteTemporal->consorcioDemandado}}
						</div>
						@foreach ($expedienteTemporal->miembrosDemandado as $miembro)
						<input type="hidden" name="miembrosDemandado[]" value="{{$miembro}}" />
						@if ($loop->index % 2 == 0)
							<div class="site-list-item-div background-color-F5F5F5">
						@else
							<div class="site-list-item-div background-color-FFFFFF">
						@endif
							<div class="grid-x grid-margin-x">
								<div class="cell small-12">
									<div class="site-list-item-label padding-bottom-3">
										Miembro {{$loop->index + 1}}
									</div>
									<div class="site-list-item-text">
										{{$miembro}}
									</div>
								</div>
							</div>
						</div>
						@endforeach
					@endif
					</div>
				</div>
			</div>
			@endif
            <div class="cell small-12 padding-bottom-40">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-4">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    Tipo Demandante
                                </div>
                            </div>
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="tipoDemandante" name="tipoDemandante">
                                    <option value="">Seleccione una opción</option>
									<option value="PUB" @if ($expedienteTemporal->tipoDemandante == "PUB") selected @endif>Público</option>
									<option value="PRI" @if ($expedienteTemporal->tipoDemandante == "PRI") selected @endif>Privado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    Tipo Demandado
                                </div>
                            </div>
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="tipoDemandado" name="tipoDemandado">
                                    <option value="">Seleccione una opción</option>
									<option value="PUB" @if ($expedienteTemporal->tipoDemandado == "PUB") selected @endif>Público</option>
									<option value="PRI" @if ($expedienteTemporal->tipoDemandado == "PRI") selected @endif>Privado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        &nbsp;
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
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Origen Arbitraje
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="origenArbitraje" name="origenArbitraje">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($origenesArbitraje as $origenArbitraje)
                                    <option value="{{$origenArbitraje->idArbitrajeOrigen}}" @if ($origenArbitraje->idArbitrajeOrigen == $expedienteTemporal->origenArbitraje) selected @endif>{{$origenArbitraje->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Monto del Contrato (S/.)
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="montoContrato" name="montoContrato">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($montosContrato as $montoContrato)
                                    <option value="{{$montoContrato->idArbitrajeMontoContrato}}" @if ($montoContrato->idArbitrajeMontoContrato == $expedienteTemporal->montoContrato) selected @endif>{{$montoContrato->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Año del Contrato
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="anhoContrato" name="anhoContrato" @if (!is_null($expedienteTemporal->anhoContrato)) value="{{$expedienteTemporal->anhoContrato}}" @endif/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell small-9 padding-bottom-40">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12">
                        <div class="table-2cells-div">
                            <div class="left-div">
                                <div class="site-subtitle padding-bottom-20">
                                    REGIONES DEL CONTRATO
                                </div>
                            </div>
                            <div class="right-div">
                                <button type="submit" formaction="/region/directorio" name="accion" value="buscarRegion" class="site-label-button float-right">
                                    AGREGAR REGIONES
                                </button>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell small-9 padding-bottom-50">
				@if(!is_null($expedienteTemporal->regiones))
				@foreach ($expedienteTemporal->regiones as $region)
				<input id="region {{$loop->index + 1}}" type="hidden" name="regiones[]" value="{{$region}}" />
				@if ($loop->index % 2 == 0)
				<div id="outputRegion {{$loop->index + 1}}" class="site-list-item-div background-color-F5F5F5">
				@else
                <div id="outputRegion {{$loop->index + 1}}" class="site-list-item-div background-color-FFFFFF">
				@endif
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-10">
                            <div class="site-list-item-label padding-bottom-3">
                                Nombre
                            </div>
                            <div class="site-list-item-text padding-bottom-5">
								{{$region}}
                            </div>
                        </div>
                        <div class="cell small-2">
							<button type="button" onclick="quitarRegion({{$loop->index + 1}});" >
								<i class="fa fa-trash" style="font-size:36px;"></i>
							</button>
                        </div>
                    </div>
                </div>
				@endforeach
				@endif
            </div>
            <div class="cell small-12 padding-bottom-40">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12">
                        <div class="table-2cells-div">
                            <div class="left-div">
                                <div class="site-subtitle padding-bottom-20">
                                    ÁRBITRO ÚNICO
                                </div>
                            </div>
                            <div class="right-div">
                                <button type="submit" formaction="/recurso/nuevo" name="accion" value="agregarRecurso" class="site-label-button float-right">
                                    VER PROPUESTAS
                                </button>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Nombre del Árbitro Único
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="arbitroUnico" name="arbitroUnico" @if (!is_null($expedienteTemporal->arbitroUnico)) value="{{$expedienteTemporal->arbitroUnico}}" @endif/>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Tipo de Designación del Árbitro Único
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="designacionArbitroUnico" name="designacionArbitroUnico">
                                    <option value="">Seleccione una opción</option>
									<option value="Parte" @if ($expedienteTemporal->designacionArbitroUnico == "Parte") selected @endif>Designado por la Parte</option>
									<option value="Corte" @if ($expedienteTemporal->designacionArbitroUnico == "Corte") selected @endif>Designado por la Corte</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell small-12 padding-bottom-20">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12">
                        <div class="site-subtitle padding-bottom-20">
                            TRIBUNAL ARBITRAL
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Presidente Tribunal
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="presidenteTribunal" name="presidenteTribunal" @if (!is_null($expedienteTemporal->presidenteTribunal)) value="{{$expedienteTemporal->presidenteTribunal}}" @endif/>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Arbitro Demandante
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="arbitroDemandante" name="arbitroDemandante" @if (!is_null($expedienteTemporal->arbitroDemandante)) value="{{$expedienteTemporal->arbitroDemandante}}" @endif/>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Arbitro Demandado
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="arbitroDemandado" name="arbitroDemandado" @if (!is_null($expedienteTemporal->arbitroDemandado)) value="{{$expedienteTemporal->arbitroDemandado}}" @endif/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell small-12 padding-bottom-40">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Tipo de Designación Presidente Tribunal
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="designacionPresidenteTribunal" name="designacionPresidenteTribunal">
                                    <option value="">Seleccione una opción</option>
									<option value="Parte" @if ($expedienteTemporal->designacionPresidenteTribunal == "Parte") selected @endif>Designado por la Parte</option>
									<option value="Corte" @if ($expedienteTemporal->designacionPresidenteTribunal == "Corte") selected @endif>Designado por la Corte</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Tipo de Designación Demandante
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="designacionDemandante" name="designacionDemandante">
                                    <option value="">Seleccione una opción</option>
									<option value="Parte" @if ($expedienteTemporal->designacionDemandante == "Parte") selected @endif>Designado por la Parte</option>
									<option value="Corte" @if ($expedienteTemporal->designacionDemandante == "Corte") selected @endif>Designado por la Corte</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Tipo de Designación Demandado
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="designacionDemandado" name="designacionDemandado">
                                    <option value="">Seleccione una opción</option>
									<option value="Parte" @if ($expedienteTemporal->designacionDemandado == "Parte") selected @endif>Designado por la Parte</option>
									<option value="Corte" @if ($expedienteTemporal->designacionDemandado == "Corte") selected @endif>Designado por la Corte</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell small-12 padding-bottom-20">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12">
                        <div class="site-subtitle padding-bottom-20">
                            LAUDADO
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Fecha Laudo
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="date" class="site-input" id="fechaLaudo" name="fechaLaudo" @if (!is_null($expedienteTemporal->fechaLaudo)) value="{{$expedienteTemporal->fechaLaudo}}" @endif/>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Resultado
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="resultadoLaudo" name="resultadoLaudo">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($resultadosLaudo as $resultadoLaudo)
                                    <option value="{{$resultadoLaudo->idLaudoResultado}}" @if ($resultadoLaudo->idLaudoResultado == $expedienteTemporal->resultadoLaudo) selected @endif>{{$resultadoLaudo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Resultado en soles sin IGV
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="resultadoEnSoles" name="resultadoEnSoles" @if (!is_null($expedienteTemporal->resultadoEnSoles)) value="{{$expedienteTemporal->resultadoEnSoles}}" @endif />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell small-12 padding-bottom-40">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Ejecución de Laudo
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="ejecucionLaudo" name="ejecucionLaudo">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($ejecucionesLaudo as $ejecucionLaudo)
                                    <option value="{{$ejecucionLaudo->idLaudoEjecucion}}" @if ($ejecucionLaudo->idLaudoEjecucion == $expedienteTemporal->ejecucionLaudo) selected @endif>{{$ejecucionLaudo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Laudado a favor de
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="laudadoAFavor" name="laudadoAFavor">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($favorLaudo as $favor)
                                    <option value="{{$favor->idLaudoAFavor}}" @if ($favor->idLaudoAFavor == $expedienteTemporal->laudadoAFavor) selected @endif>{{$favor->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell small-12 padding-bottom-20">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12">
                        <div class="table-2cells-div">
                            <div class="left-div">
                                <div class="site-subtitle padding-bottom-20">
                                    RECURSOS CONTRA EL LAUDO
                                </div>
                            </div>
                            <div class="right-div">
                                <button type="Agregar Recursos" class="site-label-button float-right">
                                    AGREGAR RECURSOS
                                </button>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell small-12 padding-bottom-50">
                <div class="site-list-item-div background-color-F5F5F5">
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-3">
                            <div class="site-list-item-label padding-bottom-3">
                                Recurso
                            </div>
                            <div class="site-list-item-text padding-bottom-5">
                                Rectificación
                            </div>
                        </div>
                        <div class="cell small-3">
                            <div class="site-list-item-label padding-bottom-3">
                                Fecha de Presentación
                            </div>
                            <div class="site-list-item-text padding-bottom-5">
                                10/10/2018
                            </div>
                        </div>
                        <div class="cell small-3">
                            <div class="site-list-item-label padding-bottom-3">
                                Fecha de Resultado
                            </div>
                            <div class="site-list-item-text padding-bottom-5">
                                Por definir
                            </div>
                        </div>
                        <div class="cell small-3">
                            <div class="site-list-item-label padding-bottom-3">
                                Resultado
                            </div>
                            <div class="site-list-item-text padding-bottom-5">
                                Por definir
                            </div>
                        </div>
                    </div>
                </div>
                <div class="site-list-item-div background-color-FFFFFF">
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-3">
                            <div class="site-list-item-label padding-bottom-3">
                                Recurso
                            </div>
                            <div class="site-list-item-text padding-bottom-5">
                                Interpretación
                            </div>
                        </div>
                        <div class="cell small-3">
                            <div class="site-list-item-label padding-bottom-3">
                                Fecha de Presentación
                            </div>
                            <div class="site-list-item-text padding-bottom-5">
                                10/10/2018
                            </div>
                        </div>
                        <div class="cell small-3">
                            <div class="site-list-item-label padding-bottom-3">
                                Fecha de Resultado
                            </div>
                            <div class="site-list-item-text padding-bottom-5">
                                12/10/2018
                            </div>
                        </div>
                        <div class="cell small-3">
                            <div class="site-list-item-label padding-bottom-3">
                                Resultado
                            </div>
                            <div class="site-list-item-text padding-bottom-5">
                                Aprobado
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($errors->any())
            <div class="cell small-12 padding-bottom-50 error">
                <div class="site-list-item-text padding-bottom-5">
                    Los siguientes errores fueron encontraros cuando registrabamos el expediente:
                </div>
                <div class="site-list-item-label">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
function quitarRegion(indexRegion) {
	var region = document.getElementById('region ' + indexRegion);
	region.parentNode.removeChild(region);
	var outputRegion = document.getElementById('outputRegion ' + indexRegion);
	outputRegion.parentNode.removeChild(outputRegion);
}
</script>
@endsection
