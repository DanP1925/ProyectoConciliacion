@if ($tipoAccion == "buscarRegionId")
	<form method="GET" action="{{ url('expediente/info', ['id'=>$id]) }}">
@else
	<form method="GET" action="{{ url('expediente/nuevo', []) }}">
@endif
		{{ csrf_field() }}
		@if ($loop->iteration % 2 == 0)
			<div class="list-edit-div">
		@else
			<div class="list-edit-div" style="background-color:#F5F5F5;">
		@endif
				<div class="list-edit-text-div">
					<div class="list-label-avant-garde-lite">
						Región
					</div>
					<div class="list-biglabel-avant-garde-regular">
						{{$region->nombre}}
					</div>
				</div>
				<button type="submit" name="accion" value="{{$accion}} {{$region->idRegion}}" class="btn-borrar-factura list-edit-icon-div" onclick="retornarDatos()">
					<img src="{{ asset('images/ico_pointer_blue.png') }}" />
				</button>
			</div>
	</form>
