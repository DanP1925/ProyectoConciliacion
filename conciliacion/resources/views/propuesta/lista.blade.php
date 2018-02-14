@extends('layouts.app')

@section('title', 'Propuestas')

@section('content')

<div class="grid-container">
    <div class="grid-x">
        <div class="sell small-12">
            <div class="table-2cells-div padding-top-30 padding-bottom-40">
                <div class="left-div">
                    <div class="site-title">
                        PROPUESTAS
                    </div>
                </div>
                <div class="right-div">
                    <div class="float-right">
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
                        Resultado
                    </div>
                    <div class="site-control">
                        <div class="site-control-border">
                            <select class="site-select" id="estado" name="estado">
                                <option value="">Seleccione una opción</option>
                            </select>
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
                        Número de Expediente
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
                            Número de Expediente
                        </div>
                        <div class="site-list-item-text">
                            123-456-78
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Demandante
                        </div>
                        <div class="site-list-item-text">
                            Tottus
                        </div>
                        <div class="site-list-item-label padding-bottom-5">
                            Demandado
                        </div>
                        <div class="site-list-item-text">
                            Cencosud
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Propuesta 1
                        </div>
                        <div class="site-list-item-text">
                            Juan Pérez
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Propuesta 2
                        </div>
                        <div class="site-list-item-text">
                            Pedro Pérez
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Propuesta 3
                        </div>
                        <div class="site-list-item-text">
                            Pedro Coelho
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Designado
                        </div>
                        <div class="site-list-item-text">
                            Juan Pérez
                        </div>
                    </div>
                </div>
            </div>

            <div class="site-list-item-div background-color-FFFFFF">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Número de Expediente
                        </div>
                        <div class="site-list-item-text">
                            123-456-78
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Demandante
                        </div>
                        <div class="site-list-item-text">
                            Tottus
                        </div>
                        <div class="site-list-item-label padding-bottom-5">
                            Demandado
                        </div>
                        <div class="site-list-item-text">
                            Cencosud
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Propuesta 1
                        </div>
                        <div class="site-list-item-text">
                            Juan Pérez
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Propuesta 2
                        </div>
                        <div class="site-list-item-text">
                            Pedro Pérez
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Propuesta 3
                        </div>
                        <div class="site-list-item-text">
                            Pedro Coelho
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Designado
                        </div>
                        <div class="site-list-item-text">
                            Por Designar
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-list-item-div background-color-FFFFFF">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Número de Expediente
                        </div>
                        <div class="site-list-item-text">
                            123-456-78
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Demandante
                        </div>
                        <div class="site-list-item-text">
                            Tottus
                        </div>
                        <div class="site-list-item-label padding-bottom-5">
                            Demandado
                        </div>
                        <div class="site-list-item-text">
                            Cencosud
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Propuesta 1
                        </div>
                        <div class="site-list-item-text">
                            Juan Pérez
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Propuesta 2
                        </div>
                        <div class="site-list-item-text">
                            Pedro Pérez
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Propuesta 3
                        </div>
                        <div class="site-list-item-text">
                            Pedro Coelho
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-5">
                            Designado
                        </div>
                        <div class="site-list-item-text">
                            Anulado
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
