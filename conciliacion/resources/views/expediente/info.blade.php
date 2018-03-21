@extends('layouts.app')

@section('title', 'Detalle  Expediente')

@section('content')

<div class="grid-container">
	<div class="grid-x">
    	<div class="cell small-12">
            <div class="table-2cells-div padding-top-30 padding-bottom-40">
                <div class="left-div">
                    <div class="site-title">
                        DETALLE EXPEDIENTE
                    </div>
                </div>
                <div class="right-div">
					<button type="submit" class="site-title-button float-right">
						Editar Expediente
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
							<input type="text" class="site-input" id="numeroExpediente" name="numeroExpediente"/>
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
							<input type="date" class="site-input" id="fechaSolicitud" name="fechaSolicitud"/>
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
							<input type="text" class="site-input" id="numeroExpedienteAsociado" name="numeroExpedienteAsociado"/>
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
							<input type="text" class="site-input" id="cuantiaControversiaInicial" name="cuantiaControversiaInicial"/>
						</div>
					</div>
				</div>
				<div class="cell small-4">
					<div class="site-label padding-bottom-5">
						Cuantía Controversia Final (S/.)
					</div>
					<div class="site-control">
						<div class="site-control-border">
							<input type="text" class="site-input" id="cuantiaControversiaFinal" name="cuantiaControversiaFinal"/>
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
							<button type="submit" class="site-label-button float-right">
								<div class="site-label-button float-right">
									buscar
								</div>
							</button>
							<div style="clear:both;"></div>
						</div>
					</div>
					<div class="site-control">
						<div class="site-control-border">
							<input type="text" class="site-input" id="secretarioResponable" name="secretarioResponsable" placeholder="Seleccione un personal"/>
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
							<button  class="site-label-button float-right">
								buscar
							</button>
							<div style="clear:both;"></div>
						</div>
					</div>
					<div class="site-control">
						<div class="site-control-border">
							<input type="text" class="site-input" id="secretarioLider" name="secretarioLider" placeholder="Seleccione un personal"/>
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
							<button class="site-label-button float-right">
								buscar
							</button>
							<div style="clear:both;"></div>
						</div>
					</div>
					<div class="site-control">
						<div class="site-control-border">
							<input type="text" class="site-input" id="demandante" name="demandante"/>
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
							<button type="submit" class="site-label-button float-right">
								buscar
							</button>
							<div style="clear:both;"></div>
						</div>
					</div>
					<div class="site-control">
						<div class="site-control-border">
							<input type="text" class="site-input" id="demandado" name="demandado"/>
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
							<input type="text" class="site-input" id="anhoContrato" name="anhoContrato"/>
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
							<button class="site-label-button float-right">
								AGREGAR REGIONES
							</button>
							<div style="clear:both;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="cell small-9 padding-bottom-50">
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
							<input type="text" class="site-input" id="arbitroUnico" name="arbitroUnico"/>
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
							<input type="text" class="site-input" id="presidenteTribunal" name="presidenteTribunal"/>
						</div>
					</div>
				</div>
				<div class="cell small-4">
					<div class="site-label padding-bottom-5">
						Arbitro Demandante
					</div>
					<div class="site-control">
						<div class="site-control-border">
							<input type="text" class="site-input" id="arbitroDemandante" name="arbitroDemandante"/>
						</div>
					</div>
				</div>
				<div class="cell small-4">
					<div class="site-label padding-bottom-5">
						Arbitro Demandado
					</div>
					<div class="site-control">
						<div class="site-control-border">
							<input type="text" class="site-input" id="arbitroDemandado" name="arbitroDemandado"/>
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
							<input type="date" class="site-input" id="fechaLaudo" name="fechaLaudo"/>
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
							<input type="text" class="site-input" id="resultadoEnSoles" name="resultadoEnSoles"/>
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
							<button class="site-label-button float-right">
								AGREGAR RECURSOS
							</button>
							<div style="clear:both;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="cell small-12 padding-bottom-50">
        </div>
    </div>
</div>
@endsection
