<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LaudoRecurso extends Model {

    /**
     * Generated
     */

    protected $table = 'laudo_recurso';
    protected $fillable = ['idLaudoRecurso', 'nombre'];


    public function laudoRecursoPresentados() {
        return $this->hasMany(\App\Http\Models\LaudoRecursoPresentado::class, 'idLaudoRecurso', 'idLaudoRecurso');
    }


}
