<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class JerarquiaExpediente extends Model {

    /**
     * Generated
     */

    protected $table = 'jerarquia_expedientes';
    protected $fillable = ['idExpediente', 'idExpedienteAsociado', 'numeroNivel', 'flgTope', 'flgFondo'];


    public function expediente() {
        return $this->belongsTo(\App\Http\Models\Expediente::class, 'idExpediente', 'idExpediente');
    }

    public function expedienteAsociado() {
        return $this->belongsTo(\App\Http\Models\Expediente::class, 'idExpedienteAsociado', 'idExpediente');
    }


}
