<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaImporteParcial extends Model {

    // FIX FOR : "Unknown column 'updated_at'"
    public $timestamps = false;

    protected $table = 'factura_importe_parcial';
    protected $fillable = ['idFacturaImporteParcial', 'idFactura', 'importe'];


    public function factura() {
        return $this->belongsTo(\App\Http\Models\Factura::class, 'idFactura', 'idFactura');
    }


}
