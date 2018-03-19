<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Expediente extends Model {

    /**
     * Generated
     */

    protected $table = 'expediente';
    protected $fillable = ['idExpediente', 'idExpedienteEstado', 'idExpedienteTipoCaso', 'idExpedienteSubtipoCaso', 'idDemandante', 'idDemandado', 'idCuantiaTipo', 'idCuantiaEscalaPago', 'idArbitrajeOrigen', 'idArbitrajeMontoContrato', 'idLaudoResultado', 'idLaudoEjecucion', 'idLaudoAFavor', 'numeroExpediente', 'numeroExpedienteAsociado', 'fechaSolicitud', 'cuantiaMontoInicial', 'cuantiaMontoFinal', 'arbitrajeAnhoContrato', 'laudofecha', 'laudoMontoResultado'];

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
}
