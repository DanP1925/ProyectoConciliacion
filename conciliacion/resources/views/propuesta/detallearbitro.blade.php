@extends('layouts.app')

@section('title', 'Detalle Arbitro Propuesto')

@section('content')

<div class="grid-container">
    <div class="grid-x">
        <div class="sell small-12">
            <div class="table-2cells-div padding-top-30 padding-bottom-40">
                <div class="left-div">
                    <div class="site-title">
                        DETALLE PROPUESTA
                    </div>
                </div>
                <div class="right-div">
                    <div class="float-right">
                        <div class="site-title-button ">
                            Actualizar Detalle
                        </div>
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
                            Derecho Empresarial
                        </div>
                    </div>
                </div>
                <div class="cell small-4">
                    <div class="table-2cells-div padding-bottom-5">
                        <div class="left-div">
                            <div class="site-label">
                                Estado
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
        <div class="cell small-12 padding-bottom-20">
            <div class="site-label padding-bottom-5">
                Observacion
            </div>
            <div class="site-control">
                <div class="site-control-border">
                    <textarea class="site-input">
                    </textarea>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
