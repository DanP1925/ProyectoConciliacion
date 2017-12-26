<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model {

    /**
     * Generated
     */

    protected $table = 'expediente';
    protected $fillable = ['idExpediente', 'idSecretarioResponsable', 'idSecretarioLider', 'idDemandante', 'idDemandado', 'idCuantiaDeterminada', 'idCuantiaTipo', 'idTipoCaso', 'idTipoCasoForma', 'idArbitraje', 'numero', 'fechaSolicitud', 'cuantiaControversia'];


    public function arbitraje() {
        return $this->belongsTo(\App\Http\Models\Arbitraje::class, 'idArbitraje', 'idArbitraje');
    }

    public function demandante() {
        return $this->belongsTo(\App\Http\Models\ClienteLegal::class, 'idDemandante', 'idClienteLegal');
    }

    public function demandado() {
        return $this->belongsTo(\App\Http\Models\ClienteLegal::class, 'idDemandado', 'idClienteLegal');
    }

    public function cuantiaDeterminada() {
        return $this->belongsTo(\App\Http\Models\CuantiaDeterminada::class, 'idCuantiaDeterminada', 'idCuantiaDeterminada');
    }

    public function cuantiaTipo() {
        return $this->belongsTo(\App\Http\Models\CuantiaTipo::class, 'idCuantiaTipo', 'idCuantiaTipo');
    }

    public function tipoCaso() {
        return $this->belongsTo(\App\Http\Models\TipoCaso::class, 'idTipoCaso', 'idTipoCaso');
    }

    public function tipoCasoForma() {
        return $this->belongsTo(\App\Http\Models\TipoCasoForma::class, 'idTipoCasoForma', 'idTipoCasoForma');
    }

    public function secretarioResponsable() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idSecretarioResponsable', 'idUsuario_legal');
    }

    public function secretarioLider() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idSecretarioLider', 'idUsuario_legal');
    }

    /*public function jerarquiaExpediente() {
        return $this->belongsToMany(\App\Http\Models\Expediente::class, 'jerarquia_expedientes', 'idExpediente', 'idExpedienteAsociado');
    }

    public function jerarquiaExpedienteAsociado() {
        return $this->belongsToMany(\App\Http\Models\Expediente::class, 'jerarquia_expedientes', 'idExpedienteAsociado', 'idExpediente');
    }
    */
    public function designacionPropuesta() {
        return $this->hasMany(\App\Http\Models\DesignacionPropuesta::class, 'idExpediente', 'idExpediente');
    }

    public function facturas() {
        return $this->hasMany(\App\Http\Models\Factura::class, 'idExpediente', 'idExpediente');
    }

    public function incidentes() {
        return $this->hasMany(\App\Http\Models\Incidente::class, 'idExpediente', 'idExpediente');
    }
    /*
    public function jerarquiaExpedientes() {
        return $this->hasMany(\App\Http\Models\JerarquiaExpediente::class, 'idExpediente', 'idExpediente');
    }

    public function jerarquiaExpedientes() {
        return $this->hasMany(\App\Http\Models\JerarquiaExpediente::class, 'idExpedienteAsociado', 'idExpediente');
    }
    */

}
