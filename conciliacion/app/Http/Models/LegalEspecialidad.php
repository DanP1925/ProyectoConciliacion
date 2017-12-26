<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LegalEspecialidad extends Model {

    /**
     * Generated
     */

    protected $table = 'legal_especialidad';
    protected $fillable = ['idLegalEspecialidad', 'nombre'];


    public function usuarioLegals() {
        return $this->belongsToMany(\App\Http\Models\UsuarioLegal::class, 'usuario_legal_especialidad', 'idLegalEspecialidad', 'idUsuarioLegal');
    }

    public function usuarioLegalEspecialidads() {
        return $this->hasMany(\App\Http\Models\UsuarioLegalEspecialidad::class, 'idLegalEspecialidad', 'idLegalEspecialidad');
    }


}
