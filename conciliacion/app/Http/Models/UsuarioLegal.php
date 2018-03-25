<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioLegal extends Model {

    /**
     * Generated
     */

    protected $table = 'usuario_legal';
    protected $fillable = ['idUsuarioLegal', 'idUsuarioLegalTipo', 'idUsuarioLegalProfesion', 'idUsuarioLegalPais', 'apellidoPaterno', 'apellidoMaterno', 'nombre', 'dni', 'email', 'telefono', 'rutaCv'];


    public function usuarioLegalPais() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegalPais::class, 'idUsuarioLegalPais', 'idUsuarioLegalPais');
    }

    public function usuarioLegalProfesion() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegalProfesion::class, 'idUsuarioLegalProfesion', 'idUsuarioLegalProfesion');
    }

    public function usuarioLegalTipo() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegalTipo::class, 'idUsuarioLegalTipo', 'idUsuarioLegalTipo');
    }

    public function incidentes() {
        return $this->belongsToMany(\App\Http\Models\Incidente::class, 'incidente_usuario', 'idUsuarioIncidente', 'idIncidente');
    }

    public function legalEspecialidads() {
        return $this->belongsToMany(\App\Http\Models\LegalEspecialidad::class, 'usuario_legal_especialidad', 'idUsuarioLegal', 'idLegalEspecialidad');
    }

    public function expedienteRepresentanteLegals() {
        return $this->hasMany(\App\Http\Models\ExpedienteClienteLegal::class, 'idRepresentanteLegal', 'idUsuarioLegal');
    }

    public function expedienteArbitroUnicos() {
        return $this->hasMany(\App\Http\Models\ExpedienteEquipoLegal::class, 'idArbitroUnico', 'idUsuarioLegal');
    }

    public function expedientePresidenteTribunals() {
        return $this->hasMany(\App\Http\Models\ExpedienteEquipoLegal::class, 'idPresidenteTribunal', 'idUsuarioLegal');
    }

    public function expedienteArbitroDemandantes() {
        return $this->hasMany(\App\Http\Models\ExpedienteEquipoLegal::class, 'idArbitroDemandante', 'idUsuarioLegal');
    }

    public function expedienteArbitroDemandados() {
        return $this->hasMany(\App\Http\Models\ExpedienteEquipoLegal::class, 'idArbitroDemandado', 'idUsuarioLegal');
    }

    public function facturas() {
        return $this->hasMany(\App\Http\Models\Factura::class, 'idUsuarioCreador', 'idUsuarioLegal');
    }

    public function incidenteSecretarios() {
        return $this->hasMany(\App\Http\Models\Incidente::class, 'idSecretario', 'idUsuarioLegal');
    }

    public function incidenteUsuarios() {
        return $this->hasMany(\App\Http\Models\IncidenteUsuario::class, 'idUsuarioIncidente', 'idUsuarioLegal');
    }

    public function usuarioLegalEspecialidads() {
        return $this->hasMany(\App\Http\Models\UsuarioLegalEspecialidad::class, 'idUsuarioLegal', 'idUsuarioLegal');
    }


}
