@extends('layouts.app')

@section('title', 'Directorio de Clientes')

@section('content')
<div class="grid-container">
    <div class="grid-x">
        <div class="cell small-12">
            <div class="table-2cells-div padding-top-30 padding-bottom-40">
                <div class="left-div">
                    <div class="site-title">
                        DIRECTORIO DE CLIENTES
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
                                <input type="text" class="site-input" id="nombre" name="nombre" />
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    ¿Es Consorcio?
                                </div>
                            </div>
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="flagConsorcio" name="flagConsorcio">
                                    <option value="">Seleccione una opción</option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    Sector
                                </div>
                            </div>
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select class="site-select" id="sector" name="sector">
                                    <option value="">Seleccione una opción</option>
                                    <option value="Privado">Privado</option>
                                    <option value="Público">Público</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell small-12 padding-bottom-20">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Razon Social
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="razonSocial" name="razonSocial" />
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    RUC
                                </div>
                            </div>
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="ruc" name="ruc" />
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    DNI
                                </div>
                            </div>
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="dni" name="dni" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell small-12 padding-bottom-20">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Teléfono
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="telefono" name="telefono" />
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="table-2cells-div padding-bottom-5">
                            <div class="left-div">
                                <div class="site-label">
                                    Correo Electrónico
                                </div>
                            </div>
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input type="text" class="site-input" id="correo" name="correo" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell small-12 padding-bottom-50">
                <button name="accion" class="site-form-button float-left">
                    buscar
                </button>
                <div style="clear:both;"></div>
            </div>
        </div>
    </div>
</div>
@endsection
