@extends('layouts.app')

@section('title', 'Expedientes')

@section('content')

<div class="grid-container">
	<div class="grid-x">
    	<div class="cell small-12">
            <div class="table-2cells-div padding-top-30 padding-bottom-40">
                <div class="left-div">
                    <div class="site-title">
                        EXPEDIENTES
                    </div>
                </div>
                <div class="right-div">
                	<a href="{{ url('/expediente/nuevo',[]) }}">
                        <div class="site-title-button float-right">
                            Nuevo Expediente
                        </div>
                    </a>
                    <div style="clear:both;"></div>
                </div>
            </div>
		</div>
        <div class="cell small-12 padding-bottom-20">
        	<div class="grid-x grid-margin-x">
            	<div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Número Expediente
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<input type="text" class="site-input" id="numeroExpediente" name="numeroExpediente" />
                    	</div>
                    </div>
                </div>
    			<div class="cell small-4">
                	<div class="table-2cells-div padding-bottom-5">
                    	<div class="left-div">
                            <div class="site-label">
                                Fecha Inicio de Consulta
                            </div>
                        </div>
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<input type="text" class="site-input" id="fechaInicio" name="fechaInicio" />
                    	</div>
                    </div>
                </div>
                <div class="cell small-4">
                	<div class="table-2cells-div padding-bottom-5">
                    	<div class="left-div">
                            <div class="site-label">
                                Fecha Fin de Consulta
                            </div>
                        </div>
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<input type="text" class="site-input" id="fechaFin" name="fechaFin" />
                    	</div>
                    </div>
                </div>
                
          	</div>
        </div>
        
        <div class="cell small-12 padding-bottom-20">
        	<div class="grid-x grid-margin-x">
            	<div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Demandante
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<input type="text" class="site-input" id="demandante" name="demandante" />
                    	</div>
                    </div>
                </div>
    			<div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Demandado
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<input type="text" class="site-input" id="demandado" name="demandado" />
                    	</div>
                    </div>
                </div>
          	</div>
        </div>
        <div class="cell small-12 padding-bottom-20">
        	<div class="grid-x grid-margin-x">
            	<div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Miembro del Consorcio Demandante
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<input type="text" class="site-input" id="miembroDemandante" name="miembroDemandante" />
                    	</div>
                    </div>
                </div>
    			<div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Miembro del Consorcio Demandado
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<input type="text" class="site-input" id="miembroDemandado" name="miembroDemandado" />
                    	</div>
                    </div>
                </div>
          	</div>
        </div>
        <div class="cell small-12 padding-bottom-20">
        	<div class="grid-x grid-margin-x">
            	<div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Secretario Responsable
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<input type="text" class="site-input" id="secretarioResponsable" name="secretarioResponsable" />
                    	</div>
                    </div>
                </div>
    			<div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Secretario Lider
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<input type="text" class="site-input" id="secretarioLider" name="secretarioLider" />
                    	</div>
                    </div>
                </div>
          	</div>
        </div>
        <div class="cell small-12 padding-bottom-25">
        	<div class="grid-x grid-margin-x">
            	<div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Estado de Expediente
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<select class="site-select" id="estado" name="estado">
                            	<option value="">Seleccione una opción</option>
								@foreach ($estadosExpediente as $estadoExpediente)
								<option value="{{$estadoExpediente->idExpedienteEstado}}">{{$estadoExpediente->nombre}}</option>
								@endforeach
                            </select>
                    	</div>
                    </div>
                </div>
                
                <div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Tipo Caso
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                        	<select class="site-select" id="tipoCaso" name="tipoCaso">
                            	<option value="">Seleccione una opción</option>
								@foreach ($tipos as $tipo)
								<option value="{{$tipo->idExpedienteTipoCaso}}">{{$tipo->nombre}}</option>
								@endforeach
                            </select>
                       </div>
                    </div>
                </div>
                <div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Subtipo Caso 
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<select class="site-select" id="subtipoCaso" name="subtipoCaso">
                            	<option value="">Seleccione una opción</option>
								@foreach ($subtipos as $subtipo)
								<option value="{{$subtipo->idExpedienteSubtipoCaso}}">{{$subtipo->nombre}}</option>
								@endforeach
                            </select>
                    	</div>
                    </div>
                </div>
          	</div>
        </div>
        
        <div class="cell small-12 padding-bottom-50">
        	<div class="site-form-button float-left">
            	buscar
            </div>
            <div style="clear:both;"></div>
        </div>
        
        <div class="cell small-12 padding-bottom-50">
			@foreach ($expedientes as $expediente)
			@if ($loop->index % 2 == 0)
            <div class="site-list-item-div background-color-F5F5F5">
			@else
            <div class="site-list-item-div background-color-FFFFFF">
			@endif
				<div class="table-3cells-div">
					<div class="left-div">
						<div class="site-list-item-expediente-fecha padding-bottom-3">
							{{$expediente->getFecha()}}
						</div>
						<div class="site-list-item-expediente-numero padding-bottom-3">
							{{$expediente->numeroExpediente}}
						</div>
						<div class="site-list-item-label">
							Tipo caso:
						</div>
						<div class="site-list-item-label">
							<span class="font-avantgarde-regular">{{$expediente->getTipoCaso()}} / {{$expediente->getSubtipoCaso()}}</span>
						</div>
					</div>
					<div class="middle-div">
						<div class="site-list-item-label padding-bottom-3">
							Secretario Responsable
						</div>
						<div class="site-list-item-text padding-bottom-5">
							{{$expediente->getSecretarioResponsable()}}
						</div>
						<div class="site-list-item-label padding-bottom-3">
							Secretario Lider
						</div>
						<div class="site-list-item-text">
							{{$expediente->getSecretarioLider()}}
						</div>
					</div>
					<div class="right-div">
						<div class="site-list-item-label padding-bottom-3">
							Demandante
						</div>
						<div class="site-list-item-text padding-bottom-5">
							{{$expediente->getDemandante()}}
						</div>
						<div class="site-list-item-label padding-bottom-3">
							Demandado
						</div>
						<div class="site-list-item-text">
							{{$expediente->getDemandado()}}
						</div>
					</div>
				</div>
			</div>
			@endforeach
        </div>
        
    </div>
</div>
@endsection
