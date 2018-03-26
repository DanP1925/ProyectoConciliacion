@extends('layouts.app')

@section('title', 'Directorio de Regiones')

@section('content')
<div class="grid-container">
	<form method="POST" action="{{ url('expediente/region/directorio', []) }}">
		{{ csrf_field() }}
		<div class="grid-x">
			<div class="cell small-12">
				<div class="table-2cells-div padding-top-30 padding-bottom-40">
					<div class="left-div">
						<div class="site-title">
							DIRECTORIO DE REGIONES
						</div>
					</div>
				</div>
			</div>
			<div class="cell small-12 padding-bottom-20">
				<div class="grid-x grid-margin-x">
					<div class="cell small-6">
						<div class="site-label padding-bottom-5">
							Nombre
						</div>
						<div class="site-control">
							<div class="site-control-border">
								<input type="text" class="site-input" id="nombre" name="nombre" />
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
			<div class="cell small-6 padding-bottom-50">
				@foreach ($regiones as $region)
				@if ($tipoAccion == "buscarRegionId")
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
				@endforeach
			</div>
		</div>
	</form>
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
