<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model {

    /**
     * Generated
     */

    protected $table = 'perfil';
    protected $fillable = ['idPerfil', 'nombre'];


    public function users() {
        return $this->belongsToMany(\App\Http\Models\User::class, 'usuario', 'idPerfil', 'idUser');
    }

    public function usuarios() {
        return $this->hasMany(\App\Http\Models\Usuario::class, 'idPerfil', 'idPerfil');
    }


}
