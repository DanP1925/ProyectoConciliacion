<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ExpedienteEquipoLegal extends Model {

    /**
     * Generated
     */

    protected $table = 'expediente_equipo_legal';
    protected $fillable = ['idExpedienteEquipoLegal', 'idExpediente', 'idArbitroUnico', 'idPresidenteTribunal', 'idArbitroDemandante', 'idArbitroDemandado', 'tipDesArbitroUnico', 'tipDesPresidenteTribunal', 'tipDesArbitroDemandante', 'tipDesArbitroDemandado'];


    public function tipDesArbitroUnico() {
        return $this->belongsTo(\App\Http\Models\DesignacionTipo::class, 'tipDesArbitroUnico', 'idDesignacionTipo');
    }

    public function tipDesPresidenteTribunal() {
        return $this->belongsTo(\App\Http\Models\DesignacionTipo::class, 'tipDesPresidenteTribunal', 'idDesignacionTipo');
    }

    public function tipDesArbitroDemandante() {
        return $this->belongsTo(\App\Http\Models\DesignacionTipo::class, 'tipDesArbitroDemandante', 'idDesignacionTipo');
    }

    public function tipDesArbitroDemandado() {
        return $this->belongsTo(\App\Http\Models\DesignacionTipo::class, 'tipDesArbitroDemandado', 'idDesignacionTipo');
    }

    public function expediente() {
        return $this->belongsTo(\App\Http\Models\Expediente::class, 'idExpediente', 'idExpediente');
    }

    public function arbitroUnico() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idArbitroUnico', 'idUsuarioLegal');
    }

    public function presidenteTribunal() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idPresidenteTribunal', 'idUsuarioLegal');
    }

    public function arbitroDemandante() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idArbitroDemandante', 'idUsuarioLegal');
    }

    public function arbitroDemandado() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idArbitroDemandado', 'idUsuarioLegal');
    }


}
