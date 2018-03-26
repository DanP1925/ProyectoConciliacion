<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Expediente extends Model {

    /**
     * Generated
     */

    protected $table = 'expediente';
    protected $fillable = ['idExpediente', 'idExpedienteEstado', 'idExpedienteTipoCaso', 'idExpedienteSubtipoCaso', 'idDemandante', 'idDemandado', 'idCuantiaTipo', 'idCuantiaEscalaPago', 'idArbitrajeOrigen', 'idArbitrajeMontoContrato', 'idLaudoResultado', 'idLaudoEjecucion', 'idLaudoAFavor', 'idSecretarioLider', 'idSecretarioResponsable', 'numero', 'numeroAsociado', 'fechaSolicitud', 'cuantiaMontoInicial', 'cuantiaMontoFinal', 'arbitrajeAnhoContrato', 'laudofecha', 'laudoMontoResultado'];

    public function arbitrajeMontoContrato() {
        return $this->belongsTo(\App\Http\Models\ArbitrajeMontoContrato::class, 'idArbitrajeMontoContrato', 'idArbitrajeMontoContrato');
    }

    public function arbitrajeOrigen() {
        return $this->belongsTo(\App\Http\Models\ArbitrajeOrigen::class, 'idArbitrajeOrigen', 'idArbitrajeOrigen');
    }

    public function expedienteDemandante() {
        return $this->belongsTo(\App\Http\Models\ExpedienteClienteLegal::class, 'idDemandante', 'idExpedienteClienteLegal');
    }

    public function expedienteDemandado() {
        return $this->belongsTo(\App\Http\Models\ExpedienteClienteLegal::class, 'idDemandado', 'idExpedienteClienteLegal');
    }

    public function cuantiaEscalaPago() {
        return $this->belongsTo(\App\Http\Models\CuantiaEscalaPago::class, 'idCuantiaEscalaPago', 'idCuantiaEscalaPago');
    }

	public function cuantiaTipo(){
        return $this->belongsTo(\App\Http\Models\CuantiaTipo::class, 'idCuantiaTipo', 'idCuantiaTipo');
	}

    public function expedienteEstado() {
        return $this->belongsTo(\App\Http\Models\ExpedienteEstado::class, 'idExpedienteEstado', 'idExpedienteEstado');
    }

    public function expedienteTipoCaso() {
        return $this->belongsTo(\App\Http\Models\ExpedienteTipoCaso::class, 'idExpedienteTipoCaso', 'idExpedienteTipoCaso');
    }

    public function expedienteSubtipoCaso() {
        return $this->belongsTo(\App\Http\Models\ExpedienteSubtipoCaso::class, 'idExpedienteSubtipoCaso', 'idExpedienteSubtipoCaso');
    }

    public function laudoAFavor() {
        return $this->belongsTo(\App\Http\Models\LaudoAFavor::class, 'idLaudoAFavor', 'idLaudoAFavor');
    }

    public function laudoEjecucion() {
        return $this->belongsTo(\App\Http\Models\LaudoEjecucion::class, 'idLaudoEjecucion', 'idLaudoEjecucion');
    }

    public function laudoResultado() {
        return $this->belongsTo(\App\Http\Models\LaudoResultado::class, 'idLaudoResultado', 'idLaudoResultado');
    }

    public function regions() {
        return $this->belongsToMany(\App\Http\Models\Region::class, 'region_controversia', 'idExpediente', 'idRegion');
    }

    public function expedienteEquipoLegals() {
        return $this->hasMany(\App\Http\Models\ExpedienteEquipoLegal::class, 'idExpediente', 'idExpediente');
    }

    public function incidentes() {
        return $this->hasMany(\App\Http\Models\Incidente::class, 'idExpediente', 'idExpediente');
    }

    public function laudoRecursoPresentados() {
        return $this->hasMany(\App\Http\Models\LaudoRecursoPresentado::class, 'idExpediente', 'idExpediente');
    }

    public function regionControversia() {
        return $this->hasMany(\App\Http\Models\RegionControversium::class, 'idExpediente', 'idExpediente');
    }

	public function secretarioLider(){
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idSecretarioLider', 'idUsuarioLegal');
	}

	public function sercretarioResponsable(){
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idSecretarioResponsable', 'idUsuarioLegal');
	}

	public static function insertarExpediente(Request $request){
		$idExpediente = DB::table('expediente')->insertGetId(
			['idExpedienteEstado' => $request->input('estadoExpediente'),
			'idExpedienteTipoCaso' => $request->input('tipoCaso'),
			'idExpedienteSubtipoCaso' => $request->input('subtipoCaso'),
			'idDemandante' => $request->input('idDemandante'),
			'idDemandado' => $request->input('idDemandado'),
			'idCuantiaTipo' => $request->input('tipoCuantia'),
			'idCuantiaEscalaPago' => $request->input('escalaPago'),
			'idArbitrajeOrigen' => $request->input('origenArbitraje'),
			'idArbitrajeMontoContrato' => $request->input('montoContrato'),
			'idLaudoResultado' => $request->input('resultadoLaudo'),
			'idLaudoEjecucion' => $request->input('ejecucionLaudo'),
			'idLaudoAFavor' => $request->input('laudadoAFavor'),
			'idSecretarioLider' => $request->input('idSecretarioLider'),
			'idSecretarioResponsable' => $request->input('idSecretarioResponsable'),
			'numero' => $request->input('numero'),
			'numeroAsociado' => $request->input('numeroAsociado'),
			'fechaSolicitud' => $request->input('fechaSolicitud'),
			'cuantiaMontoInicial' => $request->input('cuantiaControversiaInicial'),
			'cuantiaMontoFinal' => $request->input('cuantiaControversiaFinal'),
			'arbitrajeAnhoContrato' => $request->input('anhoContrato'),
			'laudofecha' => $request->input('fechaLaudo'),
			'laudoMontoResultado' => $request->input('resultadoEnSoles')]
		);

		return $idExpediente;
	}

	public static function actualizarExpediente($idExpediente, Request $request){
		DB::table('expediente')->where('idExpediente',$idExpediente)->update
			(['idExpedienteEstado' => $request->input('estadoExpediente'),
			'idExpedienteTipoCaso' => $request->input('tipoCaso'),
			'idExpedienteSubtipoCaso' => $request->input('subtipoCaso'),
			'idDemandante' => $request->input('idDemandante'),
			'idDemandado' => $request->input('idDemandado'),
			'idCuantiaTipo' => $request->input('tipoCuantia'),
			'idCuantiaEscalaPago' => $request->input('escalaPago'),
			'idArbitrajeOrigen' => $request->input('origenArbitraje'),
			'idArbitrajeMontoContrato' => $request->input('montoContrato'),
			'idLaudoResultado' => $request->input('resultadoLaudo'),
			'idLaudoEjecucion' => $request->input('ejecucionLaudo'),
			'idLaudoAFavor' => $request->input('laudadoAFavor'),
			'idSecretarioLider' => $request->input('idSecretarioLider'),
			'idSecretarioResponsable' => $request->input('idSecretarioResponsable'),
			'numero' => $request->input('numero'),
			'numeroAsociado' => $request->input('numeroAsociado'),
			'fechaSolicitud' => $request->input('fechaSolicitud'),
			'cuantiaMontoInicial' => $request->input('cuantiaControversiaInicial'),
			'cuantiaMontoFinal' => $request->input('cuantiaControversiaFinal'),
			'arbitrajeAnhoContrato' => $request->input('anhoContrato'),
			'laudofecha' => $request->input('fechaLaudo'),
			'laudoMontoResultado' => $request->input('resultadoEnSoles')]
		);
	}

	public static function buscarExpediente(Request $request){
		$numero = $request->input('numero');
		$resultadoJuridico = Expediente::where('numero','LIKE','%'.$numero.'%');
		$resultadoNatural = Expediente::where('numero','LIKE','%'.$numero.'%');

		if (!is_null($request->input('fechaInicio'))){
			$fechaInicio = $request->input('fechaInicio');
			$resultadoJuridico = $resultadoJuridico->where('fechaSolicitud','>',$fechaInicio);
			$resultadoNatural = $resultadoNatural->where('fechaSolicitud','>',$fechaInicio);
		}

		if (!is_null($request->input('fechaFin'))){
			$fechaFin = $request->input('fechaFin');
			$resultadoJuridico = $resultadoJuridico->where('fechaSolicitud','<',$fechaFin);
			$resultadoNatural = $resultadoNatural->where('fechaSolicitud','<',$fechaFin);
		}

		if (!is_null($request->input('demandante'))){
			$nombreDemandante = $request->input('demandante');

			//Persona Juridica
			$personasJuridicas = DB::table('persona_juridica')->where('razonSocial','LIKE','%'.$nombreDemandante.'%')->get();
			$listaPersonasJuridicas = [];
			foreach($personasJuridicas as $personaJuridica){
				array_push($listaPersonasJuridicas , $personaJuridica->idPersonaJuridica);
			}
			$clientesJuridicos = DB::table('expediente_cliente_legal')->whereIn('idPersonaJuridica',$listaPersonasJuridicas)->get();
			$listaClientesJuridicos = [];
			foreach($clientesJuridicos as $clienteJuridico){
				array_push($listaClientesJuridicos, $clienteJuridico->idExpedienteClienteLegal);
			}
			$expedientesJuridicos = $resultadoJuridico->whereIn('idDemandante',$listaClientesJuridicos); 

			//Persona Natural
			$personasNaturales = DB::table('persona_natural')->where('nombre','LIKE','%'.$nombreDemandante.'%');
			$personasNaturales = $personasNaturales->where('apellidoPaterno','LIKE','%'.$nombreDemandante.'%');
			$personasNaturales = $personasNaturales->where('apellidoMaterno','LIKE','%'.$nombreDemandante.'%')->get();

			$listaPersonasNaturales = [];
			foreach($personasNaturales as $personaNatural){
				array_push($listaPersonasNaturales, $personaNatural->idPersonaNatural);
			}
			$clientesNaturales = DB::table('expediente_cliente_legal')->whereIn('idPersonaNatural',$listaPersonasNaturales)->get();
			$listaClientesNaturales = [];
			foreach($clientesNaturales as $clienteNatural){
				array_push($listaClientesNaturales, $clienteNatural->idExpedienteClienteLegal);
			}
			$expedientesNaturales = $resultadoNatural->whereIn('idDemandante',$listaClientesNaturales); 

			$resultado = $expedientesJuridicos->union($expedientesNaturales);
			$resultado = $resultado->distinct();

		}

		return $resultado->get();
	}

	public function getFecha(){
		return explode(" ",$this->fechaSolicitud)[0];
	}

	public function getTipoCaso(){
		$tipoCaso = DB::table('expediente_tipo_caso')->where('idExpedienteTipoCaso',$this->idExpedienteTipoCaso)->first();
		return $tipoCaso->nombre;
	}

	public function getSubtipoCaso(){
		$subtipoCaso = DB::table('expediente_subtipo_caso')->where('idExpedienteSubtipoCaso',$this->idExpedienteSubtipoCaso)->first();
		return $subtipoCaso->nombre;
	}

	public function getDemandante(){
		$clienteLegal = DB::table('expediente_cliente_legal')->where('idExpedienteClienteLegal',$this->idDemandante)->first();
		if ($clienteLegal->flgTipoPersona == 'J'){
			$personaJuridica = DB::table('persona_juridica')->where('idPersonaJuridica',$clienteLegal->idPersonaJuridica)->first();
			$nombre = $personaJuridica->razonSocial;
		} else {
			$personaNatural = DB::table('persona_natural')->where('idPersonaNatural',$clienteLegal->idPersonaNatural)->first();
			$nombre = ($personaNatural->nombre).' '.($personaNatural->apellidoPaterno).' '.($personaNatural->apellidoMaterno);
		}
		return $nombre;
	}
	
	public function getDemandado(){
		$clienteLegal = DB::table('expediente_cliente_legal')->where('idExpedienteClienteLegal',$this->idDemandado)->first();
		if ($clienteLegal->flgTipoPersona == 'J'){
			$personaJuridica = DB::table('persona_juridica')->where('idPersonaJuridica',$clienteLegal->idPersonaJuridica)->first();
			$nombre = $personaJuridica->razonSocial;
		} else {
			$personaNatural = DB::table('persona_natural')->where('idPersonaNatural',$clienteLegal->idPersonaNatural)->first();
			$nombre = ($personaNatural->nombre).' '.($personaNatural->apellidoPaterno).' '.($personaNatural->apellidoMaterno);
		}
		return $nombre;
	}

	public function getSecretarioResponsable(){
		$usuario = DB::table('usuario_legal')->where('idUsuarioLegal',$this->idSecretarioResponsable)->first();
		if (!is_null($usuario))
			return ($usuario->nombre).' '.($usuario->apellidoPaterno).' '.($usuario->apellidoMaterno);
		else
			return "";
	}

	public function getSecretarioLider(){
		$usuario = DB::table('usuario_legal')->where('idUsuarioLegal',$this->idSecretarioLider)->first();
		if (!is_null($usuario))
			return ($usuario->nombre).' '.($usuario->apellidoPaterno).' '.($usuario->apellidoMaterno);
		else
			return "";
	}
}
