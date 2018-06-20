<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaConcepto extends Model {

    // FIX FOR : "Unknown column 'updated_at'"
    public $timestamps = false;

    protected $table = 'factura_concepto';
    protected $fillable = ['idFacturaConcepto', 'nombre'];


    public function facturas() {
        return $this->hasMany(\App\Http\Models\Factura::class, 'idFacturaConcepto', 'idFacturaConcepto');
    }


}
