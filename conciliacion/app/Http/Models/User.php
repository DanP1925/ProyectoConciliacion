<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    /**
     * Generated
     */

    protected $table = 'users';
    protected $fillable = ['id', 'email', 'password', 'remember_token'];


    public function perfils() {
        return $this->belongsToMany(\App\Http\Models\Perfil::class, 'usuario', 'idUser', 'idPerfil');
    }

    public function usuarios() {
        return $this->hasMany(\App\Http\Models\Usuario::class, 'idUser', 'id');
    }


}
