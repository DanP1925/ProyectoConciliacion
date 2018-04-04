@extends('layouts.app')

@section('content')

<div class="grid-container">
	<div class="site-title-padding">
		<div class="grid-x">
			<div class="cell small-12">
				<div class="table-2cells-div">
					<div class="left-div">
						<div class="site-title">
							DETALLE DE RECURSO
						</div>
					</div>
					<div class="right-div">
						@if ($tipoAccion == "editarRecursoId")
							<form method="GET" action="{{ url('expediente/info', ['id'=>$id]) }}">
						@else
							<form method="GET" action="{{ url('expediente/nuevo', []) }}">
						@endif
								<input type="hidden" name="volver" value="editarRecurso"/>
								<button class="site-title-button float-right">
									Regresar
								</button>
							</form>
						<button id="btn-editar-recurso" type="button" class="site-title-button site-title-button-padding float-right" onclick="retornarDatos()">
							Actualizar
						</button>
						<div style="clear:both;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="site-section-padding">
		@if ($tipoAccion == "editarRecursoId")
			<form id="form-editar-recurso" method="POST" action="{{ url('expediente/info', ['id'=>$id]) }}">
		@else
			<form id="form-editar-recurso" method="POST" action="{{ url('expediente/nuevo', []) }}">
		@endif
				<input type="hidden" id="accion" name="accion" value="{{$accion}}"/>
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
											<option value="{{$recursoPresentado->idLaudoRecurso}}" @if ($recursoPresentado->idLaudoRecurso == $nuevoRecurso->recursoPresentado) selected @endif>{{$recursoPresentado->nombre}}</option>
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
									<input type="date" class="site-input" id="fechaPresentacion" name="fechaPresentacion" @if (!is_null($nuevoRecurso->fechaPresentacion)) value="{{$nuevoRecurso->fechaPresentacion}}" @endif/>
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
											<option value="{{$resultadoRecurso->idLaudoRecursoResultado}}" @if ($resultadoRecurso->idLaudoRecursoResultado == $nuevoRecurso->resultadoRecursoPresentado) selected @endif>{{$resultadoRecurso->nombre}}</option>
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
									<input type="date" class="site-input" id="fechaResultado" name="fechaResultado" @if (!is_null($nuevoRecurso->fechaResultado)) value="{{$nuevoRecurso->fechaResultado}}" @endif/>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
	</div>
</div>


@include('shared.modals')

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
		var form = document.getElementById("form-editar-recurso");
		form.submit()
		$('#modalRegistrarMensaje').foundation('close');
	});

</script>


@endsection
