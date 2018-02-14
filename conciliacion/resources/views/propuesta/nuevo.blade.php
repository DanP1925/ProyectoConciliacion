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
                            <input type="text" class="site-input" id="fechaInicio" name="fechaInicio" />
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
            <div class="cell small-9 padding-bottom-40">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-12">
                        <div class="table-2cells-div">
                            <div class="left-div">
                                <div class="site-subtitle padding-bottom-20">
                                    ÁRBITROS PROPUESTOS
                                </div>
                            </div>
                            <div class="right-div">
                                <button type="Agregar Regiones" class="site-label-button float-right">
                                    Buscar Árbitros
                                </button>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

@endsection
