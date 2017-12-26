<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioLegalProfesion extends Model {

    /**
     * Generated
     */

    protected $table = 'usuario_legal_profesion';
    protected $fillable = ['idUsuarioLegalProfesion', 'nombre'];


    public function usuarioLegals() {
        return $this->hasMany(\App\Http\Models\UsuarioLegal::class, 'idUsuarioLegalProfesion', 'idUsuarioLegalProfesion');
    }


}
