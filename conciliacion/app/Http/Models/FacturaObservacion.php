<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaObservacion extends Model {

    // FIX FOR : "Unknown column 'updated_at'"
    public $timestamps = false;

    protected $table = 'factura_observacion';
    protected $fillable = ['idFacturaObservacion', 'idFactura', 'observacion'];


    public function factura() {
        return $this->belongsTo(\App\Http\Models\Factura::class, 'idFactura', 'idFactura');
    }


}
