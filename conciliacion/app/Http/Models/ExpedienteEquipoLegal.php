<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ExpedienteEquipoLegal extends Model {

	protected $table = 'expediente_equipo_legal';
    protected $fillable = ['idExpedienteEquipoLegal','idExpediente', 'idArbitroUnico', 'idPresidenteTribunal', 'idArbitroDemandante', 'idArbitroDemandado', 'tipDesArbitroUnico', 'tipDesPresidenteTribunal', 'tipDesArbitroDemandante', 'tipDesArbitroDemandado'];

    public function designacionTipo1() {
        return $this->belongsTo(\App\Http\Models\DesignacionTipo::class, 'tipDesArbitroUnico', 'idDesignacionTipo');
    }
	
    public function designacionTipo2() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'tipDesPresidenteTribunal', 'idDesignacionTipo');
    }

    public function designacionTipo3() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'tipDesArbitroDemandante', 'idDesignacionTipo');
    }

    public function designacionTipo4() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'tipDesArbitroDemandado', 'idDesignacionTipo');
    }

    public function expediente() {
        return $this->belongsTo(\App\Http\Models\Expediente::class, 'idExpediente', 'idExpediente');
    }

    public function usuarioLegal1() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idArbitroUnico', 'idUsuario_legal');
    }

    public function usuarioLegal2() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idPresidenteTribunal', 'idUsuario_legal');
    }

    public function usuarioLegal3() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idArbitroDemandante', 'idUsuario_legal');
    }

    public function usuarioLegal4() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idArbitroDemandado', 'idUsuario_legal');
    }

}
