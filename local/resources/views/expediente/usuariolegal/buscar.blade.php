<form method="GET" action="{{ url('expediente/usuariolegal/directorio', []) }}">
	{{ csrf_field() }}
	<div class="cell small-12 padding-bottom-20">
		<div class="grid-x grid-margin-x">
			<div class="cell small-4">
				<div class="site-label padding-bottom-5">
					Nombre
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="nombre" name="nombre" />
					</div>
				</div>
			</div>
			<div class="cell small-4">
				<div class="table-2cells-div padding-bottom-5">
					<div class="left-div">
						<div class="site-label">
							Apellido Paterno
						</div>
					</div>
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="apellidoPaterno" name="apellidoPaterno" />
					</div>
				</div>
			</div>
			<div class="cell small-4">
				<div class="table-2cells-div padding-bottom-5">
					<div class="left-div">
						<div class="site-label">
							Apellido Materno
						</div>
					</div>
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="apellidoMaterno" name="apellidoMaterno" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="cell small-12 padding-bottom-20">
		<div class="grid-x grid-margin-x">
			<div class="cell small-4">
				<div class="site-label padding-bottom-5">
					Profesión
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<select class="site-select" id="profesion" name="profesion">
							<option value="">Seleccione una opción</option>
							@foreach ($profesiones as $profesion)
							<option value="{{$profesion->idUsuarioLegalProfesion}}">{{$profesion->nombre}}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
			<div class="cell small-4">
				<div class="table-2cells-div padding-bottom-5">
					<div class="left-div">
						<div class="site-label">
							País
						</div>
					</div>
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<select class="site-select" id="pais" name="pais">
							<option value="">Seleccione una opción</option>
							@foreach ($paises as $pais)
							<option value="{{$pais->idUsuarioLegalPais}}">{{$pais->nombre}}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
			<div class="cell small-4">
				<div class="table-2cells-div padding-bottom-5">
					<div class="left-div">
						<div class="site-label">
							Perfil
						</div>
					</div>
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<select class="site-select" id="perfil" name="perfil">
							<option value="">Seleccione una opción</option>
							@foreach ($perfiles as $perfil)
							<option value="{{$perfil->idUsuarioLegalTipo}}">{{$perfil->nombre}}</option>
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
					Teléfono
				</div>
				<div class="site-control">
					<div class="site-control-border">
						<input type="text" class="site-input" id="telefono" name="telefono" />
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
						<input type="text" class="site-input" id="correo" name="correo" />
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
