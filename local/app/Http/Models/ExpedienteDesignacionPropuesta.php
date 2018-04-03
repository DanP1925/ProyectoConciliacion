<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ExpedienteDesignacionPropuesta extends Model {

    // FIX FOR : "Unknown column 'updated_at'"
    public $timestamps = false;

    protected $table = 'expediente_designacion_propuesta';
    protected $fillable = ['idExpedienteDesignacionPropuesta', 'idExpedienteDesignacion', 'idUsuarioLegal', 'fecha', 'observacion', 'flgTipoDesignacion', 'estado'];


    public function expedienteDesignacion() {
        return $this->belongsTo(\App\Http\Models\ExpedienteDesignacion::class, 'idExpedienteDesignacion', 'idExpedienteDesignacion');
    }

    public function usuarioLegal() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idUsuarioLegal', 'idUsuarioLegal');
    }


}
