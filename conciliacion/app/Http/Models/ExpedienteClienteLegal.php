<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Models\PersonaNatural;

class ExpedienteClienteLegal extends Model {

    protected $table = 'expediente_cliente_legal';
    protected $fillable = ['idExpedienteClienteLegal','idRepresentanteLegal', 'idPersonaNatural', 'idPersonaJuridica', 'flgTipoPersona', 'flgSector', 'emailClienteLegal', 'emailRepresentanteLegal'];

    public function representanteLegal() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idRepresentanteLegal', 'idUsuario_legal');
    }

    public function personaNatural() {
        return $this->belongsTo(\App\Http\Models\PersonaNatural::class, 'idPersonaNatural', 'idPersonaNatural');
    }

    public function personaJuridica() {
        return $this->belongsTo(\App\Http\Models\PersonaJuridica::class, 'idPersonaJuridica', 'idPersonaJuridica');
    }

	public function getPersonaJuridica() {
		return DB::table('persona_juridica')->where('idPersonaJuridica',$this->idPersonaJuridica)->first();
	}

	public function getPersonaNatural() {
		return DB::table('persona_natural')->where('idPersonaNatural',$this->idPersonaNatural)->first();
	}

	public function getRepresentanteLegal() {
		return DB::table('usuario_legal')->where('idUsuario_legal',$this->idRepresentanteLegal)->first();
	}

    public static function buscarCliente(Request $request){


		//Persona Natural
		$nombre = $request->input('nombre'); 
		$dni = $request->input('dni'); 
		$telefono = $request->input('telefono'); 

		$personasNaturales = DB::select(DB::raw("SELECT idPersonaNatural FROM px_conciliacion.persona_natural where concat(nombre,' ', apellidoPaterno, ' ', apellidoMaterno) like :nombre AND dni like :dni AND telefono like :telefono"), ['nombre' => '%'.$nombre.'%', 'dni' => '%'.$dni.'%', 'telefono' => '%'.$telefono.'%']);

		$listaPersonasNaturales = [];
		foreach ($personasNaturales as $personaNatural)
			array_push($listaPersonasNaturales, $personaNatural->idPersonaNatural);

		$resultadoNatural = ExpedienteClienteLegal::whereIn('idPersonaNatural', $listaPersonasNaturales);


		//Persona Jurdica
		$razonSocial = $request->input('razonSocial'); 
		$ruc = $request->input('ruc'); 
		$telefono = $request->input('telefono'); 

		$personasJuridicas = DB::select(DB::raw("SELECT idPersonaJuridica FROM px_conciliacion.persona_juridica where razonSocial like :razonSocial AND ruc like :ruc AND telefono like :telefono"), ['razonSocial' => '%'.$razonSocial.'%', 'ruc' => '%'.$ruc.'%', 'telefono' => '%'.$telefono.'%']);

		$listaPersonasJuridicas = [];
		foreach($personasJuridicas as $personaJuridica)
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

		$resultado = $resultadoJuridico->union($resultadoNatural);
		
        return $resultado->get();
    }

}
