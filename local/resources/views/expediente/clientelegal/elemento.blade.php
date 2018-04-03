@if ($tipoAccion == "buscarDemandanteId" || $tipoAccion == "buscarDemandadoId")
	<form method="GET" action="{{ url('expediente/info', ['id'=>$id]) }}">
@else
	<form method="GET" action="{{ url('expediente/nuevo', []) }}">
@endif
		{{ csrf_field() }}
		@if($loop->iteration % 2 == 0)
			<div class="list-div">
		@else
			<div class="list-div" style="background-color:#F5F5F5;">
		@endif
				<div class="list-text-4-div">
					<div class="list-label-avant-garde-lite">
						Nombre/Razon Social
					</div>
					<div class="list-biglabel-avant-garde-regular">
						@if ($cliente->flgTipoPersona == "J")
							{{$cliente->getPersonaJuridica()->razonSocial}}
						@else
							{{$cliente->getPersonaNatural()->apellidoPaterno}} {{$cliente->getPersonaNatural()->apellidoMaterno}}, {{$cliente->getPersonaNatural()->nombre}}
						@endif
					</div>
					<div class="list-sublabel-avant-garde-regular">
						Consorcio: <strong>{{ $cliente->getConsorcioPersona()->nombre }}</strong>
					</div>
				</div>
				<div class="list-text-4-div">
					<div class="list-label-avant-garde-lite">
						Representante
					</div>
					<div class="list-biglabel-avant-garde-regular">
						{{$cliente->getRepresentanteLegal()->apellidoPaterno}} {{$cliente->getRepresentanteLegal()->apellidoMaterno}}, {{$cliente->getRepresentanteLegal()->nombre}}
					</div>
				</div>
				<div class="list-text-4-div">
					<div class="list-label-avant-garde-lite">
						Teléfono
					</div>
					<div class="list-biglabel-avant-garde-regular">
						{{$cliente->getRepresentanteLegal()->telefono}}
					</div>
				</div>
				<div class="list-text-4-div">
					<div class="list-label-avant-garde-lite">
						Correo Electrónico
					</div>
					<div class="list-biglabel-avant-garde-regular">
						{{$cliente->emailClienteLegal}}
					</div>
				</div>
				<div class="list-icon-div">
					<button type="submit" name="accion" value="{{$accion}} {{$cliente->idExpedienteClienteLegal}}" onclick="retornarDatos()" style="cursor:pointer;">
						<img src="{{ asset('images/ico_pointer_blue.png') }}" />
					</button>
				</div>
			</div>
</form>
