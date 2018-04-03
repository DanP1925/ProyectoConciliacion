<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioLegal extends Model {

    /**
     * Generated
     */

    protected $table = 'usuario_legal';
    protected $fillable = ['idUsuarioLegal', 'idUsuarioLegalTipo', 'idUsuarioLegalProfesion', 'idUsuarioLegalPais', 'apellidoPaterno', 'apellidoMaterno', 'nombre', 'dni', 'email', 'telefono', 'rutaCv'];


    public function usuarioLegalPais() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegalPais::class, 'idUsuarioLegalPais', 'idUsuarioLegalPais');
    }

    public function usuarioLegalProfesion() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegalProfesion::class, 'idUsuarioLegalProfesion', 'idUsuarioLegalProfesion');
    }

    public function usuarioLegalTipo() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegalTipo::class, 'idUsuarioLegalTipo', 'idUsuarioLegalTipo');
    }

    public function incidentes() {
        return $this->belongsToMany(\App\Http\Models\Incidente::class, 'incidente_usuario', 'idUsuarioIncidente', 'idIncidente');
    }

    public function legalEspecialidads() {
        return $this->belongsToMany(\App\Http\Models\LegalEspecialidad::class, 'usuario_legal_especialidad', 'idUsuarioLegal', 'idLegalEspecialidad');
    }

    public function expedienteRepresentanteLegals() {
        return $this->hasMany(\App\Http\Models\ExpedienteClienteLegal::class, 'idRepresentanteLegal', 'idUsuarioLegal');
    }

    public function expedienteArbitroUnicos() {
        return $this->hasMany(\App\Http\Models\ExpedienteEquipoLegal::class, 'idArbitroUnico', 'idUsuarioLegal');
    }

    public function expedientePresidenteTribunals() {
        return $this->hasMany(\App\Http\Models\ExpedienteEquipoLegal::class, 'idPresidenteTribunal', 'idUsuarioLegal');
    }

    public function expedienteArbitroDemandantes() {
        return $this->hasMany(\App\Http\Models\ExpedienteEquipoLegal::class, 'idArbitroDemandante', 'idUsuarioLegal');
    }

    public function expedienteArbitroDemandados() {
        return $this->hasMany(\App\Http\Models\ExpedienteEquipoLegal::class, 'idArbitroDemandado', 'idUsuarioLegal');
    }

    public function facturas() {
        return $this->hasMany(\App\Http\Models\Factura::class, 'idUsuarioCreador', 'idUsuarioLegal');
    }

    public function incidenteSecretarios() {
        return $this->hasMany(\App\Http\Models\Incidente::class, 'idSecretario', 'idUsuarioLegal');
    }

    public function incidenteUsuarios() {
        return $this->hasMany(\App\Http\Models\IncidenteUsuario::class, 'idUsuarioIncidente', 'idUsuarioLegal');
    }

    public function usuarioLegalEspecialidads() {
        return $this->hasMany(\App\Http\Models\UsuarioLegalEspecialidad::class, 'idUsuarioLegal', 'idUsuarioLegal');
    }

    public function getNombreTipo(){
        $nombre = UsuarioLegalTipo::all()->where('idUsuarioLegalTipo','=',$this->idUsuarioLegalTipo)->first()->nombre;
        return $nombre; 
    }

    public function getNombreProfesion(){
        $nombre = UsuarioLegalProfesion::all()->where('idUsuarioLegalProfesion','=',$this->idUsuarioLegalProfesion)->first()->nombre;
        return $nombre;
    }

    public function getNombrePais(){
        $nombre = UsuarioLegalPais::all()->where('idUsuarioLegalPais','=',$this->idUsuarioLegalPais)->first()->nombre;
        return $nombre;
    }

    public static function buscarPersonal(Request $request){

        $nombre = $request->session()->get('filtroNombre');
        $resultado = UsuarioLegal::where('nombre','LIKE', '%'.$nombre.'%'); 

        $apellidoPaterno = $request->session()->get('filtroApellidoPaterno');
        $resultado = $resultado->where('apellidoPaterno','LIKE', '%'.$apellidoPaterno.'%');

        $apellidoMaterno = $request->session()->get('filtroApellidoMaterno');
        $resultado = $resultado->where('apellidoMaterno','LIKE', '%'.$apellidoMaterno.'%');

        if (!is_null($request->session()->get('filtroProfesion'))){
            $profesion = $request->session()->get('filtroProfesion');
            $resultado = $resultado->where('idUsuarioLegalProfesion','=', $profesion);
        }

        if (!is_null($request->session()->get('filtroPais'))){
            $pais = $request->session()->get('filtroPais');
            $resultado = $resultado->where('idUsuarioLegalPais','=', $pais);
        }

        if (!is_null($request->session()->get('filtroPerfil'))){
            $perfil = $request->session()->get('filtroPerfil');
            $resultado = $resultado->where('idUsuarioLegalTipo','=', $perfil);
        }

        $correo = $request->session()->get('filtroCorreo');
        $resultado = $resultado->where('email','LIKE', '%'.$correo.'%'); 

        return $resultado->paginate(5);
    }

	public static function getListaIdUsandoNombre($nombre){
		$usuariosNombre = DB::table('usuario_legal')->where('nombre','LIKE','%'.$nombre.'%')->get();
		$usuariosPaterno = DB::table('usuario_legal')->where('apellidoPaterno','LIKE','%'.$nombre.'%')->get();
		$usuariosMaterno = DB::table('usuario_legal')->where('apellidoMaterno','LIKE','%'.$nombre.'%')->get();

		$usuarios = $usuariosNombre->merge($usuariosPaterno);
		$usuarios = $usuarios->merge($usuariosMaterno);

		$resultado = [];
		foreach($usuarios as $usuario)
			array_push($resultado,$usuario->idUsuarioLegal);

		return $resultado;
	}

}
