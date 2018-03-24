<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PersonaNatural extends Model {

    /**
     * Generated
     */

    protected $table = 'persona_natural';
    protected $fillable = ['idPersonaNatural', 'nombre', 'apellidoPaterno', 'apellidoMaterno', 'dni', 'email', 'telefono'];


    public function consorcioPersonaDetalles() {
        return $this->hasMany(\App\Http\Models\ConsorcioPersonaDetalle::class, 'idPersonaNatural', 'idPersonaNatural');
    }

    public function expedienteClienteLegals() {
        return $this->hasMany(\App\Http\Models\ExpedienteClienteLegal::class, 'idPersonaNatural', 'idPersonaNatural');
    }

    public function facturas() {
        return $this->hasMany(\App\Http\Models\Factura::class, 'idClientePersonaNatural', 'idPersonaNatural');
    }


}
