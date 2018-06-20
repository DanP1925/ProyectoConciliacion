<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class IncidenteTipo extends Model {

    // FIX FOR : "Unknown column 'updated_at'"
    public $timestamps = false;

    protected $table = 'incidente_tipo';
    protected $fillable = ['idIncidenteTipo', 'nombre'];


    public function incidentes() {
        return $this->hasMany(\App\Http\Models\Incidente::class, 'idIncidenteTipo', 'idIncidenteTipo');
    }

    public function incidenteFechas() {
        return $this->hasMany(\App\Http\Models\IncidenteFecha::class, 'idIncidenteTipo', 'idIncidenteTipo');
    }


}
