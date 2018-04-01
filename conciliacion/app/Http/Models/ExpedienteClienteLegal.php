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

		//Persona Natural
		$nombre = $request->input('nombre'); 
		$dni = $request->input('dni'); 
		$telefono = $request->input('telefono'); 

		$personasNaturales = DB::table('persona_natural')->where('nombre','LIKE', '%'.$nombre.'%');
		$personasNaturales = $personasNaturales->where('apellidoPaterno','LIKE', '%'.$nombre.'%');
		$personasNaturales = $personasNaturales->where('apellidoPaterno','LIKE', '%'.$nombre.'%');
		$personasNaturales = $personasNaturales->where('dni','LIKE', '%'.$dni.'%');
		$personasNaturales = $personasNaturales->where('telefono','LIKE', '%'.$telefono.'%');

		$listaPersonasNaturales = [];
		foreach ($personasNaturales->get()->all() as $personaNatural)
			array_push($listaPersonasNaturales, $personaNatural->idPersonaNatural);

		$resultadoNatural = ExpedienteClienteLegal::whereIn('idPersonaNatural', $listaPersonasNaturales);

		//Persona Jurdica
		$razonSocial = $request->input('razonSocial'); 
		$ruc = $request->input('ruc'); 
		$telefono = $request->input('telefono'); 

		$personasJuridicas = DB::table('persona_juridica')->where('razonSocial','LIKE','%'.$razonSocial.'%');
		$personasJuridicas = $personasJuridicas->where('razonSocial','LIKE','%'.$razonSocial.'%');
		$personasJuridicas = $personasJuridicas->where('ruc','LIKE','%'.$ruc.'%');
		$personasJuridicas = $personasJuridicas->where('telefono','LIKE','%'.$telefono.'%');

		$listaPersonasJuridicas = [];
		foreach($personasJuridicas->get()->all() as $personaJuridica)
			array_push($listaPersonasJuridicas, $personaJuridica->idPersonaJuridica);

		$resultadoJuridico = ExpedienteClienteLegal::whereIn('idPersonaJuridica', $listaPersonasJuridicas);

		$email = $request->input('email');
		$resultadoNatural = $resultadoNatural->where('emailClienteLegal','LIKE', '%'.$email.'%');
		$resultadoJuridico= $resultadoJuridico->where('emailClienteLegal','LIKE', '%'.$email.'%');

		if (!is_null($request->input('sector'))){
			$sector = $request->input('sector');
			$resultadoNatural = $resultadoNatural->where('flgSector','=', $sector);
			$resultadoJuridico = $resultadoJuridico->where('flgSector','=', $sector);
		}

		if (!is_null($request->input('flagConsorcio'))){
			//PersonaJuridica
			$consorciosJuridicos = DB::table('consorcio_persona_detalle')->where('idPersonaJuridica','<>',0)->get();

			$listaConsorciosJuridicos = [];
			foreach($consorciosJuridicos as $consorcioJuridico)
				array_push($listaConsorciosJuridicos, $consorcioJuridico->idPersonaJuridica);

			if ($request->input('flagConsorcio')=='Si')
				$resultadoJuridico = $resultadoJuridico->whereIn('idPersonaJuridica',$listaConsorciosJuridicos);
			else
				$resultadoJuridico = $resultadoJuridico->whereNotIn('idPersonaJuridica',$listaConsorciosJuridicos);

			//PersonaNatural
			$consorciosNaturales = DB::table('consorcio_persona_detalle')->where('idPersonaNatural','<>',0)->get();

			$listaConsorciosNaturales = [];
			foreach($consorciosNaturales as $consorcioNatural)
				array_push($listaConsorciosNaturales, $consorcioNatural->idPersonaNatural);

			if ($request->input('flagConsorcio')=='Si')
				$resultadoNatural = $resultadoNatural->whereIn('idPersonaNatural',$listaConsorciosNaturales);
			else
				$resultadoNatural = $resultadoNatural->whereNotIn('idPersonaNatural',$listaConsorciosNaturales);

		}	

		$listaJuridica = [];
		foreach($resultadoJuridico->get()->all() as $resultadoJur){
			array_push($listaJuridica, $resultadoJur->idExpedienteClienteLegal);
		}

		$listaNatural = [];
		foreach($resultadoNatural->get()->all() as $resultadoNat){
			array_push($listaNatural, $resultadoNat->idExpedienteClienteLegal);
		}

		$lista = array_merge($listaJuridica ,$listaNatural);

		$resultado = ExpedienteClienteLegal::whereIn('idExpedienteClienteLegal',$lista);
		
        return $resultado->paginate(5);
    }

}
