@extends('layouts.app')

@section('content')

<div class="grid-container">
	<div class="site-title-padding">
		<div class="grid-x">
			<div class="cell small-12">
				<div class="table-2cells-div">
					<div class="left-div">
						<div class="site-title">
							BUSCAR CLIENTES
						</div>
					</div>
					<div class="right-div">
					@if ($tipoAccion == "buscarDemandanteId" || $tipoAccion == "buscarDemandadoId")
							<form method="GET" action="{{ url('expediente/info', ['id'=>$id]) }}">
						@else
							<form method="GET" action="{{ url('expediente/nuevo', []) }}">
						@endif
								<input type="hidden" name="volver" value="clienteLegal"/>
								<button class="site-title-button float-right">
									Regresar
								</button>
							</form>
							<div style="clear:both;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="site-section-padding">
		@include('expediente.clientelegal.buscar')
	</div>
	<div class="site-section-padding">
		<div class="grid-x">
			@foreach ($clientes as $cliente)
				<div class="small-12 cell">
					@include('expediente.clientelegal.elemento')
				</div>
			@endforeach
		</div>
	</div>
	<div class="site-section-padding">
		<div class="grid-x">
			<div class="small-12 cell">
				<div class="div-pagination">
					{{ $clientes->links() }}
				</div>
			</div>
		</div>
	</div>
</div>

@include('shared.modals')

<script>

	function retornarDatos() {
		$('#modalRegistrarMensaje').foundation('open');
	}

</script>

@endsection
