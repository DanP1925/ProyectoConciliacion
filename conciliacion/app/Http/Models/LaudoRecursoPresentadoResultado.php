<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LaudoRecursoPresentadoResultado extends Model {

    /**
     * Generated
     */

    protected $table = 'laudo_recurso_presentado_resultado';
    protected $fillable = ['idLaudoRecursoPresentadoResultado', 'idLaudoRecursoEnContra', 'nombre'];


    public function laudoRecursoEnContra() {
        return $this->belongsTo(\App\Http\Models\LaudoRecursoEnContra::class, 'idLaudoRecursoEnContra', 'idLaudoRecursoEnContra');
    }

    public function laudoRecursoPresentados() {
        return $this->hasMany(\App\Http\Models\LaudoRecursoPresentado::class, 'idLaudoRecursoPresentadoResultado', 'idLaudoRecursoPresentadoResultado');
    }


}
