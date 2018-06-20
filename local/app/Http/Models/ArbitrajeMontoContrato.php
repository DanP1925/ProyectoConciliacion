<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ArbitrajeMontoContrato extends Model {

    /**
     * Generated
     */

    protected $table = 'arbitraje_monto_contrato';
    protected $fillable = ['idArbitrajeMontoContrato', 'nombre'];


    public function expedientes() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idArbitrajeMontoContrato', 'idArbitrajeMontoContrato');
    }


}
