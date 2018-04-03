<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioLegalPais extends Model {

    /**
     * Generated
     */

    protected $table = 'usuario_legal_pais';
    protected $fillable = ['idUsuarioLegalPais', 'nombre'];


    public function usuarioLegals() {
        return $this->hasMany(\App\Http\Models\UsuarioLegal::class, 'idUsuarioLegalPais', 'idUsuarioLegalPais');
    }


}
