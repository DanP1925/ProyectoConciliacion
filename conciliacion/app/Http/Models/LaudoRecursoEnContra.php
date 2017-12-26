<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LaudoRecursoEnContra extends Model {

    /**
     * Generated
     */

    protected $table = 'laudo_recurso_en_contra';
    protected $fillable = ['idLaudoRecursoEnContra', 'nombre'];


    public function laudoRecursoPresentados() {
        return $this->hasMany(\App\Http\Models\LaudoRecursoPresentado::class, 'idLaudoRecursoEnContra', 'idLaudoRecursoEnContra');
    }

    public function laudoRecursoPresentadoResultados() {
        return $this->hasMany(\App\Http\Models\LaudoRecursoPresentadoResultado::class, 'idLaudoRecursoEnContra', 'idLaudoRecursoEnContra');
    }


}
