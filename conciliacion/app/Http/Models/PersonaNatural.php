<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PersonaNatural extends Model {

    /**
     * Generated
     */

    protected $table = 'persona_natural';
    protected $fillable = ['idPersonaNatural', 'nombre', 'apellido Paterno', 'apellido Materno', 'dni', 'email', 'telefono'];


    public function clienteLegals() {
        return $this->hasMany(\App\Http\Models\ClienteLegal::class, 'idPersonaNatural', 'idPersonaNatural');
    }

    public function consorcioClienteDetalles() {
        return $this->hasMany(\App\Http\Models\ConsorcioClienteDetalle::class, 'idPersonaNatural', 'idPersonaNatural');
    }


}
