<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuario extends Model {

    /**
     * Generated
     */

    protected $table = 'usuario';
    protected $fillable = ['idUsuario', 'idPerfil', 'nombre', 'apellidoPaterno', 'apellidoMaterno', 'idUser'];


    public function perfil() {
        return $this->belongsTo(\App\Http\Models\Perfil::class, 'idPerfil', 'idPerfil');
    }

    public function user() {
        return $this->belongsTo(\App\Http\Models\User::class, 'idUser', 'id');
    }

    public static function crearUsuario($idPerfil,$nombre,$apPaterno,$apMaterno,$idUser){
        $results = DB::select("call crear_usuario(?,?,?,?,?)",array($idPerfil,$nombre,$apPaterno,$apMaterno,$idUser));
        return $results;
    }
}
