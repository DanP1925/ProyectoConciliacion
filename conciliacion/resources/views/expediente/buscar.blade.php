<form method="GET" action="/expediente/lista">
	{{ csrf_field() }}
	<div class="cell small-12 padding-bottom-20">
		<div class="grid-x grid-margin-x">
			<div class="cell small-4">
				<div class="site-label padding-bottom-5">
					Número Expediente
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="numeroExpediente" name="numeroExpediente" />
					</div>
				</div>
			</div>
			<div class="cell small-4">
				<div class="table-2cells-div padding-bottom-5">
					<div class="left-div">
						<div class="site-label">
							Fecha Inicio de Consulta
						</div>
					</div>
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="date" class="site-input" id="fechaInicio" name="fechaInicio" />
					</div>
				</div>
			</div>
			<div class="cell small-4">
				<div class="table-2cells-div padding-bottom-5">
					<div class="left-div">
						<div class="site-label">
							Fecha Fin de Consulta
						</div>
					</div>
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="date" class="site-input" id="fechaFin" name="fechaFin" />
					</div>
				</div>
			</div>

		</div>
	</div>

	<div class="cell small-12 padding-bottom-20">
		<div class="grid-x grid-margin-x">
			<div class="cell small-4">
				<div class="site-label padding-bottom-5">
					Demandante
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="demandante" name="demandante" />
					</div>
				</div>
			</div>
			<div class="cell small-4">
				<div class="site-label padding-bottom-5">
					Demandado
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="demandado" name="demandado" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="cell small-12 padding-bottom-20">
		<div class="grid-x grid-margin-x">
			<div class="cell small-4">
				<div class="site-label padding-bottom-5">
					Miembro del Consorcio Demandante
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="miembroDemandante" name="miembroDemandante" />
					</div>
				</div>
			</div>
			<div class="cell small-4">
				<div class="site-label padding-bottom-5">
					Miembro del Consorcio Demandado
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="miembroDemandado" name="miembroDemandado" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="cell small-12 padding-bottom-20">
		<div class="grid-x grid-margin-x">
			<div class="cell small-4">
				<div class="site-label padding-bottom-5">
					Secretario Responsable
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="secretarioResponsable" name="secretarioResponsable" />
					</div>
				</div>
			</div>
			<div class="cell small-4">
				<div class="site-label padding-bottom-5">
					Secretario Lider
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="secretarioLider" name="secretarioLider" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="cell small-12 padding-bottom-25">
		<div class="grid-x grid-margin-x">
			<div class="cell small-4">
				<div class="site-label padding-bottom-5">
					Estado de Expediente
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<select class="site-select" id="estado" name="estado">
							<option value="">Seleccione una opción</option>
							@foreach ($estadosExpediente as $estadoExpediente)
							<option value="{{$estadoExpediente->idExpedienteEstado}}">{{$estadoExpediente->nombre}}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>

			<div class="cell small-4">
				<div class="site-label padding-bottom-5">
					Tipo Caso
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<select class="site-select" id="tipoCaso" name="tipoCaso">
							<option value="">Seleccione una opción</option>
							@foreach ($tipos as $tipo)
							<option value="{{$tipo->idExpedienteTipoCaso}}">{{$tipo->nombre}}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
			<div class="cell small-4">
				<div class="site-label padding-bottom-5">
					Subtipo Caso 
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<select class="site-select" id="subtipoCaso" name="subtipoCaso">
							<option value="">Seleccione una opción</option>
							@foreach ($subtipos as $subtipo)
							<option value="{{$subtipo->idExpedienteSubtipoCaso}}">{{$subtipo->nombre}}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="cell small-12 padding-bottom-50">
		<button type="submit" class="site-form-button float-left">
			buscar
		</button>
		<div style="clear:both;"></div>
	</div>
</form>
