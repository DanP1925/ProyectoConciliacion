@extends('layouts.app')

@section('title', 'Directorio de Usuarios')

@section('content')
<div class="grid-container">
    <div class="grid-x">
        <div class="cell small-12">
            <form method="POST" action="/usuariolegal/directorio">
                {{ csrf_field() }}
                <div class="table-2cells-div padding-top-30 padding-bottom-40">
                    <div class="left-div">
                        <div class="site-title">
                            DIRECTORIO
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
                                        Apellido Paterno
                                    </div>
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <input type="text" class="site-input" id="apellidoPaterno" name="apellidoPaterno" />
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
                                    <input type="text" class="site-input" id="apellidoMaterno" name="apellidoMaterno" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cell small-12 padding-bottom-20">
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-4">
                            <div class="site-label padding-bottom-5">
                                Profesión
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <select class="site-select" id="profesion" name="profesion">
                                        <option value="">Seleccione una opción</option>
                                        @foreach ($profesiones as $profesion)
                                        <option value="{{$profesion->idUsuarioLegalProfesion}}">{{$profesion->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="cell small-4">
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        País
                                    </div>
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <select class="site-select" id="pais" name="pais">
                                        <option value="">Seleccione una opción</option>
                                        @foreach ($paises as $pais)
                                        <option value="{{$pais->idUsuarioLegalPais}}">{{$pais->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="cell small-4">
                            <div class="table-2cells-div padding-bottom-5">
                                <div class="left-div">
                                    <div class="site-label">
                                        Perfil
                                    </div>
                                </div>
                            </div>
                            <div class="site-control">
                                <div class="site-control-border">
                                    <select class="site-select" id="perfil" name="perfil">
                                        <option value="">Seleccione una opción</option>
                                        @foreach ($perfiles as $perfil)
                                        <option value="{{$perfil->idUsuarioLegalTipo}}">{{$perfil->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cell small-12 padding-bottom-40">
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
                    <button name="accion" value="{{$accion}}" class="site-form-button float-left">
                        buscar
                    </button>
                    <div style="clear:both;"></div>
                </div>
            </form>
        </div>
        <div class="cell small-12 padding-bottom-50">

            @foreach ($secretarios as $secretario)
			@if ($tipoAccion == "buscarSecretarioId" || $tipoAccion == "buscarLiderId")
			<form method="POST" action="/expediente/info/{{$id}}">
			@else
            <form method="POST" action="/expediente/nuevo">
			@endif
				{{ csrf_field() }}
                @if ($loop->index % 2 == 0)
                <div class="site-list-item-div background-color-F5F5F5">
					@else 
                    <div class="site-list-item-div background-color-FFFFFF">
                        @endif
                        <div class="grid-x grid-margin-x">
                            <div class="cell small-4">
                                <div class="site-list-item-label padding-bottom-3">
                                    Nombre
                                </div>
                                <div class="site-list-item-text">
                                    {{$secretario->nombre}} {{$secretario->apellidoPaterno}} {{$secretario->apellidoMaterno}}
                                </div>
                            </div>
                            <div class="cell small-2">
                                <div class="site-list-item-label padding-bottom-3">
                                    Profesión
                                </div>
                                <div class="site-list-item-text">
                                    {{$secretario->getNombreProfesion()}}
                                </div>
                            </div>
                            <div class="cell small-2">
                                <div class="site-list-item-label padding-bottom-3">
                                    País
                                </div>
                                <div class="site-list-item-text">
                                    {{$secretario->getNombrePais()}}
                                </div>
                            </div>
                            <div class="cell small-3">
                                <div class="site-list-item-label padding-bottom-3">
                                    Perfil
                                </div>
                                <div class="site-list-item-text">
                                    {{$secretario->getNombreTipo()}}
                                </div>
                            </div>
                            <div class="cell small-1">
                                <button type="submit" name="accion" value="{{$accion}} {{$secretario->idUsuario_legal}}">
                                    <i class="fa fa-user " style="font-size:36px;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
