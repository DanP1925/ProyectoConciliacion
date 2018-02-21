@extends('layouts.app')

@section('title', 'Detalle Designacion')

@section('content')
<div class="grid-container">
    <div class="grid-x">
        <div class="sell small-12">
            <div class="table-2cells-div padding-top-30 padding-bottom-40">
                <div class="left-div">
                    <div class="site-title">
                        DETALLE DESIGNACIONES
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
                        Nombre
                    </div>
                    <div class="site-control">
                    	<div class="site-list-item-text">
                            Juan Perez
                    	</div>
                    </div>
                </div>
    			<div class="cell small-4">
                	<div class="table-2cells-div padding-bottom-5">
                    	<div class="left-div">
                            <div class="site-label">
                                Especialidad
                            </div>
                        </div>
                    </div>
                    <div class="site-control">
                    	<div class="site-list-item-text">
                            Derecho Ambiental
                    	</div>
                    </div>
                </div>
          	</div>
        </div>
        <div class="cell small-12 padding-bottom-20">
        	<div class="grid-x grid-margin-x">
            	<div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Numero Total de Designaciones
                    </div>
                    <div class="site-control">
                    	<div class="site-list-item-text">
                            14
                    	</div>
                    </div>
                </div>
    			<div class="cell small-4">
                	<div class="table-2cells-div padding-bottom-5">
                    	<div class="left-div">
                            <div class="site-label">
                                Designaciones por la Corte
                            </div>
                        </div>
                    </div>
                    <div class="site-control">
                    	<div class="site-list-item-text">
                            6
                    	</div>
                    </div>
                </div>
                <div class="cell small-4">
                	<div class="table-2cells-div padding-bottom-5">
                    	<div class="left-div">
                            <div class="site-label">
                                Designaciones por las Partes
                            </div>
                        </div>
                    </div>
                    <div class="site-control">
                    	<div class="site-list-item-text">
                            8
                    	</div>
                    </div>
                </div>
          	</div>
        </div>
        <div class="cell small-12 padding-bottom-40">
        	<div class="grid-x grid-margin-x">
            	<div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Designaciones Propuestas
                    </div>
                    <div class="site-control">
                    	<div class="site-list-item-text">
                            8
                    	</div>
                    </div>
                </div>
    			<div class="cell small-4">
                	<div class="table-2cells-div padding-bottom-5">
                    	<div class="left-div">
                            <div class="site-label">
                                Designaciones Rechazadas
                            </div>
                        </div>
                    </div>
                    <div class="site-control">
                    	<div class="site-list-item-text">
                            3
                    	</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cell small-12 padding-bottom-50">
            <div class="site-list-item-div background-color-F5F5F5">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-3">
                        <div class="site-list-item-label padding-bottom-5">
                            Numero de Expediente
                        </div>
                        <div class="site-list-item-text">
                            123-456-98
                        </div>
                    </div>
                    <div class="cell small-3">
                        <div class="site-list-item-label padding-bottom-5">
                            Fecha
                        </div>
                        <div class="site-list-item-text">
                            01/01/18
                        </div>
                    </div>
                    <div class="cell small-3">
                        <div class="site-list-item-label padding-bottom-5">
                            Estado
                        </div>
                        <div class="site-list-item-text">
                            Designado
                        </div>
                    </div>
                    <div class="cell small-3">
                        <div class="site-list-item-label padding-bottom-5">
                            Tipo de Designacion
                        </div>
                        <div class="site-list-item-text">
                            Por la Corte
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-list-item-div background-color-FFFFFF">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-3">
                        <div class="site-list-item-label padding-bottom-5">
                            Numero de Expediente
                        </div>
                        <div class="site-list-item-text">
                            123-456-12
                        </div>
                    </div>
                    <div class="cell small-3">
                        <div class="site-list-item-label padding-bottom-5">
                            Fecha
                        </div>
                        <div class="site-list-item-text">
                            05/01/18
                        </div>
                    </div>
                    <div class="cell small-3">
                        <div class="site-list-item-label padding-bottom-5">
                            Estado
                        </div>
                        <div class="site-list-item-text">
                            Rechazado
                        </div>
                    </div>
                    <div class="cell small-3">
                        <div class="site-list-item-label padding-bottom-5">
                            Tipo de Designacion
                        </div>
                        <div class="site-list-item-text">
                            -
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
