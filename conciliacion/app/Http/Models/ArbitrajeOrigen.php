<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ArbitrajeOrigen extends Model {

    /**
     * Generated
     */

    protected $table = 'arbitraje_origen';
    protected $fillable = ['idArbitrajeOrigen', 'nombre'];


    public function expedientes() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idArbitrajeOrigen', 'idArbitrajeOrigen');
    }


}
