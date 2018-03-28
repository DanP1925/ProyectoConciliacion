@if ($tipoAccion == "buscarSecretarioId" || $tipoAccion == "buscarLiderId")
<form method="GET" action="{{ url('expediente/info', ['id'=>$id]) }}">
@else
<form method="GET" action="{{ url('expediente/nuevo', []) }}">
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
                <button type="submit" name="accion" value="{{$accion}} {{$secretario->idUsuarioLegal}}" class="btn-borrar-factura list-edit-icon-div" onclick="retornarDatos()">
                    <img src="{{ asset('images/ico_pointer_blue.png') }}" />
                </button>
            </div>
        </div>
    </div>
</form>
