<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ConsorcioPersonaDetalle extends Model {

    /**
     * Generated
     */

    protected $table = 'consorcio_persona_detalle';
    protected $fillable = ['idConsorcioPersonaDetalle', 'idConsorcioPersona', 'idPersonaJuridica', 'idPersonaNatural', 'flgTipoPersona'];


    public function personaJuridica() {
        return $this->belongsTo(\App\Http\Models\PersonaJuridica::class, 'idPersonaJuridica', 'idPersonaJuridica');
    }

    public function personaNatural() {
        return $this->belongsTo(\App\Http\Models\PersonaNatural::class, 'idPersonaNatural', 'idPersonaNatural');
    }

    public function consorcioPersona() {
        return $this->belongsTo(\App\Http\Models\ConsorcioPersona::class, 'idConsorcioPersona', 'idConsorcioPersona');
    }


}
