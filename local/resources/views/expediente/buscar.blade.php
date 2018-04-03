<form method="GET" action="{{ url('expediente/lista', []) }}">
	{{ csrf_field() }}
	<div class="cell small-12 padding-bottom-20">
		<div class="grid-x grid-margin-x">
			<div class="cell small-4">
				<div class="site-label padding-bottom-5">
					Número Expediente
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="numeroExpediente" name="numeroExpediente" @if (!is_null($filtroExpediente->numeroExpediente)) value="{{$filtroExpediente->numeroExpediente}}" @endif/>
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
						<input type="date" class="site-input" id="fechaInicio" name="fechaInicio" @if (!is_null($filtroExpediente->fechaInicio)) value="{{$filtroExpediente->fechaInicio}}" @endif/>
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
						<input type="date" class="site-input" id="fechaFin" name="fechaFin" @if (!is_null($filtroExpediente->fechaFin)) value="{{$filtroExpediente->fechaFin}}" @endif/>
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
						<input type="text" class="site-input" id="demandante" name="demandante" @if (!is_null($filtroExpediente->demandante)) value="{{$filtroExpediente->demandante}}" @endif/>
					</div>
				</div>
			</div>
			<div class="cell small-4">
				<div class="site-label padding-bottom-5">
					Demandado
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="demandado" name="demandado" @if (!is_null($filtroExpediente->demandado)) value="{{$filtroExpediente->demandado}}" @endif/>
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
						<input type="text" class="site-input" id="miembroDemandante" name="miembroDemandante" @if (!is_null($filtroExpediente->miembroDemandante)) value="{{$filtroExpediente->miembroDemandante}}" @endif/>
					</div>
				</div>
			</div>
			<div class="cell small-4">
				<div class="site-label padding-bottom-5">
					Miembro del Consorcio Demandado
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="miembroDemandado" name="miembroDemandado" @if (!is_null($filtroExpediente->miembroDemandado)) value="{{$filtroExpediente->miembroDemandado}}" @endif/>
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
						<input type="text" class="site-input" id="secretarioResponsable" name="secretarioResponsable" @if (!is_null($filtroExpediente->secretarioResponsable)) value="{{$filtroExpediente->secretarioResponsable}}" @endif/>
					</div>
				</div>
			</div>
			<div class="cell small-4">
				<div class="site-label padding-bottom-5">
					Secretario Lider
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="secretarioLider" name="secretarioLider" @if (!is_null($filtroExpediente->secretarioLider)) value="{{$filtroExpediente->secretarioLider}}" @endif/>
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
							<option value="{{$estadoExpediente->idExpedienteEstado}}" @if ($estadoExpediente->idExpedienteEstado == $filtroExpediente->estado) selected @endif>{{$estadoExpediente->nombre}}</option>
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
							<option value="{{$tipo->idExpedienteTipoCaso}}" @if ($tipo->idExpedienteTipoCaso == $filtroExpediente->tipoCaso) selected @endif>{{$tipo->nombre}}</option>
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
							<option value="{{$subtipo->idExpedienteSubtipoCaso}}" @if ($subtipo->idExpedienteSubtipoCaso == $filtroExpediente->subtipoCaso) selected @endif>{{$subtipo->nombre}}</option>
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
