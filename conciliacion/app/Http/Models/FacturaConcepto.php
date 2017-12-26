<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaConcepto extends Model {

    /**
     * Generated
     */

    protected $table = 'factura_concepto';
    protected $fillable = ['idFacturaConcepto', 'nombre'];


    public function facturas() {
        return $this->hasMany(\App\Http\Models\Factura::class, 'idFacturaConcepto', 'idFacturaConcepto');
    }


}
