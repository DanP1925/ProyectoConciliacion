<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ExpedienteClienteLegal extends Model {

    /**
     * Generated
     */

    protected $table = 'expediente_cliente_legal';
    protected $fillable = ['idExpedienteClienteLegal', 'idRepresentanteLegal', 'idConsorcioPersona', 'idPersonaNatural', 'idPersonaJuridica', 'nombre', 'flgTipoPersona', 'flgSector', 'emailClienteLegal', 'emailRepresentanteLegal'];


    public function personaJuridica() {
        return $this->belongsTo(\App\Http\Models\PersonaJuridica::class, 'idPersonaJuridica', 'idPersonaJuridica');
    }

    public function personaNatural() {
        return $this->belongsTo(\App\Http\Models\PersonaNatural::class, 'idPersonaNatural', 'idPersonaNatural');
    }

    public function usuarioLegal() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idRepresentanteLegal', 'idUsuarioLegal');
    }

    public function consorcioPersona() {
        return $this->belongsTo(\App\Http\Models\ConsorcioPersona::class, 'idConsorcioPersona', 'idConsorcioPersona');
    }

    public function expedienteDemandante() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idDemandante', 'idExpedienteClienteLegal');
    }

    public function expedienteDemandado() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idDemandado', 'idExpedienteClienteLegal');
    }


}
