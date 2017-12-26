<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class TipoCasoForma extends Model {

    /**
     * Generated
     */

    protected $table = 'tipo_caso_forma';
    protected $fillable = ['idTipoCasoForma', 'nombre'];


    public function expedientes() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idTipoCasoForma', 'idTipoCasoForma');
    }


}
