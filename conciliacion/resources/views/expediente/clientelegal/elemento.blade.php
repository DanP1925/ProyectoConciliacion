@if ($tipoAccion == "buscarDemandanteId" || $tipoAccion == "buscarDemandadoId")
<form method="GET" action="{{ url('expediente/info', ['id'=>$id]) }}">
@else
<form method="GET" action="{{ url('expediente/nuevo', []) }}">
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
