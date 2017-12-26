<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioLegal extends Model {

    /**
     * Generated
     */

    protected $table = 'usuario_legal';
    protected $fillable = ['idUsuario_legal', 'idUsuarioLegalTipo', 'idUsuarioLegalProfesion', 'idUsuarioLegalPais', 'nombre', 'apellidoPaterno', 'apellidoMaterno', 'dni', 'email', 'telefono', 'rutaCv'];


    public function usuarioLegalPai() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegalPai::class, 'idUsuarioLegalPais', 'idUsuarioLegalPais');
    }

    public function usuarioLegalProfesion() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegalProfesion::class, 'idUsuarioLegalProfesion', 'idUsuarioLegalProfesion');
    }

    public function usuarioLegalTipo() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegalTipo::class, 'idUsuarioLegalTipo', 'idUsuarioLegalTipo');
    }

    public function legalEspecialidads() {
        return $this->belongsToMany(\App\Http\Models\LegalEspecialidad::class, 'usuario_legal_especialidad', 'idUsuarioLegal', 'idLegalEspecialidad');
    }

    public function arbitrajes() {
        return $this->hasMany(\App\Http\Models\Arbitraje::class, 'idCorteArbitraje', 'idUsuario_legal');
    }

    public function arbitrajeEquipos() {
        return $this->hasMany(\App\Http\Models\ArbitrajeEquipo::class, 'idArbitroDemandante', 'idUsuario_legal');
    }

    public function arbitroDemandado() {
        return $this->hasMany(\App\Http\Models\ArbitrajeEquipo::class, 'idArbitroDemandado', 'idUsuario_legal');
    }

    public function presidenteTribunal() {
        return $this->hasMany(\App\Http\Models\ArbitrajeEquipo::class, 'idPresidenteTribunal', 'idUsuario_legal');
    }

    public function arbitroUnico() {
        return $this->hasMany(\App\Http\Models\ArbitrajeEquipo::class, 'idArbitroUnico', 'idUsuario_legal');
    }

    public function clienteLegals() {
        return $this->hasMany(\App\Http\Models\ClienteLegal::class, 'idUsuarioLegal', 'idUsuario_legal');
    }

    public function designacionPropuesta() {
        return $this->hasMany(\App\Http\Models\DesignacionPropuesta::class, 'idUsuario_legal', 'idUsuario_legal');
    }

    public function secretarioResponsable() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idSecretarioResponsable', 'idUsuario_legal');
    }

    public function secretarioLider() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idSecretarioLider', 'idUsuario_legal');
    }

    public function facturas() {
        return $this->hasMany(\App\Http\Models\Factura::class, 'idSecretarioArbitral', 'idUsuario_legal');
    }

    public function incidentes() {
        return $this->hasMany(\App\Http\Models\Incidente::class, 'idSecretario', 'idUsuario_legal');
    }

    public function usuarioLegalEspecialidads() {
        return $this->hasMany(\App\Http\Models\UsuarioLegalEspecialidad::class, 'idUsuarioLegal', 'idUsuario_legal');
    }


}
