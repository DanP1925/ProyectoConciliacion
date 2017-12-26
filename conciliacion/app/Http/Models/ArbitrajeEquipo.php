<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ArbitrajeEquipo extends Model {

    /**
     * Generated
     */

    protected $table = 'arbitraje_equipo';
    protected $fillable = ['idArbitrajeEquipo', 'idArbitraje', 'idArbitroDemandante', 'idArbitroDemandado', 'idPresidenteTribunal', 'idArbitroUnico', 'emailArbitroDemandante', 'emailArbitroDemandado', 'emailPresidenteTribunal', 'emailArbitroUnico'];


    public function arbitraje() {
        return $this->belongsTo(\App\Http\Models\Arbitraje::class, 'idArbitraje', 'idArbitraje');
    }

    public function usuarioLegal() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idArbitroDemandante', 'idUsuario_legal');
    }

    public function arbitroDemandado() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idArbitroDemandado', 'idUsuario_legal');
    }

    public function presidenteTribunal() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idPresidenteTribunal', 'idUsuario_legal');
    }

    public function arbitroUnico() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idArbitroUnico', 'idUsuario_legal');
    }


}
