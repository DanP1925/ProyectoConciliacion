@extends('layouts.app')

@section('title', 'Directorio de Clientes')

@section('content')
<div class="grid-container">
	<div class="grid-x">
		<div class="cell small-12">
			<div class="table-2cells-div padding-top-30 padding-bottom-40">
				<div class="left-div">
					<div class="site-title">
						DIRECTORIO DE CLIENTES
					</div>
				</div>
				<div class="right-div">
					@if ($tipoAccion == "buscarSecretarioId" || $tipoAccion == "buscarLiderId")
					<form method="GET" action="{{ url('expediente/info', ['id'=>$id]) }}">
					@else
					<form method="GET" action="{{ url('expediente/nuevo', []) }}">
					@endif
						<button class="site-title-button float-right">
							Regresar
						</button>
					</form>
					<div style="clear:both;"></div>
				</div>
			</div>

			@include('expediente.clientelegal.buscar')

			<div class="cell small-12 padding-bottom-50">
				@foreach ($clientes as $cliente)
					@include('expediente.clientelegal.elemento')
				@endforeach
			</div>
		</div>

		<div class="small-12 cell">
			<div class="site-section-padding">
				<div class="div-pagination">
					<div class="pagination">
						{{$clientes->links() }}
					</div>
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
