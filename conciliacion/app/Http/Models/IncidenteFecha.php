<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class IncidenteFecha extends Model {

    /**
     * Generated
     */

    protected $table = 'incidente_fecha';
    protected $fillable = ['idIncidenteFecha', 'idIncidenteTipo', 'nombre', 'orden'];


    public function incidenteTipo() {
        return $this->belongsTo(\App\Http\Models\IncidenteTipo::class, 'idIncidenteTipo', 'idIncidenteTipo');
    }

    public function incidentes() {
        return $this->belongsToMany(\App\Http\Models\Incidente::class, 'Incidente_detalle', 'idIncidenteFecha', 'idIncidente');
    }

    public function incidenteDetalles() {
        return $this->hasMany(\App\Http\Models\IncidenteDetalle::class, 'idIncidenteFecha', 'idIncidenteFecha');
    }


}
