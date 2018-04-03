<form method="GET" action="{{ url('expediente/clientelegal/directorio', []) }}">
	{{ csrf_field() }}
	<div class="cell small-12 padding-bottom-20">
		<div class="grid-x grid-margin-x">
			<div class="cell small-4">
				<div class="site-label padding-bottom-5">
					Nombre
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="nombre" name="nombre" @if (!is_null($filtroClienteLegal->nombre)) value="{{$filtroClienteLegal->nombre}}" @endif/>
					</div>
				</div>
			</div>
			<div class="cell small-4">
				<div class="table-2cells-div padding-bottom-5">
					<div class="left-div">
						<div class="site-label">
							DNI
						</div>
					</div>
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="dni" name="dni" @if (!is_null($filtroClienteLegal->dni)) value="{{$filtroClienteLegal->dni}}" @endif/>
					</div>
				</div>
			</div>
			<div class="cell small-4">
				<div class="table-2cells-div padding-bottom-5">
					<div class="left-div">
						<div class="site-label">
							Correo Electrónico
						</div>
					</div>
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="email" name="email" @if (!is_null($filtroClienteLegal->nombre)) value="{{$filtroClienteLegal->email}}" @endif/>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="cell small-12 padding-bottom-20">
		<div class="grid-x grid-margin-x">
			<div class="cell small-4">
				<div class="site-label padding-bottom-5">
					Razon Social
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="razonSocial" name="razonSocial" @if (!is_null($filtroClienteLegal->nombre)) value="{{$filtroClienteLegal->razonSocial}}" @endif/>
					</div>
				</div>
			</div>
			<div class="cell small-4">
				<div class="table-2cells-div padding-bottom-5">
					<div class="left-div">
						<div class="site-label">
							RUC
						</div>
					</div>
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="ruc" name="ruc" @if (!is_null($filtroClienteLegal->nombre)) value="{{$filtroClienteLegal->ruc}}" @endif/>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="cell small-12 padding-bottom-20">
		<div class="grid-x grid-margin-x">
			<div class="cell small-4">
				<div class="table-2cells-div padding-bottom-5">
					<div class="left-div">
						<div class="site-label">
							¿Es Consorcio?
						</div>
					</div>
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<select class="site-select" id="flagConsorcio" name="flagConsorcio">
							<option value="">Seleccione una opción</option>
							<option value="Si" @if ("Si" == $filtroClienteLegal->flagConsorcio) selected @endif >Si</option>
							<option value="No" @if ("No" == $filtroClienteLegal->flagConsorcio) selected @endif >No</option>
						</select>
					</div>
				</div>
			</div>
			<div class="cell small-4">
				<div class="table-2cells-div padding-bottom-5">
					<div class="left-div">
						<div class="site-label">
							Sector
						</div>
					</div>
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<select class="site-select" id="sector" name="sector">
							<option value="">Seleccione una opción</option>
							<option value="PRI" @if ("PRI" == $filtroClienteLegal->sector) selected @endif >Privado</option>
							<option value="PUB" @if ("PUB" == $filtroClienteLegal->sector) selected @endif >Público</option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="cell small-12">
		<button name="accion" value="{{$accion}}" class="site-form-button float-left">
			buscar
		</button>
		<div style="clear:both;"></div>
	</div>
</form>
