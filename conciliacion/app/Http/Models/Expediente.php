<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Expediente extends Model {

    /**
     * Generated
     */

    protected $table = 'expediente';
    protected $fillable = ['idExpediente', 'idExpedienteEstado', 'idExpedienteTipoCaso', 'idExpedienteSubtipoCaso', 'idDemandante', 'idDemandado', 'idCuantiaTipo', 'idCuantiaEscalaPago', 'idArbitrajeOrigen', 'idArbitrajeMontoContrato', 'idLaudoResultado', 'idLaudoEjecucion', 'idLaudoAFavor', 'idSecretarioLider', 'idSecretarioResponsable', 'numeroExpediente', 'numeroExpedienteAsociado', 'fechaSolicitud', 'cuantiaMontoInicial', 'cuantiaMontoFinal', 'arbitrajeAnhoContrato', 'laudofecha', 'laudoMontoResultado'];

	public function arbitrajeMontoContrato(){
        return $this->belongsTo(\App\Http\Models\ArbitrajeMontoContrato::class, 'idArbitrajeMontoContrato', 'idArbitrajeMontoContrato');
	}

	public function arbitrajeOrigen(){
        return $this->belongsTo(\App\Http\Models\ArbitrajeOrigen::class, 'idArbitrajeOrigen', 'idArbitrajeOrigen');
	}

	public function expedienteClienteLegal1(){
        return $this->belongsTo(\App\Http\Models\ExpedienteClienteLegal::class, 'idDemandante', 'idExpedienteClienteLegal');
	}

	public function expedienteClienteLegal2(){
        return $this->belongsTo(\App\Http\Models\ExpedienteClienteLegal::class, 'idDemandado', 'idExpedienteClienteLegal');
	}
	
	public function cuantiaEscalaPago(){
        return $this->belongsTo(\App\Http\Models\CuantiaEscalaPago::class, 'idCuantiaEscalaPago', 'idCuantiaEscalaPago');
	}

	public function cuantiaTipo(){
        return $this->belongsTo(\App\Http\Models\CuantiaTipo::class, 'idCuantiaTipo', 'idCuantiaTipo');
	}

	public function expedienteEstado(){
        return $this->belongsTo(\App\Http\Models\ExpedienteEstado::class, 'idExpedienteEstado', 'idExpedienteEstado');
	}

	public function expedienteTipoCaso(){
        return $this->belongsTo(\App\Http\Models\ExpedienteTipoCaso::class, 'idExpedienteTipoCaso', 'idExpedienteTipoCaso');
	}

	public function expedienteSubtipoCaso(){
        return $this->belongsTo(\App\Http\Models\ExpedienteSubtipoCaso::class, 'idExpedienteSubtipoCaso', 'idExpedienteSubtipoCaso');
	}

	public function laudoAFavor(){
        return $this->belongsTo(\App\Http\Models\LaudoAFavor::class, 'idLaudoAFavor', 'idLaudoAFavor');
	}

	public function secretarioLider(){
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idSecretarioLider', 'idUsuario_legal');
	}

	public function sercretarioResponsable(){
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idSecretarioResponsable', 'idUsuario_legal');
	}

	public function laudoEjecucion(){
        return $this->belongsTo(\App\Http\Models\LaudoEjecucion::class, 'idLaudoEjecucion', 'idLaudoEjecucion');
	}

	public function laudoResultado(){
        return $this->belongsTo(\App\Http\Models\LaudoResultado::class, 'idLaudoResultado', 'idLaudoResultado');
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
			'numeroExpediente' => $request->input('numeroExpediente'),
			'numeroExpedienteAsociado' => $request->input('numeroExpedienteAsociado'),
			'fechaSolicitud' => $request->input('fechaSolicitud'),
			'cuantiaMontoInicial' => $request->input('cuantiaControversiaInicial'),
			'cuantiaMontoFinal' => $request->input('cuantiaControversiaFinal'),
			'arbitrajeAnhoContrato' => $request->input('anhoContrato'),
			'laudofecha' => $request->input('fechaLaudo'),
			'laudoMontoResultado' => $request->input('resultadoEnSoles')]
		);

		return $idExpediente;
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
		$usuario = DB::table('usuario_legal')->where('idUsuario_legal',$this->idSecretarioResponsable)->first();
		return ($usuario->nombre).' '.($usuario->apellidoPaterno).' '.($usuario->apellidoMaterno);
	}

	public function getSecretarioLider(){
		$usuario = DB::table('usuario_legal')->where('idUsuario_legal',$this->idSecretarioLider)->first();
		return ($usuario->nombre).' '.($usuario->apellidoPaterno).' '.($usuario->apellidoMaterno);
	}
}
