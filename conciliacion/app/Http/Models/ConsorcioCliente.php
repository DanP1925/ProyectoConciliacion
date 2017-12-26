<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ConsorcioCliente extends Model {

    /**
     * Generated
     */

    protected $table = 'consorcio_cliente';
    protected $fillable = ['idConsorcioCliente', 'nombre'];


    public function clienteLegals() {
        return $this->hasMany(\App\Http\Models\ClienteLegal::class, 'idConsorcioEmpresa', 'idConsorcioCliente');
    }

    public function consorcioClienteDetalles() {
        return $this->hasMany(\App\Http\Models\ConsorcioClienteDetalle::class, 'idConsorcioEmpresa', 'idConsorcioCliente');
    }


}
