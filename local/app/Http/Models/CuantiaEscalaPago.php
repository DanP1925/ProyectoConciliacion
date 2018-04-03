<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CuantiaEscalaPago extends Model {

    /**
     * Generated
     */

    protected $table = 'cuantia_escala_pago';
    protected $fillable = ['idCuantiaEscalaPago', 'nombre'];


    public function expedientes() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idCuantiaEscalaPago', 'idCuantiaEscalaPago');
    }


}
