<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LaudoTipoEjecucion extends Model {

    /**
     * Generated
     */

    protected $table = 'laudo_tipo_ejecucion';
    protected $fillable = ['idLaudoTipoEjecucion', 'nombre'];


    public function laudos() {
        return $this->hasMany(\App\Http\Models\Laudo::class, 'idLaudoTipoEjecucion', 'idLaudoTipoEjecucion');
    }


}
