<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaFechaNotificacion extends Model {

    // FIX FOR : "Unknown column 'updated_at'"
    public $timestamps = false;

    protected $table = 'factura_fecha_notificacion';
    protected $fillable = ['idFacturaFechaNotificacion', 'idFactura', 'fecha'];


    public function factura() {
        return $this->belongsTo(\App\Http\Models\Factura::class, 'idFactura', 'idFactura');
    }


}
