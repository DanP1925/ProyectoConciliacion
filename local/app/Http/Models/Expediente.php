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
			'idArbitrajeMontoContrato' => (float) $request->input('montoContrato'),
			'idLaudoResultado' => $request->input('resultadoLaudo'),
			'idLaudoEjecucion' => $request->input('ejecucionLaudo'),
			'idLaudoAFavor' => $request->input('laudadoAFavor'),
			'idSecretarioLider' => $request->input('idSecretarioLider'),
			'idSecretarioResponsable' => $request->input('idSecretarioResponsable'),
			'numero' => $request->input('numero'),
			'numeroAsociado' => $request->input('numeroAsociado'),
			'fechaSolicitud' => $request->input('fechaSolicitud'),
			'cuantiaMontoInicial' => (float) $request->input('cuantiaControversiaInicial'),
			'cuantiaMontoFinal' => (float) $request->input('cuantiaControversiaFinal'),
			'arbitrajeAnhoContrato' => $request->input('anhoContrato'),
			'laudofecha' => $request->input('fechaLaudo'),
			'laudoMontoResultado' => (float) $request->input('resultadoEnSoles')]
		);
	}

	public static function eliminarExpediente($idExpediente){
		DB::table('expediente')->where('idExpediente',$idExpediente)->delete();
	}

	public static function buscarExpediente(Request $request){

		$numeroExpediente = $request->input('numeroExpediente');
		$resultado = Expediente::where('numero','LIKE','%'.$numeroExpediente.'%');	

		$fechaInicio = $request->input('fechaInicio');
		if (!is_null($fechaInicio))
			$resultado = $resultado->where('fechaSolicitud','>', $fechaInicio);

		$fechaFin = $request->input('fechaFin');
		if (!is_null($fechaFin))
			$resultado = $resultado->where('fechaSolicitud','<', $fechaFin);

		$estado = $request->input('estado');
		if (!is_null($estado))
			$resultado = $resultado->where('idExpedienteEstado','=', $estado);

		$tipoCaso = $request->input('tipoCaso');
		if (!is_null($tipoCaso))
			$resultado = $resultado->where('idExpedienteTipoCaso','=', $tipoCaso);

		$subtipoCaso = $request->input('subtipoCaso');
		if (!is_null($subtipoCaso))
			$resultado = $resultado->where('idExpedienteSubtipoCaso','=', $subtipoCaso);

		$secretarioResponsable = $request->input('secretarioResponsable');
		if (!is_null($secretarioResponsable)){
			$listaSecretarios = UsuarioLegal::getListaIdUsandoNombre($secretarioResponsable);
			$resultado = $resultado->whereIn('idSecretarioResponsable',$listaSecretarios);
		}

		$secretarioLider = $request->input('secretarioLider');
		if (!is_null($secretarioLider)){
			$listaSecretariosLider = UsuarioLegal::getListaIdUsandoNombre($secretarioLider);
			$resultado = $resultado->whereIn('idSecretarioLider',$listaSecretariosLider);
		}

		$demandante = $request->input('demandante');
		if (!is_null($demandante)){
			$resultado = Expediente::buscarDemandante($demandante, $resultado);
		}

		$demandado = $request->input('demandado');
		if (!is_null($demandado))
			$resultado = Expediente::buscarDemandado($demandado, $resultado);

		$miembroDemandante = $request->input('miembroDemandante');
		if (!is_null($miembroDemandante))
			$resultado = Expediente::buscarMiembroDemandante($miembroDemandante, $resultado);

		$miembroDemandado = $request->input('miembroDemandado');
		if (!is_null($miembroDemandado))
			$resultado = Expediente::buscarMiembroDemandado($miembroDemandado, $resultado);


		return $resultado->paginate(5);
	}

	private static function buscarDemandante($demandante,$resultado){

		//Persona Juridica
		$listaPersonasJuridicas = PersonaJuridica::getListaIdUsandoNombre($demandante);
		$listaClientesJuridicos = ExpedienteClienteLegal::getListaIdUsandoIdPersonaJuridica($listaPersonasJuridicas);
		$resultadoJuridico = DB::table('expediente')->whereIn('idDemandante',$listaClientesJuridicos); 
		$listaJuridica = [];
		foreach ($resultadoJuridico->get()->all() as $expedienteJuridico)
			array_push($listaJuridica,$expedienteJuridico->idExpediente);

		//Persona Natural
		$listaPersonasNaturales = PersonaNatural::getListaIdUsandoNombre($demandante);
		$listaClientesNaturales = ExpedienteClienteLegal::getListaIdUsandoIdPersonaNatural($listaPersonasNaturales);
		$resultadoNatural = DB::table('expediente')->whereIn('idDemandante',$listaClientesNaturales); 
		$listaNatural = [];
		foreach ($resultadoNatural->get()->all() as $expedienteNatural)
			array_push($listaNatural,$expedienteNatural->idExpediente);

		if (count($listaJuridica) != 0)
			$resultado = $resultado->whereIn('idExpediente',$listaJuridica);
		if (count($listaNatural) != 0)
			$resultado = $resultado->whereIn('idExpediente',$listaNatural);

		return $resultado;
	}

	private static function buscarDemandado($demandado,$resultado){

		//Persona Juridica
		$listaPersonasJuridicas = PersonaJuridica::getListaIdUsandoNombre($demandado);
		$listaClientesJuridicos = ExpedienteClienteLegal::getListaIdUsandoIdPersonaJuridica($listaPersonasJuridicas);
		$resultadoJuridico = DB::table('expediente')->whereIn('idDemandado',$listaClientesJuridicos); 
		$listaJuridica = [];
		foreach ($resultadoJuridico->get()->all() as $expedienteJuridico)
			array_push($listaJuridica,$expedienteJuridico->idExpediente);

		//Persona Natural
		$listaPersonasNaturales = PersonaNatural::getListaIdUsandoNombre($demandado);
		$listaClientesNaturales = ExpedienteClienteLegal::getListaIdUsandoIdPersonaNatural($listaPersonasNaturales);
		$resultadoNatural = DB::table('expediente')->whereIn('idDemandado',$listaClientesNaturales); 
		$listaNatural = [];
		foreach ($resultadoNatural->get()->all() as $expedienteNatural)
			array_push($listaNatural,$expedienteNatural->idExpediente);

		if (count($listaJuridica) != 0)
			$resultado = $resultado->whereIn('idExpediente',$listaJuridica);
		if (count($listaNatural) != 0)
			$resultado = $resultado->whereIn('idExpediente',$listaNatural);

		return $resultado;
	}

	public static function buscarMiembroDemandante($miembroDemandante, $resultado){

		//Persona Juridica
		$listaPersonasJuridicas = PersonaJuridica::getListaIdUsandoNombre($miembroDemandante);
		$listaConsorciosPersonaJuridicas = 
			ConsorcioPersonaDetalle::getListaIdConsorcioUsandoPersonaJuridica($listaPersonasJuridicas);
		$listaPersonasDeConsorciosJuridicos = 
			ConsorcioPersonaDetalle::getListaIdConsorcioUsandoConsorcioPersona($listaConsorciosPersonaJuridicas);
		$listaClientesJuridicos = 
			ExpedienteClienteLegal::getListaIdUsandoIdPersonaJuridica($listaPersonasDeConsorciosJuridicos);
		$resultadoJuridico = DB::table('expediente')->whereIn('idDemandante',$listaClientesJuridicos); 
		$listaJuridica = [];
		foreach ($resultadoJuridico->get()->all() as $expedienteJuridico)
			array_push($listaJuridica,$expedienteJuridico->idExpediente);
		
		//Persona Natural
		$listaPersonasNaturales = PersonaNatural::getListaIdUsandoNombre($miembroDemandante);
		$listaConsorciosPersonaNaturales =
			ConsorcioPersonaDetalle::getListaIdConsorcioUsandoPersonaNatural($listaPersonasNaturales);
		$listaPersonasDeConsorciosNaturales = 
			ConsorcioPersonaDetalle::getListaIdConsorcioUsandoConsorcioPersona($listaConsorciosPersonaNaturales);
		$listaClientesNaturales = 
			ExpedienteClienteLegal::getListaIdUsandoIdPersonaNatural($listaPersonasDeConsorciosNaturales);
		$resultadoNatural = DB::table('expediente')->whereIn('idDemandante',$listaClientesNaturales); 
		$listaNatural = [];
		foreach ($resultadoNatural->get()->all() as $expedienteNatural)
			array_push($listaNatural,$expedienteNatural->idExpediente);

		if (count($listaJuridica) != 0)
			$resultado = $resultado->whereIn('idExpediente',$listaJuridica);
		if (count($listaNatural) != 0)
			$resultado = $resultado->whereIn('idExpediente',$listaNatural);

		return $resultado;
	}

	public static function buscarMiembroDemandado($miembroDemandado, $resultado){

		//Persona Juridica
		$listaPersonasJuridicas = PersonaJuridica::getListaIdUsandoNombre($miembroDemandado);
		$listaConsorciosPersonaJuridicas = 
			ConsorcioPersonaDetalle::getListaIdConsorcioUsandoPersonaJuridica($listaPersonasJuridicas);
		$listaPersonasDeConsorciosJuridicos = 
			ConsorcioPersonaDetalle::getListaIdConsorcioUsandoConsorcioPersona($listaConsorciosPersonaJuridicas);
		$listaClientesJuridicos = 
			ExpedienteClienteLegal::getListaIdUsandoIdPersonaJuridica($listaPersonasDeConsorciosJuridicos);
		$resultadoJuridico = DB::table('expediente')->whereIn('idDemandado',$listaClientesJuridicos); 
		$listaJuridica = [];
		foreach ($resultadoJuridico->get()->all() as $expedienteJuridico)
			array_push($listaJuridica,$expedienteJuridico->idExpediente);
		
		//Persona Natural
		$listaPersonasNaturales = PersonaNatural::getListaIdUsandoNombre($miembroDemandado);
		$listaConsorciosPersonaNaturales =
			ConsorcioPersonaDetalle::getListaIdConsorcioUsandoPersonaNatural($listaPersonasNaturales);
		$listaPersonasDeConsorciosNaturales = 
			ConsorcioPersonaDetalle::getListaIdConsorcioUsandoConsorcioPersona($listaConsorciosPersonaNaturales);
		$listaClientesNaturales = 
			ExpedienteClienteLegal::getListaIdUsandoIdPersonaNatural($listaPersonasDeConsorciosNaturales);
		$resultadoNatural = DB::table('expediente')->whereIn('idDemandado',$listaClientesNaturales); 
		$listaNatural = [];
		foreach ($resultadoNatural->get()->all() as $expedienteNatural)
			array_push($listaNatural,$expedienteNatural->idExpediente);

		if (count($listaJuridica) != 0)
			$resultado = $resultado->whereIn('idExpediente',$listaJuridica);
		if (count($listaNatural) != 0)
			$resultado = $resultado->whereIn('idExpediente',$listaNatural);

		return $resultado;
	}

	public function getFecha(){
		$tmpFechaSolicitud = explode(" ",$this->fechaSolicitud);
		return $tmpFechaSolicitud[0];
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
