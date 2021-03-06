<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ExpedienteSubtipoCaso extends Model {

    /**
     * Generated
     */

    protected $table = 'expediente_subtipo_caso';
    protected $fillable = ['idExpedienteSubtipoCaso', 'nombre'];


    public function expedientes() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idExpedienteSubtipoCaso', 'idExpedienteSubtipoCaso');
    }


}
