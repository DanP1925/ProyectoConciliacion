<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioInvitacion extends Model {

    /**
     * Generated
     */

    protected $table = 'usuario_invitacion';
    protected $fillable = ['idUsuarioInvitacion', 'idPerfil', 'hash', 'fechaInicio', 'fechaFin', 'email', 'estado'];


    public function perfil() {
        return $this->belongsTo(\App\Http\Models\Perfil::class, 'idPerfil', 'idPerfil');
    }


}
