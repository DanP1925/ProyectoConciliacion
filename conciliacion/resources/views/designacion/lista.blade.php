@extends('layouts.app')

@section('title', 'Designaciones')

@section('content')

<div class="grid-container">
	<div class="grid-x">
        <div class="sell small-12">
            <div class="table-2cells-div padding-top-30 padding-bottom-40">
                <div class="left-div">
                    <div class="site-title">
                        DESIGNACIONES
                    </div>
                </div>
                <div class="right-div">
                    <div class="float-right">
                        <a href="{{ url ('/propuesta/lista',[])}}">
                            <div class="site-title-button ">
                                Ver Propuestas
                            </div>
                        </a>
                        <a href="{{ url ('/propuesta/nuevo',[])}}">
                            <div class="site-title-button ">
                                Nueva Propuesta
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="cell small-12 padding-bottom-20">
        	<div class="grid-x grid-margin-x">
            	<div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Nombre
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
                                Apellido Paterno
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
                                Apellido Materno
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
                        Especialidad
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
                                Demandante
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
                                Demandado
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
                        Número Minimo de Designaciones
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
                                Número Máximo de Designaciones
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
                                Tipo de Designción
                            </div>
                        </div>
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                            <select class="site-select" id="estado" name="estado">
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
                <div class="grid-x grid-margin-x">
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Nombre
                        </div>
                        <div class="site-list-item-text">
                            Juan Perez
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Especialidad
                        </div>
                        <div class="site-list-item-text">
                            Derecho Ambiental
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Designaciones por la Corte
                        </div>
                        <div class="site-list-item-text">
                            6
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Designaciones por la Parte
                        </div>
                        <div class="site-list-item-text">
                            8
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Designaciones Propuestas
                        </div>
                        <div class="site-list-item-text">
                            8
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Designaciones Rechazadas
                        </div>
                        <div class="site-list-item-text">
                            3
                        </div>
                    </div>
                </div>
            </div>

            <div class="site-list-item-div background-color-FFFFFF">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Nombre
                        </div>
                        <div class="site-list-item-text">
                            Juan Perez
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Especialidad
                        </div>
                        <div class="site-list-item-text">
                            Derecho Ambiental
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Designaciones por la Corte
                        </div>
                        <div class="site-list-item-text">
                            6
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Designaciones por la Parte
                        </div>
                        <div class="site-list-item-text">
                            8
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Designaciones Propuestas
                        </div>
                        <div class="site-list-item-text">
                            8
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Designaciones Rechazadas
                        </div>
                        <div class="site-list-item-text">
                            3
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="cell small-12 padding-bottom-50 paginate-div">
        	<font color="#C0C0C0">«  1</font> <u>2</u> <u>3</u>  <u>»</u>
        </div>
    </div>
</div>

@endsection
