<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LaudoResultado extends Model {

    /**
     * Generated
     */

    protected $table = 'laudo_resultado';
    protected $fillable = ['idLaudoResultado', 'nombre'];


    public function expedientes() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idLaudoResultado', 'idLaudoResultado');
    }


}
