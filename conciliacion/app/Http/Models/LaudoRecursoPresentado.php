<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LaudoRecursoPresentado extends Model {

    /**
     * Generated
     */

    protected $table = 'laudo_recurso_presentado';
    protected $fillable = ['idLaudo', 'idLaudoRecursoEnContra', 'idLaudoRecursoPresentadoResultado', 'fechaSolicitud', 'fechaResultado'];


    public function laudo() {
        return $this->belongsTo(\App\Http\Models\Laudo::class, 'idLaudo', 'idLaudo');
    }

    public function laudoRecursoEnContra() {
        return $this->belongsTo(\App\Http\Models\LaudoRecursoEnContra::class, 'idLaudoRecursoEnContra', 'idLaudoRecursoEnContra');
    }

    public function laudoRecursoPresentadoResultado() {
        return $this->belongsTo(\App\Http\Models\LaudoRecursoPresentadoResultado::class, 'idLaudoRecursoPresentadoResultado', 'idLaudoRecursoPresentadoResultado');
    }


}
