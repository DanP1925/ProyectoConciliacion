<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PersonaJuridica extends Model {

    /**
     * Generated
     */

    protected $table = 'persona_juridica';
    protected $fillable = ['idPersonaJuridica', 'nombreComercial', 'razonSocial', 'ruc', 'direccion', 'telefono', 'sitioWeb'];


    public function clienteLegals() {
        return $this->hasMany(\App\Http\Models\ClienteLegal::class, 'idPersonaJuridica', 'idPersonaJuridica');
    }

    public function consorcioClienteDetalles() {
        return $this->hasMany(\App\Http\Models\ConsorcioClienteDetalle::class, 'idPersonaJuridica', 'idPersonaJuridica');
    }


}
