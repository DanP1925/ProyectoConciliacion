<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Laudo extends Model {

    /**
     * Generated
     */

    protected $table = 'laudo';
    protected $fillable = ['idLaudo', 'idArbitraje', 'idLaudoEstado', 'idLaudoTipoEjecucion', 'idLaudoResultado', 'idLaudoResultadoPersona', 'idLaudoResultadoForma', 'monto', 'fecha'];


    public function arbitraje() {
        return $this->belongsTo(\App\Http\Models\Arbitraje::class, 'idArbitraje', 'idArbitraje');
    }

    public function laudoEstado() {
        return $this->belongsTo(\App\Http\Models\LaudoEstado::class, 'idLaudoEstado', 'idLaudoEstado');
    }

    public function laudoResultado() {
        return $this->belongsTo(\App\Http\Models\LaudoResultado::class, 'idLaudoResultado', 'idLaudoResultado');
    }

    public function laudoFavorForma() {
        return $this->belongsTo(\App\Http\Models\LaudoFavorForma::class, 'idLaudoResultadoForma', 'idLaudoFormaForma');
    }

    public function laudoFavorPersona() {
        return $this->belongsTo(\App\Http\Models\LaudoFavorPersona::class, 'idLaudoResultadoPersona', 'idLaudoFavorPersona');
    }

    public function laudoTipoEjecucion() {
        return $this->belongsTo(\App\Http\Models\LaudoTipoEjecucion::class, 'idLaudoTipoEjecucion', 'idLaudoTipoEjecucion');
    }

    public function laudoRecursoPresentados() {
        return $this->hasMany(\App\Http\Models\LaudoRecursoPresentado::class, 'idLaudo', 'idLaudo');
    }


}
