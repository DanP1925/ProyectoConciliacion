@extends('layouts.app')

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
                    		<input type="text" class="site-input" id="fechaInicio" name="fechaInicio" />
                    	</div>
                    </div>
                </div>
    			<div class="cell small-4">
                	<div class="table-2cells-div padding-bottom-5">
                    	<div class="left-div">
                            <div class="site-label">
                                Fecha Inicio
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
                    		<input type="text" class="site-input" id="fechaInicio" name="fechaInicio" />
                    	</div>
                    </div>
                </div>
                <div class="cell small-4">
                	<div class="table-2cells-div padding-bottom-5">
                    	<div class="left-div">
                            <div class="site-label">
                                Fecha Fin
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
                    		<input type="text" class="site-input" id="fechaInicio" name="fechaInicio" />
                    	</div>
                    </div>
                </div>
    			<div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Demandado
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<input type="text" class="site-input" id="fechaInicio" name="fechaInicio" />
                    	</div>
                    </div>
                </div>
                <div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Secretario Responsable
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<input type="text" class="site-input" id="fechaInicio" name="fechaInicio" />
                    	</div>
                    </div>
                </div>
          	</div>
        </div>
        
        <div class="cell small-12 padding-bottom-25">
        	<div class="grid-x grid-margin-x">
            	<div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Secretario Líder
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<input type="text" class="site-input" id="fechaInicio" name="fechaInicio" />
                    	</div>
                    </div>
                </div>
                
                <div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Tipo Caso / Primera División
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
                        Tipo Caso / Segunda División
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		<select class="site-select" id="tipoCaso02" name="tipoCaso02">
                            	<option value="">Seleccione una opción</option>
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
        	<div class="site-list-item-div background-color-F5F5F5">
            	<a href="{{ url('/expediente/info',['idExpediente' => 'codigo']) }}">
                    <div class="table-3cells-div">
                        <div class="left-div">
                            <div class="site-list-item-expediente-fecha padding-bottom-3">
                                08/05/2016
                            </div>
                            <div class="site-list-item-expediente-numero padding-bottom-3">
                                1194-256-16
                            </div>
                            <div class="site-list-item-label">
                                Tipo caso:
                            </div>
                            <div class="site-list-item-label">
                                <span class="font-avantgarde-regular">Nombre Tipo caso / Subdivisión caso</span>
                            </div>
                        </div>
                        <div class="middle-div">
                            <div class="site-list-item-label padding-bottom-3">
                                Secretario Responsable
                            </div>
                            <div class="site-list-item-text padding-bottom-5">
                                Nombre Secretario Responsable
                            </div>
                            <div class="site-list-item-label padding-bottom-3">
                                Secretario Lider
                            </div>
                            <div class="site-list-item-text">
                                Nombre Secretario Lider
                            </div>
                        </div>
                        <div class="right-div">
                            <div class="site-list-item-label padding-bottom-3">
                                Demandante
                            </div>
                            <div class="site-list-item-text padding-bottom-5">
                                Nombre Demandante
                            </div>
                            <div class="site-list-item-label padding-bottom-3">
                                Demandado
                            </div>
                            <div class="site-list-item-text">
                                Nombre Demandado
                            </div>
                        </div>
                    </div>
            	</a>
            </div>
            
            <a href="{{ url('/expediente/info',['idExpediente' => 'codigo']) }}">
            <div class="site-list-item-div background-color-FFFFFF">
                <div class="table-3cells-div">
                    <div class="left-div">
                        <div class="site-list-item-expediente-fecha padding-bottom-3">
                            08/05/2016
                        </div>
                        <div class="site-list-item-expediente-numero padding-bottom-3">
                            1194-256-16
                        </div>
                        <div class="site-list-item-label">
                            Tipo caso:
                        </div>
                        <div class="site-list-item-label">
                            <span class="font-avantgarde-regular">Nombre Tipo caso / Subdivisión caso</span>
                        </div>
                    </div>
                    <div class="middle-div">
                        <div class="site-list-item-label padding-bottom-3">
                            Secretario Responsable
                        </div>
                        <div class="site-list-item-text padding-bottom-5">
                            Nombre Secretario Responsable
                        </div>
                        <div class="site-list-item-label padding-bottom-3">
                            Secretario Lider
                        </div>
                        <div class="site-list-item-text">
                            Nombre Secretario Lider
                        </div>
                    </div>
                    <div class="right-div">
                        <div class="site-list-item-label padding-bottom-3">
                            Demandante
                        </div>
                        <div class="site-list-item-text padding-bottom-5">
                            Nombre Demandante
                        </div>
                        <div class="site-list-item-label padding-bottom-3">
                            Demandado
                        </div>
                        <div class="site-list-item-text">
                            Nombre Demandado
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="site-list-item-div background-color-F5F5F5">
            	<a href="{{ url('/expediente/info',['idExpediente' => 'codigo']) }}">
                    <div class="table-3cells-div">
                        <div class="left-div">
                            <div class="site-list-item-expediente-fecha padding-bottom-3">
                                08/05/2016
                            </div>
                            <div class="site-list-item-expediente-numero padding-bottom-3">
                                1194-256-16
                            </div>
                            <div class="site-list-item-label">
                                Tipo caso:
                            </div>
                            <div class="site-list-item-label">
                                <span class="font-avantgarde-regular">Nombre Tipo caso / Subdivisión caso</span>
                            </div>
                        </div>
                        <div class="middle-div">
                            <div class="site-list-item-label padding-bottom-3">
                                Secretario Responsable
                            </div>
                            <div class="site-list-item-text padding-bottom-5">
                                Nombre Secretario Responsable
                            </div>
                            <div class="site-list-item-label padding-bottom-3">
                                Secretario Lider
                            </div>
                            <div class="site-list-item-text">
                                Nombre Secretario Lider
                            </div>
                        </div>
                        <div class="right-div">
                            <div class="site-list-item-label padding-bottom-3">
                                Demandante
                            </div>
                            <div class="site-list-item-text padding-bottom-5">
                                Nombre Demandante
                            </div>
                            <div class="site-list-item-label padding-bottom-3">
                                Demandado
                            </div>
                            <div class="site-list-item-text">
                                Nombre Demandado
                            </div>
                        </div>
                    </div>
            	</a>
            </div>
        </div>
        
        <div class="cell small-12 padding-bottom-50 paginate-div">
        	<font color="#C0C0C0">«  1</font> <u>2</u> <u>3</u>  <u>»</u>
        </div>
        
    </div>
</div>
@endsection
