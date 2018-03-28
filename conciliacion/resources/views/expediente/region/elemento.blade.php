@if ($tipoAccion == "buscarRegionId")
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
			<div class="cell small-10">
				<div class="site-list-item-label padding-bottom-3">
					Nombre
				</div>
				<div class="site-list-item-text">
					{{$region->nombre}}
				</div>
			</div>
			<div class="cell small-1">
				<button type="submit" name="accion" value="{{$accion}} {{$region->idRegion}}" class="btn-borrar-factura list-edit-icon-div" onclick="retornarDatos()">
					<img src="{{ asset('images/ico_pointer_blue.png') }}" />
				</button>
			</div>
		</div>
	</div>
</form>
