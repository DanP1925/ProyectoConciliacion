<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class RegionControversium extends Model {

    /**
     * Generated
     */

    protected $table = 'region_controversia';
    protected $fillable = ['idExpediente', 'idRegion'];


    public function expediente() {
        return $this->belongsTo(\App\Http\Models\Expediente::class, 'idExpediente', 'idExpediente');
    }

    public function region() {
        return $this->belongsTo(\App\Http\Models\Region::class, 'idRegion', 'idRegion');
    }


}
