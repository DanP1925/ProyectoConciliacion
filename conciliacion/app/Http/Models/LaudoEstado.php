<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LaudoEstado extends Model {

    /**
     * Generated
     */

    protected $table = 'laudo_estado';
    protected $fillable = ['idLaudoEstado', 'nombre'];


    public function laudos() {
        return $this->hasMany(\App\Http\Models\Laudo::class, 'idLaudoEstado', 'idLaudoEstado');
    }


}
