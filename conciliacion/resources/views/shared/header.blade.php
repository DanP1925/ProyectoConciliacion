<div class="header-top-div">
    <div class="grid-container">
      <div class="grid-x">
        <div class="cell small-6 left-logo">
            <img src="{{ asset('images/logoConciliacion.png') }}" />
        </div>
        <div class="cell small-6 right-logo">
            <img src="{{ asset('images/logoPUCP1.png') }}" />
        </div>
      </div>
    </div>
</div>
<div class="header-bottom-div">
    <div class="grid-container">
      <div class="grid-x">
        <div class="cell small-4 header-text-div text-align-left">
            Bienvenido, 
            @foreach (Auth::user()->usuarios as $usuario)
                <strong>{{ mb_strtoupper($usuario->nombre) }} {{ mb_strtoupper($usuario->apellidoPaterno) }}</strong>
            @endforeach
        </div>
        <div class="cell small-8 header-text-div text-align-right">
            <a href="{{ url('/expediente/lista',[]) }}"><strong>Expedientes</strong></a> |
            <strong>Designaciones</strong> |
            <a href="{{ url('/incidente/lista',[]) }}"><strong>Incidentes</strong></a> |
            <a href="{{ url('/facturacion/lista',[]) }}"><strong>Facturas</strong></a> |
            <strong>Mantenimientos</strong> | 
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <strong>Cerrar Sesión</strong>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            
            
        </div>
      </div>
    </div>
</div>