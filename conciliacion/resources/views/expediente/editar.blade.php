@extends('layouts.app')

@section('content')

<div class="grid-container">
	<div class="grid-x">
    	<div class="cell small-12">
            <div class="table-2cells-div padding-top-30 padding-bottom-40">
                <div class="left-div">
                    <div class="site-title">
                        EDITAR EXPEDIENTE
                    </div>
                </div>
                <div class="right-div">
                	<a href="{{ url('/expediente/lista',[]) }}">
                        <div class="site-title-button float-right">
                            Actualizar Expediente
                        </div>
                    </a>
                    <div style="clear:both;"></div>
                </div>
            </div>
		</div>
        <div class="cell small-12 padding-bottom-40">
        	<div class="grid-x grid-margin-x">
            	<div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Número Expediente
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
                                Fecha Solicitud
                            </div>
                        </div>
                        <div class="right-div">
                        	<div class="site-label-button float-right">
                                seleccionar
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<input type="text" class="site-input" id="fechaSolicitud" name="fechaSolicitud" />
                    	</div>
                    </div>
                </div>
                <div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Estado Expediente
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<select class="site-select" id="estadoExpediente" name="estadoExpediente">
                            	<option value="">Seleccione una opción</option>
                            </select>
                    	</div>
                    </div>
                </div>
                
          	</div>
        </div>
        
        <div class="cell small-12 padding-bottom-40">
        	<div class="grid-x grid-margin-x">
            	<div class="cell small-12">
                	<div class="site-subtitle padding-bottom-20">
                        TIPO CASO
                    </div>
                </div>
                <div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Primera División
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<select class="site-select" id="tipoCaso01" name="tipoCaso01">
                            	<option value="">Seleccione una opción</option>
                            </select>
                    	</div>
                    </div>
                </div>
    			<div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Segunda División
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<select class="site-select" id="tipoCaso02" name="tipoCaso02">
                            	<option value="">Seleccione una opción</option>
                            </select>
                    	</div>
                    </div>
                </div>
                <div class="cell small-4">
                	&nbsp;
                </div>
                
          	</div>
        </div>
        
        <div class="cell small-12 padding-bottom-40">
        	<div class="grid-x grid-margin-x">
            	<div class="cell small-12">
                	<div class="site-subtitle padding-bottom-20">
                        CUANTÍA
                    </div>
                </div>
                <div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Cuantía Controversia (S/.)
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<input type="text" class="site-input" id="cuantiaControversia" name="cuantiaControversia" />
                    	</div>
                    </div>
                </div>
    			<div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Cuantía Determinada
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<select class="site-select" id="cuantiaDeterminada" name="cuantiaDeterminada">
                            	<option value="">Seleccione una opción</option>
                            </select>
                    	</div>
                    </div>
                </div>
                <div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Tipo Cuantía
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<select class="site-select" id="tipoCuantía" name="tipoCuantía">
                            	<option value="">Seleccione una opción</option>
                            </select>
                    	</div>
                    </div>
                </div>
                
          	</div>
        </div>
        
        <div class="cell small-12 padding-bottom-40">
        	<div class="grid-x grid-margin-x">
            	<div class="cell small-12">
                	<div class="site-subtitle padding-bottom-20">
                        SECRETARÍA
                    </div>
                </div>
                <div class="cell small-4">
                	<div class="table-2cells-div padding-bottom-5">
                    	<div class="left-div">
                            <div class="site-label">
                                Secretario Respons.
                            </div>
                        </div>
                        <div class="right-div">
                        	<div class="site-label-button float-right">
                                buscar
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<input type="text" class="site-input" id="secretarioResponable" name="secretarioResponable" placeholder="Seleccione un personal" />
                    	</div>
                    </div>
                </div>
    			<div class="cell small-4">
                	<div class="table-2cells-div padding-bottom-5">
                    	<div class="left-div">
                            <div class="site-label">
                                Secretario Lider
                            </div>
                        </div>
                        <div class="right-div">
                        	<div class="site-label-button float-right">
                                buscar
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<input type="text" class="site-input" id="secretarioLider" name="secretarioLider" placeholder="Seleccione un personal" />
                    	</div>
                    </div>
                </div>
                <div class="cell small-4">
                	&nbsp;
                </div>
          	</div>
        </div>
        
        <div class="cell small-12 padding-bottom-40">
        	<div class="grid-x grid-margin-x">
            	<div class="cell small-12">
                	<div class="site-subtitle padding-bottom-20">
                        PARTES LEGALES
                    </div>
                </div>
                <div class="cell small-4">
                	<div class="table-2cells-div padding-bottom-5">
                    	<div class="left-div">
                            <div class="site-label">
                                Demandante
                            </div>
                        </div>
                        <div class="right-div">
                        	<div class="site-label-button float-right">
                                buscar
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<input type="text" class="site-input" id="demandante" name="demandante" placeholder="Seleccione un personal" />
                    	</div>
                    </div>
                </div>
    			<div class="cell small-4">
                	<div class="table-2cells-div padding-bottom-5">
                    	<div class="left-div">
                            <div class="site-label">
                                Demandado
                            </div>
                        </div>
                        <div class="right-div">
                        	<div class="site-label-button float-right">
                                buscar
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<input type="text" class="site-input" id="demandado" name="demandado" placeholder="Seleccione un personal" />
                    	</div>
                    </div>
                </div>
                <div class="cell small-4">
                	&nbsp;
                </div>
          	</div>
        </div>
        
        <div class="cell small-12 padding-bottom-40">
        	<div class="grid-x grid-margin-x">
            	<div class="cell small-12">
                	<div class="site-subtitle padding-bottom-20">
                        ARBITRAJE
                    </div>
                </div>
                <div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Origen Arbitraje
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<select class="site-select" id="origenArbitraje" name="origenArbitraje">
                            	<option value="">Seleccione una opción</option>
                            </select>
                    	</div>
                    </div>
                </div>
    			<div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Monto del Contrato (S/.)
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<select class="site-select" id="montoContrato" name="montoContrato">
                            	<option value="">Seleccione una opción</option>
                            </select>
                    	</div>
                    </div>
                </div>
                <div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Año del Contrato
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<input type="text" class="site-input" id="añoContrato" name="añoContrato" />
                    	</div>
                    </div>
                </div>
          	</div>
        </div>
        
        <div class="font-avandgarde-bold padding-top-50 padding-bottom-50">
        	(( ... continúan más contenidos ))
        </div>
        
    </div>
</div>
@endsection
