<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteLegal extends Model {

    /**
     * Generated
     */

    protected $table = 'cliente_legal';
    protected $fillable = ['idClienteLegal', 'idClienteLegalTipo', 'idPersonaNatural', 'idPersonaJuridica', 'idConsorcioEmpresa', 'idUsuarioLegal', 'flgEsConsorcio', 'flgSector', 'emailUsuarioLegal', 'telefonoUsuarioLegal', 'telefonoClienteLegal'];


    public function clienteLegalTipo() {
        return $this->belongsTo(\App\Http\Models\ClienteLegalTipo::class, 'idClienteLegalTipo', 'idClienteLegalTipo');
    }

    public function consorcioCliente() {
        return $this->belongsTo(\App\Http\Models\ConsorcioCliente::class, 'idConsorcioEmpresa', 'idConsorcioCliente');
    }

    public function personaJuridica() {
        return $this->belongsTo(\App\Http\Models\PersonaJuridica::class, 'idPersonaJuridica', 'idPersonaJuridica');
    }

    public function personaNatural() {
        return $this->belongsTo(\App\Http\Models\PersonaNatural::class, 'idPersonaNatural', 'idPersonaNatural');
    }

    public function usuarioLegal() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idUsuarioLegal', 'idUsuario_legal');
    }

    public function demandante() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idDemandante', 'idClienteLegal');
    }

    public function demandado() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idDemandado', 'idClienteLegal');
    }

    public function facturas() {
        return $this->hasMany(\App\Http\Models\Factura::class, 'idCliente', 'idClienteLegal');
    }


}
