<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {

    // FIX FOR : "Unknown column 'updated_at'"
    public $timestamps = false;

    protected $table = 'usuario';
    protected $fillable = ['idUsuario', 'idPerfil', 'nombre', 'apellidoPaterno', 'apellidoMaterno', 'idUser'];


    public function perfil() {
        return $this->belongsTo(\App\Http\Models\Perfil::class, 'idPerfil', 'idPerfil');
    }

    public function user() {
        return $this->belongsTo(\App\Http\Models\User::class, 'idUser', 'id');
    }

    public static function crearUsuario($idPerfil,$nombre,$apPaterno,$apMaterno,$idUser){

        $usuario = new Usuario;

        $usuario->idPerfil = $idPerfil;
        $usuario->nombre = $nombre;
        $usuario->apellidoPaterno = $apPaterno;
        $usuario->apellidoMaterno = $apMaterno;
        $usuario->idUser = $idUser;

        $usuario->save();
    }

}
