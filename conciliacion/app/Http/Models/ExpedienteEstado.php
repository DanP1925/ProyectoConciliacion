<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ExpedienteEstado extends Model {

    /**
     * Generated
     */

    protected $table = 'expediente_estado';
    protected $fillable = ['idExpedienteEstado', 'nombre'];


    public function expedientes() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idExpedienteEstado', 'idExpedienteEstado');
    }


}
