@extends('layouts.app')

@section('title', 'Nueva Propuesta')

@section('content')

<div class="grid-container">
    <div class="grid-x">
        <div class="sell small-12">
            <div class="table-2cells-div padding-top-30 padding-bottom-40">
                <div class="left-div">
                    <div class="site-title">
                        NUEVA PROPUESTA
                    </div>
                </div>
                <div class="right-div">
                    <div class="float-right">
                        <div class="site-title-button ">
                            Registrar Propuesta
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cell small-12 padding-bottom-20">
            <div class="grid-x grid-margin-x">
                <div class="cell small-4">
                    <div class="site-label padding-bottom-5">
                        Numero de Expediente
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
                            <input type="text" class="site-input" id="fechaInicio" name="fechaInicio" readonly/>
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
                            <input type="text" class="site-input" id="fechaFin" name="fechaFin" readonly/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cell small-12 padding-bottom-20">
            <div class="grid-x grid-margin-x">
                <div class="cell small-4">
                    <div class="site-label padding-bottom-5">
                        Tipo de Caso
                    </div>
                    <div class="site-control">
                        <div class="site-control-border">
                            <input type="text" class="site-input" id="fechaInicio" name="fechaInicio" readonly/>
                        </div>
                    </div>
                </div>
                <div class="cell small-4">
                    <div class="table-2cells-div padding-bottom-5">
                        <div class="left-div">
                            <div class="site-label">
                                Subtipo de Caso
                            </div>
                        </div>
                    </div>
                    <div class="site-control">
                        <div class="site-control-border">
                            <input type="text" class="site-input" id="fechaInicio" name="fechaInicio" readonly/>
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
        <div class="cell small-12 padding-bottom-40">
            <div class="grid-x grid-margin-x">
                <div class="cell small-12">
                    <div class="table-2cells-div">
                        <div class="left-div">
                            <div class="site-subtitle padding-bottom-20">
                                ÁRBITROS PROPUESTOS
                            </div>
                        </div>
                        <div class="right-div">
                            <a href="{{ url ('/usuariolegal/arbitros',[])}}">
                                <button type="Agregar Regiones" class="site-label-button float-right">
                                    Buscar Árbitros
                                </button>
                            </a>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cell small-12 padding-bottom-40">
            <a href="{{ url ('/propuesta/detallearbitro',[])}}">
                <div class="site-list-item-div background-color-F5F5F5">
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-1">
                            <div class="site-list-item-label padding-bottom-3">
                                Prioridad
                            </div>
                            <div class="site-list-item-text padding-bottom-5">
                                1
                            </div>
                        </div>
                        <div class="cell small-2">
                            <div class="site-list-item-label padding-bottom-3">
                                Nombre
                            </div>
                            <div class="site-list-item-text padding-bottom-5">
                                Juan Perez
                            </div>
                        </div>
                        <div class="cell small-2">
                            <div class="site-list-item-label padding-bottom-3">
                                Especialidad
                            </div>
                            <div class="site-list-item-text padding-bottom-5">
                                Derecho Empresarial
                            </div>
                        </div>
                        <div class="cell small-2">
                            <div class="site-list-item-label padding-bottom-3">
                                Estado
                            </div>
                            <div class="site-list-item-text padding-bottom-5">
                                Designado
                            </div>
                        </div>
                        <div class="cell small-5">
                            <div class="site-list-item-label padding-bottom-3">
                                Observación
                            </div>
                            <div class="site-list-item-text padding-bottom-5">
                                Lorem ipsum dolor sit amet
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <div class="site-list-item-div background-color-FFFFFF">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-1">
                        <div class="site-list-item-label padding-bottom-3">
                            Prioridad
                        </div>
                        <div class="site-list-item-text padding-bottom-5">
                            2
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-3">
                            Nombre
                        </div>
                        <div class="site-list-item-text padding-bottom-5">
                            Pedro Perez
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-3">
                            Especialidad
                        </div>
                        <div class="site-list-item-text padding-bottom-5">
                            Derecho Penal
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-3">
                            Estado
                        </div>
                        <div class="site-list-item-text padding-bottom-5">
                            Propuesto
                        </div>
                    </div>
                    <div class="cell small-5">
                        <div class="site-list-item-label padding-bottom-3">
                            Observación
                        </div>
                        <div class="site-list-item-text padding-bottom-5">
                            Lorem ipsum dolor sit amet
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-list-item-div background-color-F5F5F5">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-1">
                        <div class="site-list-item-label padding-bottom-3">
                            Prioridad
                        </div>
                        <div class="site-list-item-text padding-bottom-5">
                            3
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-3">
                            Nombre
                        </div>
                        <div class="site-list-item-text padding-bottom-5">
                            Pedro Coelho
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-3">
                            Especialidad
                        </div>
                        <div class="site-list-item-text padding-bottom-5">
                            Derecho Ambiental
                        </div>
                    </div>
                    <div class="cell small-2">
                        <div class="site-list-item-label padding-bottom-3">
                            Estado
                        </div>
                        <div class="site-list-item-text padding-bottom-5">
                            Rechazado
                        </div>
                    </div>
                    <div class="cell small-5">
                        <div class="site-list-item-label padding-bottom-3">
                            Observación
                        </div>
                        <div class="site-list-item-text padding-bottom-5">
                            Lorem ipsum dolor sit amet
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="cell small-12 padding-bottom-40">
            <div class="grid-x grid-margin-x">
                <div class="cell small-12">
                    <div class="site-subtitle padding-bottom-20">
                        RESULTADO
                    </div>
                </div>
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
                            Tipo
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
            <div class="cell small-4">
                <div class="table-2cells-div padding-bottom-5">
                    <div class="left-div">
                        <div class="site-label">
                            Nombre
                        </div>
                    </div>
                </div>
                <div class="site-control">
                    <div class="site-control-border">
                        <input type="text" class="site-input" id="fechaFin" name="fechaFin" readonly/>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <div class="cell small-12 padding-bottom-50">
            <div class="site-form-button float-left">
                Actualizar Propuesta
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
</div>

@endsection
