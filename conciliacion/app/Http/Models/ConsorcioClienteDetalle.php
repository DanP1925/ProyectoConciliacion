<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ConsorcioClienteDetalle extends Model {

    /**
     * Generated
     */

    protected $table = 'consorcio_cliente_detalle';
    protected $fillable = ['idConsorcioEmpresa', 'idPersonaJuridica', 'idPersonaNatural'];


    public function consorcioCliente() {
        return $this->belongsTo(\App\Http\Models\ConsorcioCliente::class, 'idConsorcioEmpresa', 'idConsorcioCliente');
    }

    public function personaJuridica() {
        return $this->belongsTo(\App\Http\Models\PersonaJuridica::class, 'idPersonaJuridica', 'idPersonaJuridica');
    }

    public function personaNatural() {
        return $this->belongsTo(\App\Http\Models\PersonaNatural::class, 'idPersonaNatural', 'idPersonaNatural');
    }


}
