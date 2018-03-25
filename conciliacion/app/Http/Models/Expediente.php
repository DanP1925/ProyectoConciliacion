<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model {

    /**
     * Generated
     */

    protected $table = 'expediente';
    protected $fillable = ['idExpediente', 'idExpedienteEstado', 'idExpedienteTipoCaso', 'idExpedienteSubtipoCaso', 'idDemandante', 'idDemandado', 'idCuantiaTipo', 'idCuantiaEscalaPago', 'idArbitrajeOrigen', 'idArbitrajeMontoContrato', 'idLaudoResultado', 'idLaudoEjecucion', 'idLaudoAFavor', 'numero', 'fechaSolicitud', 'cuantiaMontoInicial', 'cuantiaMontoFinal', 'arbitrajeAnhoContrato', 'laudofecha', 'laudoMontoResultado'];


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

    public function cuantiaTipo() {
        return $this->belongsTo(\App\Http\Models\CuantiaTipo::class, 'idCuantiaTipo', 'idCuantiaTipo');
    }

    public function expedienteEstado() {
        return $this->belongsTo(\App\Http\Models\ExpedienteEstado::class, 'idExpedienteEstado', 'idExpedienteEstado');
    }

    public function expedienteSubtipoCaso() {
        return $this->belongsTo(\App\Http\Models\ExpedienteSubtipoCaso::class, 'idExpedienteSubtipoCaso', 'idExpedienteSubtipoCaso');
    }

    public function expedienteTipoCaso() {
        return $this->belongsTo(\App\Http\Models\ExpedienteTipoCaso::class, 'idExpedienteTipoCaso', 'idExpedienteTipoCaso');
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


}
