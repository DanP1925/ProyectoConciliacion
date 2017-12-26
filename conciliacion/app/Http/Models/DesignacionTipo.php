<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class DesignacionTipo extends Model {

    /**
     * Generated
     */

    protected $table = 'designacion_tipo';
    protected $fillable = ['idDesignacionTipo', 'nombre'];


    public function designacionPropuesta() {
        return $this->belongsToMany(\App\Http\Models\DesignacionPropuestum::class, 'designacion', 'idDesignacionTipo', 'idDesignacionPropuesta');
    }

    public function designacions() {
        return $this->hasMany(\App\Http\Models\Designacion::class, 'idDesignacionTipo', 'idDesignacionTipo');
    }


}
