<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaEstado extends Model {

    /**
     * Generated
     */

    protected $table = 'factura_estado';
    protected $fillable = ['idFacturaEstado', 'nombre'];


    public function facturas() {
        return $this->hasMany(\App\Http\Models\Factura::class, 'idFacturaEstado', 'idFacturaEstado');
    }


}
