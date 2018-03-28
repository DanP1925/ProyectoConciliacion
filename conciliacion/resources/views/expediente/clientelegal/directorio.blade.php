@extends('layouts.app')

@section('title', 'Directorio de Clientes')

@section('content')
<div class="grid-container">
	<div class="grid-x">
		<div class="cell small-12">
			<form method="POST" action="{{ url('expediente/clientelegal/directorio', []) }}">
				{{ csrf_field() }}
				<div class="table-2cells-div padding-top-30 padding-bottom-40">
					<div class="left-div">
						<div class="site-title">
							DIRECTORIO DE CLIENTES
						</div>
					</div>
				</div>
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
										DNI
									</div>
								</div>
							</div>
							<div class="site-control">
								<div class="site-control-border">
									<input type="text" class="site-input" id="dni" name="dni" />
								</div>
							</div>
						</div>
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
									<input type="text" class="site-input" id="razonSocial" name="razonSocial" />
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
									<input type="text" class="site-input" id="ruc" name="ruc" />
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
									<input type="text" class="site-input" id="email" name="email" />
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
										<option value="Si">Si</option>
										<option value="No">No</option>
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
										<option value="PRI">Privado</option>
										<option value="PUB">Público</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="cell small-12 padding-bottom-50">
					<button name="accion" value="{{$accion}}" class="site-form-button float-left">
						buscar
					</button>
					<div style="clear:both;"></div>
				</div>
			</form>
			<div class="cell small-12 padding-bottom-50">
				@foreach ($clientes as $cliente)
				@if ($tipoAccion == "buscarDemandanteId" || $tipoAccion == "buscarDemandadoId")
				<form method="POST" action="{{ url('expediente/info', ['id'=>$id]) }}">
				@else
				<form method="POST" action="{{ url('expediente/nuevo', []) }}">
				@endif
					{{ csrf_field() }}
					@if ($loop->index % 2 == 0)
					<div class="site-list-item-div background-color-F5F5F5">
						@else 
						<div class="site-list-item-div background-color-FFFFFF">
							@endif
							<div class="grid-x grid-margin-x">
								<div class="cell small-2">
									<div class="site-list-item-label padding-bottom-3">
										Nombre/Razon Social
									</div>
									<div class="site-list-item-text">
										@if ($cliente->flgTipoPersona == "J")
										{{$cliente->getPersonaJuridica()->razonSocial}}
										@else
										{{$cliente->getPersonaNatural()->nombre}} {{$cliente->getPersonaNatural()->apellidoPaterno}} {{$cliente->getPersonaNatural()->apellidoMaterno}}
										@endif
									</div>
								</div>
								<div class="cell small-2">
									<div class="site-list-item-label padding-bottom-3">
										Nombre Representante
									</div>
									<div class="site-list-item-text">
										{{$cliente->getRepresentanteLegal()->nombre}} {{$cliente->getRepresentanteLegal()->apellidoPaterno}} {{$cliente->getRepresentanteLegal()->apellidoMaterno}}
									</div>
								</div>
								<div class="cell small-2">
									<div class="site-list-item-label padding-bottom-3">
										Nombre Consorcio
									</div>
									<div class="site-list-item-text">
										{{$cliente->getConsorcioPersona()->nombre}}
									</div>
								</div>
								<div class="cell small-2">
									<div class="site-list-item-label padding-bottom-3">
										Teléfono
									</div>
									<div class="site-list-item-text">
										{{$cliente->getRepresentanteLegal()->telefono}}
									</div>
								</div>
								<div class="cell small-3">
									<div class="site-list-item-label padding-bottom-3">
										Correo Electrónico
									</div>
									<div class="site-list-item-text">
										{{$cliente->emailClienteLegal}}
									</div>
								</div>
								<div class="cell small-1">
									<button type="submit" name="accion" value="{{$accion}} {{$cliente->idExpedienteClienteLegal}}" class="btn-borrar-factura list-edit-icon-div" onclick="retornarDatos()">
										<img src="{{ asset('images/ico_pointer_blue.png') }}" />
									</button>
								</div>
							</div>
						</div>
				</form>
				@endforeach
					</div>
			</div>
		</div>
	</div>
</div>

@include('shared.modals')

@endsection

@section ('scripts')
<script>

function retornarDatos() {
	$('#modalRegistrarMensaje').foundation('open');
}

</script>
@endsection
