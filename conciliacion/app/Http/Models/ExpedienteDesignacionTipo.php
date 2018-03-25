<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ExpedienteDesignacionTipo extends Model {

    /**
     * Generated
     */

    protected $table = 'expediente_designacion_tipo';
    protected $fillable = ['idExpedienteDesignacionTipo', 'nombre'];


    public function expedienteDesignacions() {
        return $this->hasMany(\App\Http\Models\ExpedienteDesignacion::class, 'idExpedienteDesignacionTipo', 'idExpedienteDesignacionTipo');
    }


}
