<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Arbitraje extends Model {

    /**
     * Generated
     */

    protected $table = 'arbitraje';
    protected $fillable = ['idArbitraje', 'idArbitrajeTipoOrigen', 'idArbitrajeEstado', 'idArbitrajePeritaje', 'idArbitrajeMontoContrato', 'idCorteArbitraje', 'añoContrato', 'fechaInstalacion', 'fechaAFPC', 'fechaInformeOral', 'fechaDesignacionCorteArbitraje', 'flagReconvencion', 'flagLiquidacion', 'flagReliquidacion'];


    public function arbitrajeEstado() {
        return $this->belongsTo(\App\Http\Models\ArbitrajeEstado::class, 'idArbitrajeEstado', 'idArbitrajeEstado');
    }

    public function arbitrajeMontoContrato() {
        return $this->belongsTo(\App\Http\Models\ArbitrajeMontoContrato::class, 'idArbitrajeMontoContrato', 'idArbitrajeMontoContrato');
    }

    public function arbitrajePeritaje() {
        return $this->belongsTo(\App\Http\Models\ArbitrajePeritaje::class, 'idArbitrajePeritaje', 'idArbitrajePeritaje');
    }

    public function arbitrajeTipoOrigen() {
        return $this->belongsTo(\App\Http\Models\ArbitrajeTipoOrigen::class, 'idArbitrajeTipoOrigen', 'idArbitrajeTipoOrigen');
    }

    public function usuarioLegal() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idCorteArbitraje', 'idUsuario_legal');
    }

    public function regions() {
        return $this->belongsToMany(\App\Http\Models\Region::class, 'arbitraje_region', 'idArbitraje', 'idRegion');
    }

    public function arbitrajeEquipos() {
        return $this->hasMany(\App\Http\Models\ArbitrajeEquipo::class, 'idArbitraje', 'idArbitraje');
    }

    public function arbitrajeRegions() {
        return $this->hasMany(\App\Http\Models\ArbitrajeRegion::class, 'idArbitraje', 'idArbitraje');
    }

    public function expedientes() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idArbitraje', 'idArbitraje');
    }

    public function laudos() {
        return $this->hasMany(\App\Http\Models\Laudo::class, 'idArbitraje', 'idArbitraje');
    }


}
