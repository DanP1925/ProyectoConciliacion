@if ($tipoAccion == "buscarSecretarioId" || $tipoAccion == "buscarLiderId")
<form method="GET" action="{{ url('expediente/info', ['id'=>$id]) }}">
@else
<form method="GET" action="{{ url('expediente/nuevo', []) }}">
@endif
	{{ csrf_field() }}
    @if($loop->iteration % 2 == 0)
        <div class="list-div">
    @else
        <div class="list-div" style="background-color:#F5F5F5;">
    @endif
            <div class="list-text-3-div">
                <div class="list-label-avant-garde-lite">
                    Nombre
                </div>
                <div class="list-biglabel-avant-garde-regular">
                    {{$secretario->apellidoPaterno}} {{$secretario->apellidoMaterno}}, {{$secretario->nombre}}
                </div>
            </div>
            <div class="list-text-4-div">
                <div class="list-label-avant-garde-lite">
                    Profesión
                </div>
                <div class="list-biglabel-avant-garde-regular">
                    {{$secretario->getNombreProfesion()}}
                </div>
            </div>
            <div class="list-text-4-div">
                <div class="list-label-avant-garde-lite">
                    País
                </div>
                <div class="list-biglabel-avant-garde-regular">
                    {{$secretario->getNombrePais()}}
                </div>
            </div>
            <div class="list-text-3-div">
                <div class="list-label-avant-garde-lite">
                    Perfil
                </div>
                <div class="list-biglabel-avant-garde-regular">
                    {{$secretario->getNombreTipo()}}
                </div>
            </div>
            <div class="list-icon-div">
                <button type="submit" name="accion" value="{{$accion}} {{$secretario->idUsuarioLegal}}" class="btn-borrar-factura list-edit-icon-div" onclick="retornarDatos()" style="cursor:pointer;">
                    <img src="{{ asset('images/ico_pointer_blue.png') }}" />
                </button>
            </div>
        </div>
</form>
