<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Incidente extends Model {

    // FIX FOR : "Unknown column 'updated_at'"
    public $timestamps = false;

    protected $table = 'incidente';
    protected $fillable = ['idIncidente', 'idExpediente', 'idIncidenteTipo', 'idSecretario', 'fecha', 'estado'];


    public function expediente() {
        return $this->belongsTo(\App\Http\Models\Expediente::class, 'idExpediente', 'idExpediente');
    }

    public function incidenteTipo() {
        return $this->belongsTo(\App\Http\Models\IncidenteTipo::class, 'idIncidenteTipo', 'idIncidenteTipo');
    }

    public function incidenteSecretarios() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idSecretario', 'idUsuarioLegal');
    }

    public function incidenteFechas() {
        return $this->belongsToMany(\App\Http\Models\IncidenteFecha::class, 'Incidente_detalle', 'idIncidente', 'idIncidenteFecha');
    }

    public function usuarioLegals() {
        return $this->belongsToMany(\App\Http\Models\UsuarioLegal::class, 'incidente_usuario', 'idIncidente', 'idUsuarioIncidente');
    }

    public function incidenteDetalles() {
        return $this->hasMany(\App\Http\Models\IncidenteDetalle::class, 'idIncidente', 'idIncidente');
    }

    public function incidenteObservacions() {
        return $this->hasMany(\App\Http\Models\IncidenteObservacion::class, 'idIncidente', 'idIncidente');
    }

    public function incidenteUsuarios() {
        return $this->hasMany(\App\Http\Models\IncidenteUsuario::class, 'idIncidente', 'idIncidente');
    }


}
