<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioLegalTipo extends Model {

    /**
     * Generated
     */

    protected $table = 'usuario_legal_tipo';
    protected $fillable = ['idUsuarioLegalTipo', 'nombre'];


    public function usuarioLegals() {
        return $this->hasMany(\App\Http\Models\UsuarioLegal::class, 'idUsuarioLegalTipo', 'idUsuarioLegalTipo');
    }


}
