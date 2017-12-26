<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LaudoFavorForma extends Model {

    /**
     * Generated
     */

    protected $table = 'laudo_favor_forma';
    protected $fillable = ['idLaudoFormaForma', 'nombre'];


    public function laudos() {
        return $this->hasMany(\App\Http\Models\Laudo::class, 'idLaudoResultadoForma', 'idLaudoFormaForma');
    }


}
