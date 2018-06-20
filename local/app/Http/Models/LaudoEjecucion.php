<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LaudoEjecucion extends Model {

    /**
     * Generated
     */

    protected $table = 'laudo_ejecucion';
    protected $fillable = ['idLaudoEjecucion', 'nombre'];


    public function expedientes() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idLaudoEjecucion', 'idLaudoEjecucion');
    }


}
