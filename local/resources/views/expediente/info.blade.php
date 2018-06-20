@extends('layouts.app')

@section('content')

<div class="grid-container">
    <form id="form-registrar-expediente" method="POST" action="{{ url('expediente/lista', []) }}">
		{{csrf_field() }}
	<div class="grid-x">
    	<div class="cell small-12">
            <div class="table-2cells-div padding-top-30 padding-bottom-40">
                <div class="left-div">
                    <div class="site-title">
                        DETALLE EXPEDIENTE
                    </div>
                </div>
                <div class="right-div">
					<input type="hidden" id="accionRegistrar" name="accionRegistrar" value="editarExpediente {{$id}}"/>
					<a href="{{ url('/expediente/lista') }}">
						<div id="btn-regresar" class="site-title-button float-right">
							Regresar
						</div>
					</a>
					<div id="btn-registrar-expediente" class="site-title-button site-title-button-padding float-right">
						Editar Expediente
					</div>
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
							<input type="text" class="site-input" id="numero" name="numero" @if (!is_null($expedienteTemporal->numero)) value="{{$expedienteTemporal->numero}}" @endif/>
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
							<input type="date" class="site-input" id="fechaSolicitud" name="fechaSolicitud" @if (!is_null($expedienteTemporal->fechaSolicitud)) value="{{$expedienteTemporal->fechaSolicitud}}" @endif/>
                        </div>
                    </div>
                </div>
                <div class="cell small-4">
					<div class="table-2cells-div padding-bottom-5">
						<div class="left-div">
							<div class="site-label">
								Estado Expediente
							</div>
						</div>
					</div>
                    <div class="site-control">
                    	<div class="site-control-border">
							<select class="site-select" id="estadoExpediente" name="estadoExpediente">
								@foreach ($estadosExpediente as $estadoExpediente)
								<option value="{{$estadoExpediente->idExpedienteEstado}}" @if ($estadoExpediente->idExpedienteEstado == $expedienteTemporal->estadoExpediente) selected @endif>{{$estadoExpediente->nombre}}</option>
								@endforeach
							</select>
                        </div>
                    </div>
                </div>
          	</div>
        </div>
        
		<div class="cell small-12 padding-bottom-40">
			<div class="grid-x grid-margin-x">
				<div class="cell small-4">
					<div class="site-label padding-bottom-5">
						Número Expediente Asociado
					</div>
					<div class="site-control">
						<div class="site-control-border">
							<input type="text" class="site-input" id="numeroAsociado" name="numeroAsociado" @if (!is_null($expedienteTemporal->numeroAsociado)) value="{{$expedienteTemporal->numeroAsociado}}" @endif/>
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
						Cuantía Controversia Inicial (S/)
					</div>
					<div class="site-control">
						<div class="site-control-border">
							<input type="text" class="site-input" id="cuantiaControversiaInicial" name="cuantiaControversiaInicial" @if (!is_null($expedienteTemporal->cuantiaControversiaInicial)) value="{{$expedienteTemporal->cuantiaControversiaInicial}}" @endif/>
						</div>
					</div>
				</div>
				<div class="cell small-4">
					<div class="site-label padding-bottom-5">
						Cuantía Controversia Final (S/)
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
							<button type="submit" formmethod="GET" formaction="{{ url('expediente/usuariolegal/directorio', []) }}" name="accion" value="buscarSecretarioId {{$id}}" class="site-label-button float-right" onclick="buscarSecretario()">
								buscar
							</button>
							<div style="clear:both;"></div>
						</div>
					</div>
					<div class="site-control">
						<div class="site-control-border">
							<input type="hidden" name="idSecretarioResponsable" value="{{$expedienteTemporal->idSecretarioResponsable}}" />
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
							<button type="submit" formmethod="GET" formaction="{{ url('expediente/usuariolegal/directorio', []) }}" name="accion" value="buscarLiderId {{$id}}" class="site-label-button float-right" onclick="buscarSecretarioLider()">
								buscar
							</button>
							<div style="clear:both;"></div>
						</div>
					</div>
					<div class="site-control">
						<div class="site-control-border">
							<input type="hidden" name="idSecretarioLider" value="{{$expedienteTemporal->idSecretarioLider}}" />
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
							<button type="submit" formmethod="GET" formaction="{{ url('expediente/clientelegal/directorio', []) }}" name="accion" value="buscarDemandanteId {{$id}}" class="site-label-button float-right" onclick="buscarDemandante()">
								buscar
							</button>
							<div style="clear:both;"></div>
						</div>
					</div>
					<div class="site-control">
						<div class="site-control-border">
							<input type="hidden" name="idDemandante" @if (!is_null($expedienteTemporal->parteDemandante)) value="{{$expedienteTemporal->parteDemandante->id}}" @endif/>
							<input type="text" class="site-input" id="demandante" name="demandante" placeholder="Seleccione un personal" @if (!is_null($expedienteTemporal->parteDemandante)) value="{{$expedienteTemporal->parteDemandante->nombre}}" @endif/>
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
							<button type="submit" formmethod="GET" formaction="{{ url('expediente/clientelegal/directorio', []) }}" name="accion" value="buscarDemandadoId {{$id}}" class="site-label-button float-right" onclick="buscarDemandado()">
								buscar
							</button>
							<div style="clear:both;"></div>
						</div>
					</div>
					<div class="site-control">
						<div class="site-control-border">
							<input type="hidden" name="idDemandado" @if (!is_null($expedienteTemporal->parteDemandado)) value="{{$expedienteTemporal->parteDemandado->id}}" @endif/>
							<input type="text" class="site-input" id="demandado" name="demandado" placeholder="Seleccione un personal"  @if (!is_null($expedienteTemporal->parteDemandado)) value="{{$expedienteTemporal->parteDemandado->nombre}}" @endif/>
						</div>
					</div>
				</div>
				<div class="cell small-4">
					&nbsp;
				</div>
			</div>
		</div>

		@if (!is_null($expedienteTemporal->parteDemandante) || !is_null($expedienteTemporal->parteDemandado))
			<div class="cell small-12">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-4">
						@if (!is_null($expedienteTemporal->parteDemandante))
						@if (!is_null($expedienteTemporal->parteDemandante->consorcio))
							<input type="hidden" name="consorcioDemandante" value="{{$expedienteTemporal->parteDemandante->consorcio}}" />
							<div class="site-line">
								<div class="table-full-cell-div padding-bottom-5">
									<div class="site-label">
										<strong>{{$expedienteTemporal->parteDemandante->consorcio}}</strong>
										<br/>
										<strong>Miembros Demandante</strong>
									</div>
								</div>
								@if (!is_null($expedienteTemporal->parteDemandante->miembrosConsorcio))
								@foreach ($expedienteTemporal->parteDemandante->miembrosConsorcio as $miembro)
									<input type="hidden" name="miembrosDemandante[]" value="{{$miembro}}" />
									<div class="site-control">
										@if($loop->iteration % 2 == 0)
											<div class="site-control-no-border">
										@else
											<div class="site-control-no-border" style="background-color:#F5F5F5;">
										@endif
												{{$miembro}}
											</div>
									</div>
								@endforeach
								@endif
							</div>
						@endif
						@endif
					</div>
                    <div class="cell small-4">
						@if (!is_null($expedienteTemporal->parteDemandado))
						@if (!is_null($expedienteTemporal->parteDemandado->consorcio))
							<input type="hidden" name="consorcioDemandado" value="{{$expedienteTemporal->parteDemandado->consorcio}}" />
							<div class="table-full-cell-div padding-bottom-5">
								<div class="site-label">
									<strong>{{$expedienteTemporal->parteDemandado->consorcio}}</strong>
									<br/>
									<strong>Miembros Demandado</strong>
								</div>
							</div>
							@if (!is_null($expedienteTemporal->parteDemandado->miembrosConsorcio))
							@foreach ($expedienteTemporal->parteDemandado->miembrosConsorcio as $miembro)
								<input type="hidden" name="miembrosDemandado[]" value="{{$miembro}}" />
								<div class="site-control">
									@if($loop->iteration % 2 == 0)
										<div class="site-control-no-border">
									@else
										<div class="site-control-no-border" style="background-color:#F5F5F5;">
									@endif
											{{$miembro}}
										</div>
								</div>
							@endforeach
							@endif
						@endif
						@endif
					</div>
					<div class="cell small-4">
						&nbsp;
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
							<input type="text" class="site-input" id="tipoDemandante" name="tipoDemandante" @if (!is_null($expedienteTemporal->parteDemandante)) @if($expedienteTemporal->parteDemandante->tipo=="PUB") value="Publico" @else @if ($expedienteTemporal->parteDemandante->tipo=="PRV") value="Privado" @endif @endif @endif readonly/>
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
							<input type="text" class="site-input" id="tipoDemandado" name="tipoDemandado" @if (!is_null($expedienteTemporal->parteDemandado)) @if($expedienteTemporal->parteDemandado->tipo=="PUB") value="Publico" @else @if ($expedienteTemporal->parteDemandado->tipo=="PRV") value="Privado" @endif @endif @endif readonly/>
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
						Monto del Contrato (S/)
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
		<div class="cell small-12 padding-bottom-40">
			<div class="grid-x grid-margin-x">
				<div class="cell small-12">
					<div class="site-subtitle padding-bottom-20">
						REGIONES DEL CONTRATO
					</div>
				</div>
				<div class="cell small-12">
					<div class="grid-x">
						<div class="cell small-12 large-8">
							<div class="table-2cells-div padding-bottom-5">
								<div class="left-div">
									<div class="site-sublabel">
										REGIONES
									</div>
								</div>
								<div class="right-div">
									<button type="submit" formmethod="GET" formaction="{{ url('expediente/region/directorio', []) }}" name="accion" value="buscarRegionId {{$id}}" class="site-label-button float-right" onclick="buscarRegion()">
										registrar región
									</button>
									<div style="clear:both;"></div>
								</div>
							</div>
						</div>
						@if(!is_null($expedienteTemporal->regiones))
							<div class="cell small-12 large-8">
								@foreach ($expedienteTemporal->regiones as $region)
									<input id="region {{$loop->index + 1}}" type="hidden" name="regiones[]" value="{{$region}}" />
									@if ($loop->iteration % 2 == 0)
										<div id="outputRegion {{$loop->index + 1}}" class="list-edit-div">
									@else
										<div id="outputRegion {{$loop->index + 1}}" class="list-edit-div" style="background-color:#F5F5F5;">
									@endif
											<div class="list-edit-text-div">
												<div class="list-label-avant-garde-lite">
													Región
												</div>
												<div class="list-biglabel-avant-garde-regular">
													{{ $region }}
												</div>
											</div>
											<div idBorrarRegion="{{$loop->index+1}}" class="btn-borrar-region list-edit-icon-div">
												<img src="{{ asset('images/ico_delete_red.png') }}" />
											</div>
									</div>
								@endforeach
							</div>
						@else
							<div class="cell small-12 large-8">
								<div class="list-edit-no-items-div">
									<div class="list-edit-text-div">
										<div class="list-avant-garde-regular color-9B9B9B">
											NO HAY REGIONES REGISTRADAS
										</div>
									</div>
								</div>
							</div>
						@endif
					</div>
				</div>
			</div>
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
					</div>
				</div>
				<div class="cell small-4">
					<div class="table-2cells-div padding-bottom-5">
						<div class="left-div">
							<div class="site-label">
								Nombre del Árbitro Único
							</div>
						</div>
						<div class="right-div">
							<button type="submit" formmethod="GET" formaction="{{ url('expediente/usuariolegal/directorio', []) }}" name="accion" value="buscarUnicoId {{$id}}" class="site-label-button float-right" onclick="buscarSecretario()">
								buscar
							</button>
							<div style="clear:both;"></div>
						</div>
					</div>
					<div class="site-control">
						<div class="site-control-border">
							<input type="text" class="site-input" id="arbitroUnico" name="arbitroUnico" @if (!is_null($expedienteTemporal->arbitroUnico)) value="{{$expedienteTemporal->arbitroUnico}}" @endif />
						</div>
					</div>
				</div>
				<div class="cell small-4">
					<div class="site-label padding-bottom-5">
						Tipo de Designación del Árbitro Único
					</div>
					<br/>
					<div class="site-control">
						<div class="site-control-border">
							<select class="site-select" id="designacionArbitroUnico" name="designacionArbitroUnico">
								<option value="">Seleccione una opción</option>
								@foreach ($tiposDesignacion as $tipoDesignacion)
									<option value="{{$tipoDesignacion->idDesignacionTipo}}" @if ($tipoDesignacion->idDesignacionTipo == $expedienteTemporal->designacionArbitroUnico) selected @endif>{{$tipoDesignacion->nombre}}</option>
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
						TRIBUNAL ARBITRAL
					</div>
				</div>
				<div class="cell small-4">
					<div class="table-2cells-div padding-bottom-5">
						<div class="left-div">
							<div class="site-label">
								Presidente Tribunal
							</div>
						</div>
						<div class="right-div">
							<button type="submit" formmethod="GET" formaction="{{ url('expediente/usuariolegal/directorio', []) }}" name="accion" value="buscarPresidenteId {{$id}}" class="site-label-button float-right" onclick="buscarSecretario()">
								buscar
							</button>
							<div style="clear:both;"></div>
						</div>
					</div>
					<div class="site-control">
						<div class="site-control-border">
							<input type="text" class="site-input" id="presidenteTribunal" name="presidenteTribunal" @if (!is_null($expedienteTemporal->presidenteTribunal)) value="{{$expedienteTemporal->presidenteTribunal}}" @endif />
						</div>
					</div>
				</div>
				<div class="cell small-4">
					<div class="table-2cells-div padding-bottom-5">
						<div class="left-div">
							<div class="site-label">
								Arbitro Demandante
							</div>
						</div>
						<div class="right-div">
							<button type="submit" formmethod="GET" formaction="{{ url('expediente/usuariolegal/directorio', []) }}" name="accion" value="buscarArbitroDemandanteId {{$id}}" class="site-label-button float-right" onclick="buscarSecretario()">
								buscar
							</button>
							<div style="clear:both;"></div>
						</div>
					</div>
					<div class="site-control">
						<div class="site-control-border">
							<input type="text" class="site-input" id="arbitroDemandante" name="arbitroDemandante" @if (!is_null($expedienteTemporal->arbitroDemandante)) value="{{$expedienteTemporal->arbitroDemandante}}" @endif />
						</div>
					</div>
				</div>
				<div class="cell small-4">
					<div class="table-2cells-div padding-bottom-5">
						<div class="left-div">
							<div class="site-label">
								Arbitro Demandado
							</div>
						</div>
						<div class="right-div">
							<button type="submit" formmethod="GET" formaction="{{ url('expediente/usuariolegal/directorio', []) }}" name="accion" value="buscarArbitroDemandadoId {{$id}}" class="site-label-button float-right" onclick="buscarSecretario()">
								buscar
							</button>
							<div style="clear:both;"></div>
						</div>
					</div>
					<div class="site-control">
						<div class="site-control-border">
							<input type="text" class="site-input" id="arbitroDemandado" name="arbitroDemandado" @if (!is_null($expedienteTemporal->arbitroDemandado)) value="{{$expedienteTemporal->arbitroDemandado}}" @endif />
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
								@foreach ($tiposDesignacion as $tipoDesignacion)
									<option value="{{$tipoDesignacion->idDesignacionTipo}}" @if ($tipoDesignacion->idDesignacionTipo == $expedienteTemporal->designacionPresidenteTribunal) selected @endif>{{$tipoDesignacion->nombre}}</option>
								@endforeach
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
								@foreach ($tiposDesignacion as $tipoDesignacion)
									<option value="{{$tipoDesignacion->idDesignacionTipo}}" @if ($tipoDesignacion->idDesignacionTipo == $expedienteTemporal->designacionDemandante) selected @endif>{{$tipoDesignacion->nombre}}</option>
								@endforeach
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
								@foreach ($tiposDesignacion as $tipoDesignacion)
									<option value="{{$tipoDesignacion->idDesignacionTipo}}" @if ($tipoDesignacion->idDesignacionTipo == $expedienteTemporal->designacionDemandado) selected @endif>{{$tipoDesignacion->nombre}}</option>
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

		<div class="cell small-12 padding-bottom-40">
			<div class="grid-x grid-margin-x">
				<div class="cell small-12">
					<div class="site-subtitle padding-bottom-20">
						RECURSOS CONTRA EL LAUDO
					</div>
				</div>
				<div class="cell small-12">
					<div class="grid-x">
						<div class="cell small-12">
							<div class="table-2cells-div padding-bottom-5">
								<div class="left-div">
									<div class="site-sublabel">
										RECURSOS
									</div>
								</div>
								<div class="right-div">
									<button type="submit" formaction="{{ url('expediente/recurso/nuevo', []) }}" name="accion" value="agregarRecursoId {{$id}}" class="site-label-button float-right" onclick="buscarRecurso()">
										registrar recurso
									</button>
									<div style="clear:both;"></div>
								</div>
							</div>
						</div>
						@if(!is_null($expedienteTemporal->recursos))
							<div class="cell small-12">
								@foreach ($expedienteTemporal->recursos as $recurso)
									<input id="idRecurso {{$loop->index + 1}}" type="hidden" name="idRecurso[]" value="{{$loop->index + 1}}" />
									<input id="recursoPresentado {{$loop->index + 1}}" type="hidden" name="recursoPresentado[]" value="{{$recurso->recursoPresentado}}" />
									<input id="fechaPresentacion {{$loop->index + 1}}" type="hidden" name="fechaPresentacion[]" value="{{$recurso->fechaPresentacion}}" />
									<input id="recursoAFavor {{$loop->index + 1}}" type="hidden" name="recursoAFavor[]" value="{{$recurso->recursoAFavor}}" />
									<input id="resultadoRecursoPresentado {{$loop->index + 1}}" type="hidden" name="resultadoRecursoPresentado[]" value="{{$recurso->resultadoRecursoPresentado}}" />
									<input id="fechaResultado {{$loop->index + 1}}" type="hidden" name="fechaResultado[]" value="{{$recurso->fechaResultado}}" />
									@if ($loop->index % 2 == 0)
										<div id="outputRecurso {{$loop->index + 1}}" class="site-list-item-div background-color-F5F5F5">
									@else
										<div id="outputRecurso {{$loop->index + 1}}" class="site-list-item-div background-color-FFFFFF">
									@endif
											<div class="list-text-5-div">
												<div class="list-label-avant-garde-lite">
													Recurso
												</div>
												<div class="list-biglabel-avant-garde-regular">
													@if (!is_null($recurso->recursoPresentado))
														{{$recurso->getNombreRecurso()}}
													@endif
												</div>
											</div>
											<div class="list-text-5-div">
												<div class="list-label-avant-garde-lite">
													Fecha de Presentación
												</div>
												<div class="list-biglabel-avant-garde-regular">
													{{$recurso->fechaPresentacion}}
												</div>
											</div>
											<div class="list-text-5-div">
												<div class="list-label-avant-garde-lite">
													Recurso por parte de
												</div>
												<div class="list-biglabel-avant-garde-regular">
													@if (!is_null($recurso->recursoAFavor))
														{{$recurso->getNombreRecursoAFavor()}}
													@endif
												</div>
											</div>
											<div class="list-text-5-div">
												<div class="list-label-avant-garde-lite">
													Fecha de Resultado
												</div>
												<div class="list-biglabel-avant-garde-regular">
													{{$recurso->fechaResultado}}
												</div>
											</div>
											<div class="list-text-5-div">
												<div class="list-label-avant-garde-lite">
													Resultado
												</div>
												<div class="list-biglabel-avant-garde-regular">
													@if (!is_null($recurso->resultadoRecursoPresentado))
														{{$recurso->getNombreResultado()}}
													@endif
												</div>
											</div>
											<div class="list-edit-icon-div">
												<button type="submit" formaction="{{ url('expediente/recurso/editar', []) }}" name="accion" value="editarRecursoId {{$id}} {{$loop->index}}" onclick="buscarRecurso()" style="cursor:pointer;">
													<img src="{{ asset('images/ico_pointer_blue.png') }}" />
												</button>
											</div>
											<div idBorrarRecurso="{{$loop->index + 1}}" class="btn-borrar-recurso list-edit-icon-div">
												<img src="{{ asset('images/ico_delete_red.png') }}" />
											</div>
										</div>
								@endforeach
							</div>
						@else
							<div class="cell small-12">
								<div class="list-edit-no-items-div">
									<div class="list-edit-text-div">
										<div class="list-avant-garde-regular color-9B9B9B">
											NO HAY RECURSOS REGISTRADOS
										</div>
									</div>
								</div>
							</div>
						@endif
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

<input type="hidden" id="borrarItem" name="borrarItem" value="" />
<div id="mensajesValidacion">
</div>

@include('shared.modals')

<script>
@include('expediente.jsexpediente')

function esNumeroValido(){
	var numeroExpediente = $('#numero').val();
	@foreach($listaExpedientes as $expediente)
		if (numeroExpediente == "{{$expediente}}" && numeroExpediente != "{{$numeroId}}"){
			return true;
		}
	@endforeach
	return false;
}

</script>
@endsection
