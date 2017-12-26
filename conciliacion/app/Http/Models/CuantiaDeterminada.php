<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CuantiaDeterminada extends Model {

    /**
     * Generated
     */

    protected $table = 'cuantia_determinada';
    protected $fillable = ['idCuantiaDeterminada', 'nombre'];


    public function expedientes() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idCuantiaDeterminada', 'idCuantiaDeterminada');
    }


}
