<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ConsorcioPersona extends Model {

    /**
     * Generated
     */

    protected $table = 'consorcio_persona';
    protected $fillable = ['idConsorcioPersona', 'nombre'];


    public function consorcioPersonaDetalles() {
        return $this->hasMany(\App\Http\Models\ConsorcioPersonaDetalle::class, 'idConsorcioPersona', 'idConsorcioPersona');
    }


}
