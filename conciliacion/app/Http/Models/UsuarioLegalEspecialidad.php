<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioLegalEspecialidad extends Model {

    /**
     * Generated
     */

    protected $table = 'usuario_legal_especialidad';
    protected $fillable = ['idUsuarioLegal', 'idLegalEspecialidad'];


    public function legalEspecialidad() {
        return $this->belongsTo(\App\Http\Models\LegalEspecialidad::class, 'idLegalEspecialidad', 'idLegalEspecialidad');
    }

    public function usuarioLegal() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idUsuarioLegal', 'idUsuarioLegal');
    }


}
