@extends('layouts.app')

@section('title', 'Directorio de Usuarios')

@section('content')
<div class="grid-container">
    <div class="grid-x">
        <div class="cell small-12">
			<div class="table-2cells-div padding-top-30 padding-bottom-40">
				<div class="left-div">
					<div class="site-title">
						DIRECTORIO
					</div>
				</div>
			</div>
			@include('expediente.usuariolegal.buscar')
			<div class="cell small-12 padding-bottom-50">
				@foreach ($secretarios as $secretario)
					@include('expediente.usuariolegal.elemento')
				@endforeach
			</div>
        </div>

		<div class="small-12 cell">
			<div class="site-section-padding">
				<div class="div-pagination">
					<div class="pagination">
						{{$secretarios->links() }}
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
