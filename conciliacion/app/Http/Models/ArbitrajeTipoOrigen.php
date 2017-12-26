<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ArbitrajeTipoOrigen extends Model {

    /**
     * Generated
     */

    protected $table = 'arbitraje_tipo_origen';
    protected $fillable = ['idArbitrajeTipoOrigen', 'nombre'];


    public function arbitrajes() {
        return $this->hasMany(\App\Http\Models\Arbitraje::class, 'idArbitrajeTipoOrigen', 'idArbitrajeTipoOrigen');
    }


}
