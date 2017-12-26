<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ArbitrajePeritaje extends Model {

    /**
     * Generated
     */

    protected $table = 'arbitraje_peritaje';
    protected $fillable = ['idArbitrajePeritaje', 'nombre'];


    public function arbitrajes() {
        return $this->hasMany(\App\Http\Models\Arbitraje::class, 'idArbitrajePeritaje', 'idArbitrajePeritaje');
    }


}
