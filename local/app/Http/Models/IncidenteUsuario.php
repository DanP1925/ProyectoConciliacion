<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class IncidenteUsuario extends Model {

    // FIX FOR : "Unknown column 'updated_at'"
    public $timestamps = false;

    protected $table = 'incidente_usuario';
    protected $fillable = ['idIncidenteUsuario', 'idIncidente', 'idUsuarioIncidente'];


    public function incidente() {
        return $this->belongsTo(\App\Http\Models\Incidente::class, 'idIncidente', 'idIncidente');
    }

    public function usuarioIncidente() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idUsuarioIncidente', 'idUsuarioLegal');
    }


}
