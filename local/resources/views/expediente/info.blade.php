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
					<input type="hidden" name="accionRegistrar" value="editarExpediente {{$id}}"/>
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
							<input type="hidden" name="idDemandante" value="{{$expedienteTemporal->idDemandante}}" />
							<input type="text" class="site-input" id="demandante" name="demandante" @if (!is_null($expedienteTemporal->demandante)) value="{{$expedienteTemporal->demandante}}" @endif/>
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
							<input type="hidden" name="idDemandado" value="{{$expedienteTemporal->idDemandado}}" />
							<input type="text" class="site-input" id="demandado" name="demandado" @if (!is_null($expedienteTemporal->demandado)) value="{{$expedienteTemporal->demandado}}" @endif/>
						</div>
					</div>
				</div>
				<div class="cell small-4">
					&nbsp;
				</div>
			</div>
		</div>

		@if (!is_null($expedienteTemporal->consorcioDemandante) || !is_null($expedienteTemporal->consorcioDemandado))
			<div class="cell small-12">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-4">
						@if (!is_null($expedienteTemporal->consorcioDemandante))
							<input type="hidden" name="consorcioDemandante" value="{{$expedienteTemporal->consorcioDemandante}}" />
							<div class="site-line">
								<div class="table-full-cell-div padding-bottom-5">
									<div class="site-label">
										<strong>Miembros Demandante</strong>
									</div>
								</div>
								@foreach ($expedienteTemporal->miembrosDemandante as $miembro)
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
							</div>
						@endif
					</div>
                    <div class="cell small-4">
						@if (!is_null($expedienteTemporal->consorcioDemandado))
							<input type="hidden" name="consorcioDemandado" value="{{$expedienteTemporal->consorcioDemandado}}" />
							<div class="table-full-cell-div padding-bottom-5">
								<div class="site-label">
									<strong>Miembros Demandado</strong>
								</div>
							</div>
							@foreach ($expedienteTemporal->miembrosDemandado as $miembro)
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
							<select class="site-select" id="tipoDemandante" name="tipoDemandante">
								<option value="">Seleccione una opción</option>
								<option value="PUB" @if ($expedienteTemporal->tipoDemandante == "PUB") selected @endif>Público</option>
								<option value="PRV" @if ($expedienteTemporal->tipoDemandante == "PRV") selected @endif>Privado</option>
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
									<option value="PRV" @if ($expedienteTemporal->tipoDemandado == "PRV") selected @endif>Privado</option>
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
								<option value="Por la parte" @if ($expedienteTemporal->designacionArbitroUnico == "Por la parte") selected @endif>Designado por la Parte</option>
								<option value="Por la corte" @if ($expedienteTemporal->designacionArbitroUnico == "Por la corte") selected @endif>Designado por la Corte</option>
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
								<option value="Por la parte" @if ($expedienteTemporal->designacionPresidenteTribunal == "Por la parte") selected @endif>Designado por la Parte</option>
								<option value="Por la corte" @if ($expedienteTemporal->designacionPresidenteTribunal == "Por la corte") selected @endif>Designado por la Corte</option>
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
								<option value="Por la parte" @if ($expedienteTemporal->designacionDemandante == "Por la parte") selected @endif>Designado por la Parte</option>
								<option value="Por la corte" @if ($expedienteTemporal->designacionDemandante == "Por la corte") selected @endif>Designado por la Corte</option>
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
								<option value="Por la parte" @if ($expedienteTemporal->designacionDemandado == "Por la parte") selected @endif>Designado por la Parte</option>
								<option value="Por la corte" @if ($expedienteTemporal->designacionDemandado == "Por la corte") selected @endif>Designado por la Corte</option>
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
									<input id="recursoPresentado {{$loop->index + 1}}" type="hidden" name="recursoPresentado[]" value="{{$recurso->recursoPresentado}}" />
									<input id="fechaPresentacion {{$loop->index + 1}}" type="hidden" name="fechaPresentacion[]" value="{{$recurso->fechaPresentacion}}" />
									<input id="resultadoRecursoPresentado {{$loop->index + 1}}" type="hidden" name="resultadoRecursoPresentado[]" value="{{$recurso->resultadoRecursoPresentado}}" />
									<input id="fechaResultado {{$loop->index + 1}}" type="hidden" name="fechaResultado[]" value="{{$recurso->fechaResultado}}" />
									@if ($loop->index % 2 == 0)
										<div id="outputRecurso {{$loop->index + 1}}" class="site-list-item-div background-color-F5F5F5">
									@else
										<div id="outputRecurso {{$loop->index + 1}}" class="site-list-item-div background-color-FFFFFF">
									@endif
											<div class="list-text-4-div">
												<div class="list-label-avant-garde-lite">
													Recurso
												</div>
												<div class="list-biglabel-avant-garde-regular">
													@if (!is_null($recurso->recursoPresentado))
														{{$recurso->getNombreRecurso()}}
													@endif
												</div>
											</div>
											<div class="list-text-4-div">
												<div class="list-label-avant-garde-lite">
													Fecha de Presentación
												</div>
												<div class="list-biglabel-avant-garde-regular">
													{{$recurso->fechaPresentacion}}
												</div>
											</div>
											<div class="list-text-4-div">
												<div class="list-label-avant-garde-lite">
													Fecha de Resultado
												</div>
												<div class="list-biglabel-avant-garde-regular">
													{{$recurso->fechaResultado}}
												</div>
											</div>
											<div class="list-text-4-div">
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

@include('shared.modals')

<script>

	function buscarSecretario() {
		$('#modalRegistrarMensaje').foundation('open');
	}

	function buscarSecretarioLider() {
		$('#modalRegistrarMensaje').foundation('open');
	}

	function buscarDemandante() {
		$('#modalRegistrarMensaje').foundation('open');
	}

	function buscarDemandado() {
		$('#modalRegistrarMensaje').foundation('open');
	}

	function buscarRegion() {
		$('#modalRegistrarMensaje').foundation('open');
	}

	function buscarRecurso() {
		$('#modalRegistrarMensaje').foundation('open');
	}

	$("#btn-registrar-expediente").click(function() {
		var cont = 0;

		if ($('#numero').val()==""){
			cont = cont + 1;
		}

		if ($('#fechaSolicitud').val()==""){
			cont = cont + 1;
		}

		if ($('#estadoExpediente').val()==""){
			cont = cont + 1;
		}

		if ($('#tipoCaso').val()==""){
			cont = cont + 1;
		}

		if ($('#subtipoCaso').val()==""){
			cont = cont + 1;
		}

		if ($('#cuantiaControversiaInicial').val()==""){
			cont = cont + 1;
		} else {
			if (isNaN($('#cuantiaControversiaInicial').val())){
				cont = cont + 1;
			}
		}

		if ($('#cuantiaControversiaFinal').val()!=""){
			if (isNaN($('#cuantiaControversiaFinal').val())){
				cont = cont + 1;
			}
		}

		if ($('#tipoCuantia').val()==""){
			cont = cont + 1;
		}

		if ($('#escalaPago').val()==""){
			cont = cont + 1;
		}

		if ($('#idDemandante').val()==""){
			cont = cont + 1;
		}

		if ($('#demandante').val()==""){
			cont = cont + 1;
		}

		if ($('#idDemandado').val()==""){
			cont = cont + 1;
		}

		if ($('#demandado').val()==""){
			cont = cont + 1;
		}

		if ($('#tipoDemandante').val()==""){
			cont = cont + 1;
		}

		if ($('#tipoDemandado').val()==""){
			cont = cont + 1;
		}

		if ($('#anhoContrato').val()!=""){
			if (isNaN($('#anhoContrato').val())){
				cont = cont + 1;
			}
		}

		if ($('#resultadoEnSoles').val()!=""){
			if (isNaN($('#resultadoEnSoles').val())){
				cont = cont + 1;
			}
		}

		if(cont>0){
			$('#modalFaltanDatos').foundation('open');
		} else{
			$('#modalRegistrarConfirmar').foundation('open');
		}
	});

	$("#btn-registrar").click(function() {
		$('#modalRegistrarConfirmar').foundation('close');
		$('#modalRegistrarMensaje').foundation('open');
		var form = document.getElementById("form-registrar-expediente");
		form.submit()
		$('#modalRegistrarMensaje').foundation('close');
	});

	$(".btn-borrar-region").click(function() {
		var idBorrarRegion = $(this).attr("idBorrarRegion");
		$("#borrarItem").val(idBorrarRegion);
		$('#modalBorrarConfirmar01').foundation('open');
	});

	$("#btn-borrar-01").click(function(){
		$('#modalBorrarConfirmar01').foundation('close');
		$('#modalBorrarMensaje').foundation('open');

		var indexRegion = $("#borrarItem").val();

		var region = document.getElementById('region ' + indexRegion);
		region.parentNode.removeChild(region);
		var outputRegion = document.getElementById('outputRegion ' + indexRegion);
		outputRegion.parentNode.removeChild(outputRegion);

		$('#modalBorrarMensaje').foundation('close');
	});

	$(".btn-borrar-recurso").click(function() {
		var idBorrarRecurso = $(this).attr("idBorrarRecurso");
		$("#borrarItem").val(idBorrarRecurso);
		$('#modalBorrarConfirmar02').foundation('open');
	});

	$("#btn-borrar-02").click(function(){
		$('#modalBorrarConfirmar02').foundation('close');
		$('#modalBorrarMensaje').foundation('open');

		var indexRecurso = $("#borrarItem").val();

		var recursoPresentado = document.getElementById('recursoPresentado ' + indexRecurso);
		recursoPresentado.parentNode.removeChild(recursoPresentado);
		var fechaPresentacion = document.getElementById('fechaPresentacion ' + indexRecurso);
		fechaPresentacion.parentNode.removeChild(fechaPresentacion);
		var resultadoRecursoPresentado = document.getElementById('resultadoRecursoPresentado ' + indexRecurso);
		resultadoRecursoPresentado.parentNode.removeChild(resultadoRecursoPresentado);
		var fechaResultado = document.getElementById('fechaResultado ' + indexRecurso);
		fechaResultado.parentNode.removeChild(fechaResultado);
		var outputRecurso = document.getElementById('outputRecurso ' + indexRecurso);
		outputRecurso.parentNode.removeChild(outputRecurso);

		$('#modalBorrarMensaje').foundation('close');
	});

</script>

@endsection
