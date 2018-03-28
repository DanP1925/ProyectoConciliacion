@extends('layouts.app')

@section('title', 'Nuevo Recurso')

@section('content')
<div class="grid-container">
	<div class="grid-x">
		<div class="cell small-12">
			<div class="table-2cells-div padding-top-30 padding-bottom-40">
				<div class="left-div">
					<div class="site-title">
						NUEVO RECURSO
					</div>
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
			@if ($tipoAccion == "agregarRecursoId")
			<form id="form-registrar-recurso" method="POST" action="{{ url('expediente/info', ['id'=>$id]) }}">
			@else
			<form id="form-registrar-recurso" method="POST" action="{{ url('expediente/nuevo', []) }}">
			@endif
			{{ csrf_field() }}
				<div class="cell small-12 padding-bottom-20">
					<div class="grid-x grid-margin-x">
						<div class="cell small-4">
							<div class="site-label padding-bottom-5">
								Recurso Presentado
							</div>
							<div class="site-control">
								<div class="site-control-border">
									<select class="site-select" id="recursoPresentado" name="recursoPresentado">
										<option value="">Seleccione una opción</option>
										@foreach ($recursosPresentados as $recursoPresentado)
										<option value="{{$recursoPresentado->idLaudoRecurso}}">{{$recursoPresentado->nombre}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="cell small-4">
							<div class="table-2cells-div padding-bottom-5">
								<div class="left-div">
									<div class="site-label">
										Fecha Presentacion
									</div>
								</div>
							</div>
							<div class="site-control">
								<div class="site-control-border">
									<input type="date" class="site-input" id="fechaPresentacion" name="fechaPresentacion" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="cell small-12 padding-bottom-20">
					<div class="grid-x grid-margin-x">
						<div class="cell small-4">
							<div class="site-label padding-bottom-5">
								Resultado Recurso Presentado
							</div>
							<div class="site-control">
								<div class="site-control-border">
									<select class="site-select" id="resultadoRecursoPresentado" name="resultadoRecursoPresentado">
										<option value="">Seleccione una opción</option>
										@foreach ($resultadoRecursos as $resultadoRecurso)
										<option value="{{$resultadoRecurso->idLaudoRecursoResultado}}">{{$resultadoRecurso->nombre}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="cell small-4">
							<div class="table-2cells-div padding-bottom-5">
								<div class="left-div">
									<div class="site-label">
										Fecha Resultado
									</div>
								</div>
							</div>
							<div class="site-control">
								<div class="site-control-border">
									<input type="date" class="site-input" id="fechaResultado" name="fechaResultado" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="cell small-12 padding-bottom-50">
					<input type="hidden" id="accion" name="accion" value="{{$accion}}"/>
					<button id="btn-registrar-recurso" type="button" class="site-form-button float-left" onclick="retornarDatos()">
						registrar
					</button>
					<div style="clear:both;"></div>
				</div>
			</form>
		</div>
	</div>
</div>

@include('shared.modals')

@endsection

@section ('scripts')
<script>

function retornarDatos() {
	var cont = 0;

	if($('#recursoPresentado').val()==""){
		cont = cont + 1;
	}

	if($('#fechaPresentacion').val()==""){
		cont = cont + 1;
	}

	if(cont>0){
		$('#modalFaltanDatos').foundation('open');
	} else{
		$('#modalRegistrarConfirmar').foundation('open');
	}
}

$("#btn-registrar").click(function() {
	$('#modalRegistrarConfirmar').foundation('close');
	$('#modalRegistrarMensaje').foundation('open');
	var form = document.getElementById("form-registrar-recurso");
	form.submit()
	$('#modalRegistrarMensaje').foundation('close');
});

</script>
@endsection
