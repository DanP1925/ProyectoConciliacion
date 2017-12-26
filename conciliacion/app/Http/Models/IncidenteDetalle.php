<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class IncidenteDetalle extends Model {

    /**
     * Generated
     */

    protected $table = 'Incidente_detalle';
    protected $fillable = ['idIncidenteSeguimiento', 'idIncidente', 'idIncidenteFecha', 'fecha'];


    public function incidente() {
        return $this->belongsTo(\App\Http\Models\Incidente::class, 'idIncidente', 'idIncidente');
    }

    public function incidenteFecha() {
        return $this->belongsTo(\App\Http\Models\IncidenteFecha::class, 'idIncidenteFecha', 'idIncidenteFecha');
    }


}
