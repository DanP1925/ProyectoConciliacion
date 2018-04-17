<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Models\PersonaNatural;
use Illuminate\Http\Request;

class ExpedienteClienteLegal extends Model {

    /**
     * Generated
     */

    protected $table = 'expediente_cliente_legal';
    protected $fillable = ['idExpedienteClienteLegal', 'idRepresentanteLegal', 'idConsorcioPersona', 'idPersonaNatural', 'idPersonaJuridica', 'nombre', 'flgTipoPersona', 'flgSector', 'emailClienteLegal', 'emailRepresentanteLegal'];


    public function personaJuridica() {
        return $this->belongsTo(\App\Http\Models\PersonaJuridica::class, 'idPersonaJuridica', 'idPersonaJuridica');
    }

    public function personaNatural() {
        return $this->belongsTo(\App\Http\Models\PersonaNatural::class, 'idPersonaNatural', 'idPersonaNatural');
    }

    public function usuarioLegal() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idRepresentanteLegal', 'idUsuarioLegal');
    }

    public function consorcioPersona() {
        return $this->belongsTo(\App\Http\Models\ConsorcioPersona::class, 'idConsorcioPersona', 'idConsorcioPersona');
    }

    public function expedienteDemandante() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idDemandante', 'idExpedienteClienteLegal');
    }

    public function expedienteDemandado() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idDemandado', 'idExpedienteClienteLegal');
    }

	public function getPersonaJuridica() {
		return DB::table('persona_juridica')->where('idPersonaJuridica',$this->idPersonaJuridica)->first();
	}

	public function getPersonaNatural() {
		return DB::table('persona_natural')->where('idPersonaNatural',$this->idPersonaNatural)->first();
	}

	public function getRepresentanteLegal() {
		return DB::table('usuario_legal')->where('idUsuarioLegal',$this->idRepresentanteLegal)->first();
	}

	public function getConsorcioPersona() {
		return DB::table('consorcio_persona')->where('idConsorcioPersona',$this->idConsorcioPersona)->first();
	}

	public static function getListaIdUsandoIdPersonaJuridica($listaPersonasJuridicas){
		$clientesJuridicos = DB::table('expediente_cliente_legal')->whereIn('idPersonaJuridica',$listaPersonasJuridicas)->get();

		$lista= [];
		foreach($clientesJuridicos as $clienteJuridico){
			array_push($lista, $clienteJuridico->idExpedienteClienteLegal);
		}

		return $lista;
	}

	public static function getListaIdUsandoIdPersonaNatural($listaPersonasNatural){
		$clientesNaturales = DB::table('expediente_cliente_legal')->whereIn('idPersonaNatural',$listaPersonasNatural)->get();

		$lista= [];
		foreach($clientesNaturales as $clienteNatural){
			array_push($lista, $clienteNatural->idExpedienteClienteLegal);
		}

		return $lista;
	}

    public static function buscarCliente(Request $request){

		$flagConsorcio = $request->input('flagConsorcio');
		if (!is_null($flagConsorcio)){
			if ($flagConsorcio == "Si")
				$resultado = ExpedienteClienteLegal::whereNotNull('idConsorcioPersona');
			else if ($flagConsorcio == "No")
				$resultado = ExpedienteClienteLegal::whereNull('idConsorcioPersona');
		} else
			$resultado = ExpedienteClienteLegal::getModel();

		$flagSector = $request->input('sector');
		if (!is_null($flagSector))
			$resultado = $resultado->where('flgSector',$flagSector);

		$email = $request->input('email');
		if (!is_null($email))
			$resultado = $resultado->where('emailClienteLegal','LIKE', '%'.$email.'%');

		if (ExpedienteClienteLegal::buscaPersonaNatural($request) && ExpedienteClienteLegal::buscaPersonaJuridica($request)){
			$resultado = ExpedienteClienteLegal::getModel();
		} else {
			if (ExpedienteClienteLegal::buscaPersonaNatural($request)){
				$nombre = $request->input('nombre'); 
				$dni = $request->input('dni'); 
				$listaNaturales = PersonaNatural::getListaIdUsandoNombreYDNI($nombre,$dni);
				$resultado = $resultado->whereIn('idPersonaNatural', $listaNaturales);
			} 
			else if (ExpedienteClienteLegal::buscaPersonaJuridica($request)){
				$razonSocial = $request->input('razonSocial'); 
				$ruc = $request->input('ruc'); 
				$listaJuridicas = PersonaJuridica::getListaIdUsandoRazonSocialYRUC($razonSocial,$ruc);
				$resultado = $resultado->whereIn('idPersonaJuridica', $listaJuridicas);
			}
		}

		return $resultado->paginate(5);
    }

	private static function buscaPersonaNatural(Request $request){
		$hayNombre = !is_null($request->input('nombre'));
		$hayDni = !is_null($request->input('dni'));
		return $hayNombre || $hayDni;
	}

	private static function buscaPersonaJuridica(Request $request){
		$hayRazonSocial = !is_null($request->input('razonSocial'));
		$hayRuc = !is_null($request->input('ruc'));
		return $hayRazonSocial || $hayRuc;
	}

}
