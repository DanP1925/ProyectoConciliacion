<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model {

    /**
     * Generated
     */

    protected $table = 'region';
    protected $fillable = ['idRegion', 'nombre'];


    public function arbitrajes() {
        return $this->belongsToMany(\App\Http\Models\Arbitraje::class, 'arbitraje_region', 'idRegion', 'idArbitraje');
    }

    public function arbitrajeRegions() {
        return $this->hasMany(\App\Http\Models\ArbitrajeRegion::class, 'idRegion', 'idRegion');
    }


}
