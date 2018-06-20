<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LaudoAFavor extends Model {

    /**
     * Generated
     */

    protected $table = 'laudo_a_favor';
    protected $fillable = ['idLaudoAFavor', 'nombre'];


    public function expedientes() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idLaudoAFavor', 'idLaudoAFavor');
    }


}
