<div class="grid-container">
	<div class="grid-x">
    	<div class="cell small-12">
            <div class="table-2cells-div padding-top-30 padding-bottom-40">
                <div class="left-div">
                    <div class="site-title">
                        NUEVO USUARIO
                    </div>
                </div>
                <div class="right-div">
                	<div onclick="event.preventDefault(); document.getElementById('nuevo-usuario').submit();" class="site-title-button float-right">
                        Registrar Usuario
                    </div>
                    <div style="clear:both;"></div>
                </div>
            </div>
		</div>
  	</div>  
    <form id="nuevo-usuario" class="form-horizontal" method="POST" action="{{ route('registrarExternal') }}">
    	<div class="grid-x">
        	{{ csrf_field() }}
            <div class="cell small-12 padding-bottom-20">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Email
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input id="email" type="email" class="site-input" name="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Contraseña
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input id="password" type="password" class="site-input" name="password" required>
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Confirmar Contraseña
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input id="password-confirm" type="password" class="site-input" name="password_confirmation" required>
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
                            <div class="site-control-border">
                                <input id="nombre" type="text" class="site-input" name="nombre">
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Apellido Paterno
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input id="apPaterno" type="text" class="site-input" name="apPaterno">
                            </div>
                        </div>
                    </div>
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Apellido Materno
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <input id="apMaterno" type="text" class="site-input" name="apMaterno">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="cell small-12 padding-bottom-25">
                <div class="grid-x grid-margin-x">
                    <div class="cell small-4">
                        <div class="site-label padding-bottom-5">
                            Perfil
                        </div>
                        <div class="site-control">
                            <div class="site-control-border">
                                <select id="idPerfil" name="idPerfil" class="site-select">
                                    @foreach ($perfiles as $perfil)
                                        <option value="{{ $perfil->idPerfil }}">{{ $perfil->nombre }}</option>
                                    @endforeach
                                </select>
                           </div>
                        </div>
                    </div>
                    
                    <div class="cell small-4">
                        &nbsp;
                    </div>
                    <div class="cell small-4">
                        &nbsp;
                    </div>
                    
                </div>
            </div>
        </div>
    </form> 
</div>

