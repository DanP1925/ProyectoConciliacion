<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LaudoRecursoPresentado extends Model {

    /**
     * Generated
     */

    protected $table = 'laudo_recurso_presentado';
    protected $fillable = ['idLaudoRecursoPresentado', 'idExpediente', 'idLaudoRecurso', 'idLaudoRecursoResultado', 'fechaPresentacion', 'fechaResultado'];


    public function expediente() {
        return $this->belongsTo(\App\Http\Models\Expediente::class, 'idExpediente', 'idExpediente');
    }

    public function laudoRecurso() {
        return $this->belongsTo(\App\Http\Models\LaudoRecurso::class, 'idLaudoRecurso', 'idLaudoRecurso');
    }

    public function laudoRecursoResultado() {
        return $this->belongsTo(\App\Http\Models\LaudoRecursoResultado::class, 'idLaudoRecursoResultado', 'idLaudoRecursoResultado');
    }


}
