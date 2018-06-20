<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LaudoRecursoResultado extends Model {

    /**
     * Generated
     */

    protected $table = 'laudo_recurso_resultado';
    protected $fillable = ['idLaudoRecursoResultado', 'nombre'];


    public function laudoRecursoPresentados() {
        return $this->hasMany(\App\Http\Models\LaudoRecursoPresentado::class, 'idLaudoRecursoResultado', 'idLaudoRecursoResultado');
    }


}
