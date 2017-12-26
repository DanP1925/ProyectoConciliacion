<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LaudoFavorPersona extends Model {

    /**
     * Generated
     */

    protected $table = 'laudo_favor_persona';
    protected $fillable = ['idLaudoFavorPersona', 'nombre'];


    public function laudos() {
        return $this->hasMany(\App\Http\Models\Laudo::class, 'idLaudoResultadoPersona', 'idLaudoFavorPersona');
    }


}
