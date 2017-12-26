<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class DesignacionPropuesta extends Model {

    /**
     * Generated
     */

    protected $table = 'designacion_propuesta';
    protected $fillable = ['idDesignacionPropuesta', 'idExpediente', 'idUsuario_legal', 'fecha', 'flagResultado'];


    public function expediente() {
        return $this->belongsTo(\App\Http\Models\Expediente::class, 'idExpediente', 'idExpediente');
    }

    public function usuarioLegal() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idUsuario_legal', 'idUsuario_legal');
    }

    public function designacionTipos() {
        return $this->belongsToMany(\App\Http\Models\DesignacionTipo::class, 'designacion', 'idDesignacionPropuesta', 'idDesignacionTipo');
    }

    public function designacions() {
        return $this->hasMany(\App\Http\Models\Designacion::class, 'idDesignacionPropuesta', 'idDesignacionPropuesta');
    }


}
