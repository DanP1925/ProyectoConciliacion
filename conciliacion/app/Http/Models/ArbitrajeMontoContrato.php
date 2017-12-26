<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ArbitrajeMontoContrato extends Model {

    /**
     * Generated
     */

    protected $table = 'arbitraje_monto_contrato';
    protected $fillable = ['idArbitrajeMontoContrato', 'nombre'];


    public function arbitrajes() {
        return $this->hasMany(\App\Http\Models\Arbitraje::class, 'idArbitrajeMontoContrato', 'idArbitrajeMontoContrato');
    }


}
