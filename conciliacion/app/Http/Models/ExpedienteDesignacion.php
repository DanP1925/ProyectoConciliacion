<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ExpedienteDesignacion extends Model {

    /**
     * Generated
     */

    protected $table = 'expediente_designacion';
    protected $fillable = ['idExpedienteDesignacion', 'idExpediente', 'idExpedienteDesignacionTipo', 'fecha'];


    public function expediente() {
        return $this->belongsTo(\App\Http\Models\Expediente::class, 'idExpediente', 'idExpediente');
    }

    public function expedienteDesignacionTipo() {
        return $this->belongsTo(\App\Http\Models\ExpedienteDesignacionTipo::class, 'idExpedienteDesignacionTipo', 'idExpedienteDesignacionTipo');
    }

    public function usuarioLegals() {
        return $this->belongsToMany(\App\Http\Models\UsuarioLegal::class, 'expediente_designacion_propuesta', 'idExpedienteDesignacion', 'idUsuarioLegal');
    }

    public function expedienteDesignacionPropuesta() {
        return $this->hasMany(\App\Http\Models\ExpedienteDesignacionPropuesta::class, 'idExpedienteDesignacion', 'idExpedienteDesignacion');
    }


}
