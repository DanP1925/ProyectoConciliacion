<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class TipoCaso extends Model {

    /**
     * Generated
     */

    protected $table = 'tipo_caso';
    protected $fillable = ['idTipoCaso', 'nombre'];


    public function expedientes() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idTipoCaso', 'idTipoCaso');
    }


}
