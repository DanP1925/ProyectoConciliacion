<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Incidente extends Model {

    /**
     * Generated
     */

    protected $table = 'incidente';
    protected $fillable = ['idIncidente', 'idIncidenteTipo', 'idExpediente', 'idSecretario', 'observaciones', 'estado'];


    public function expediente() {
        return $this->belongsTo(\App\Http\Models\Expediente::class, 'idExpediente', 'idExpediente');
    }

    public function incidenteTipo() {
        return $this->belongsTo(\App\Http\Models\IncidenteTipo::class, 'idIncidenteTipo', 'idIncidenteTipo');
    }

    public function usuarioLegal() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idSecretario', 'idUsuario_legal');
    }

    public function incidenteFechas() {
        return $this->belongsToMany(\App\Http\Models\IncidenteFecha::class, 'Incidente_detalle', 'idIncidente', 'idIncidenteFecha');
    }

    public function incidenteDetalles() {
        return $this->hasMany(\App\Http\Models\IncidenteDetalle::class, 'idIncidente', 'idIncidente');
    }


}
