<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ArbitrajeRegion extends Model {

    /**
     * Generated
     */

    protected $table = 'arbitraje_region';
    protected $fillable = ['idArbitraje', 'idRegion'];


    public function arbitraje() {
        return $this->belongsTo(\App\Http\Models\Arbitraje::class, 'idArbitraje', 'idArbitraje');
    }

    public function region() {
        return $this->belongsTo(\App\Http\Models\Region::class, 'idRegion', 'idRegion');
    }


}
