<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class IncidenteObservacion extends Model {

    // FIX FOR : "Unknown column 'updated_at'"
    public $timestamps = false;

    protected $table = 'incidente_observacion';
    protected $fillable = ['idIncidenteObservacion', 'idIncidente', 'observacion'];


    public function incidente() {
        return $this->belongsTo(\App\Http\Models\Incidente::class, 'idIncidente', 'idIncidente');
    }


}
