<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CuantiaTipo extends Model {

    /**
     * Generated
     */

    protected $table = 'cuantia_tipo';
    protected $fillable = ['idCuantiaTipo', 'nombre'];


    public function expedientes() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idCuantiaTipo', 'idCuantiaTipo');
    }


}
