<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model {

    /**
     * Generated
     */

    protected $table = 'factura';
    protected $fillable = ['idFactura', 'idExpediente', 'idSecretarioArbitral', 'idCliente', 'idFacturaConcepto', 'idFacturaEstado', 'numeroComprobante', 'fechaNotificacion', 'fechaEmision', 'fechaVencimiento', 'importeInicial', 'importeParcial', 'importePendiente', 'observacionEstado', 'observacionPlazosPago'];


    public function clienteLegal() {
        return $this->belongsTo(\App\Http\Models\ClienteLegal::class, 'idCliente', 'idClienteLegal');
    }

    public function expediente() {
        return $this->belongsTo(\App\Http\Models\Expediente::class, 'idExpediente', 'idExpediente');
    }

    public function facturaConcepto() {
        return $this->belongsTo(\App\Http\Models\FacturaConcepto::class, 'idFacturaConcepto', 'idFacturaConcepto');
    }

    public function facturaEstado() {
        return $this->belongsTo(\App\Http\Models\FacturaEstado::class, 'idFacturaEstado', 'idFacturaEstado');
    }

    public function usuarioLegal() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idSecretarioArbitral', 'idUsuario_legal');
    }


}
