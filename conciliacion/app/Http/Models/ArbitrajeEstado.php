<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ArbitrajeEstado extends Model {

    /**
     * Generated
     */

    protected $table = 'arbitraje_estado';
    protected $fillable = ['idArbitrajeEstado', 'nombre'];


    public function arbitrajes() {
        return $this->hasMany(\App\Http\Models\Arbitraje::class, 'idArbitrajeEstado', 'idArbitrajeEstado');
    }


}
