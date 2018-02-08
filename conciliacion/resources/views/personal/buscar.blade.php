@extends('layouts.app')

@section('content')

<div class="grid-container">
    <form method="POST" >
        {{ csrf_field() }}
        <div class="grid-x">
            <div class="cell small-12">
                <div class="table-2cells-div padding-top-30 padding-bottom-40">
                    <div class="left-div">
                        <div class="site-title">
                            BUSCAR PERSONAL
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell small-12 padding-bottom-40">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Nombre
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="nombre" name="nombre"/>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="table-2cells-div padding-bottom-5">
                        </div>
                        <div class="site-label padding-bottom-5">
                            Apellido Paterno
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="apellidoPaterno" name="apellidoPaterno"/>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="table-2cells-div padding-bottom-5">
                        </div>
                        <div class="site-label padding-bottom-5">
                            Apellido Materno
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="apellidoPaterno" name="apellidoPaterno"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell small-12 padding-bottom-40">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Profesión
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="profesion" name="profesion">
                                    <option value="">Seleccione una opción</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            País
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="pais" name="pais">
                                    <option value="">Seleccione una opción</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell small-12 padding-bottom-50">
                <button type="submit" class="site-title-button">
                    buscar
                </button>
                <div style="clear:both;"></div>
            </div>
            <div class="cell small-12 padding-bottom-50">

            </div>
        </div>
    </form>
</div>

@endsection

