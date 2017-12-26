@extends('layouts.app')

@section('content')

<div class="grid-container">
	<div class="grid-x">
    	<div class="cell small-12">
            <div class="table-2cells-div padding-top-30 padding-bottom-40">
                <div class="left-div">
                    <div class="site-title">
                        DETALLE EXPEDIENTE
                    </div>
                </div>
                <div class="right-div">
                	<a href="{{ url('/expediente/editar',['idExpediente' => 'codigo']) }}">
                        <div class="site-title-button float-right">
                            Editar Expediente
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
                    		&nbsp;
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
                        </div>
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		&nbsp;
                        </div>
                    </div>
                </div>
                <div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Estado Expediente
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		&nbsp;
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
                    		&nbsp;
                        </div>
                    </div>
                </div>
    			<div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Segunda División
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		&nbsp;
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
                    		&nbsp;
                        </div>
                    </div>
                </div>
    			<div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Cuantía Determinada
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		&nbsp;
                        </div>
                    </div>
                </div>
                <div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Tipo Cuantía
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		&nbsp;
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
                        </div>
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		&nbsp;
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
                        </div>
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		&nbsp;
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
                        </div>
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		&nbsp;
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
                        </div>
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		&nbsp;
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
                    		&nbsp;
                        </div>
                    </div>
                </div>
    			<div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Monto del Contrato (S/.)
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		&nbsp;
                        </div>
                    </div>
                </div>
                <div class="cell small-4">
                	<div class="site-label padding-bottom-5">
                        Año del Contrato
                    </div>
                    <div class="site-control">
                    	<div class="site-control-border">
                    		&nbsp;
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
