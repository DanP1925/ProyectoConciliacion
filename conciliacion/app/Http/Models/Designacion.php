<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Designacion extends Model {

    /**
     * Generated
     */

    protected $table = 'designacion';
    protected $fillable = ['idDesignacion', 'idDesignacionTipo', 'idDesignacionPropuesta', 'fecha'];


    public function designacionPropuesta() {
        return $this->belongsTo(\App\Http\Models\DesignacionPropuesta::class, 'idDesignacionPropuesta', 'idDesignacionPropuesta');
    }

    public function designacionTipo() {
        return $this->belongsTo(\App\Http\Models\DesignacionTipo::class, 'idDesignacionTipo', 'idDesignacionTipo');
    }


}
