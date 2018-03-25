<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class DesignacionTipo extends Model {

    /**
     * Generated
     */

    protected $table = 'designacion_tipo';
    protected $fillable = ['idDesignacionTipo', 'nombre'];


    public function expedienteEquipoLegals() {
        return $this->hasMany(\App\Http\Models\ExpedienteEquipoLegal::class, 'tipDesArbitroUnico', 'idDesignacionTipo');
    }

    public function expedienteEquipoLegals() {
        return $this->hasMany(\App\Http\Models\ExpedienteEquipoLegal::class, 'tipDesPresidenteTribunal', 'idDesignacionTipo');
    }

    public function expedienteEquipoLegals() {
        return $this->hasMany(\App\Http\Models\ExpedienteEquipoLegal::class, 'tipDesArbitroDemandante', 'idDesignacionTipo');
    }

    public function expedienteEquipoLegals() {
        return $this->hasMany(\App\Http\Models\ExpedienteEquipoLegal::class, 'tipDesArbitroDemandado', 'idDesignacionTipo');
    }


}
