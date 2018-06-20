<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model {

    // FIX FOR : "Unknown column 'updated_at'"
    public $timestamps = false;

    protected $table = 'factura';
    protected $fillable = ['idFactura', 'idExpediente', 'idUsuarioCreador', 'idFacturaConcepto', 'idFacturaEstado', 'idClientePersonaNatural', 'idClientePersonaJuridica', 'nombreCliente', 'numeroComprobante', 'fechaEmision', 'fechaVencimiento', 'importeTotal', 'flgClientePersonaTipo'];


    public function facturaConcepto() {
        return $this->belongsTo(\App\Http\Models\FacturaConcepto::class, 'idFacturaConcepto', 'idFacturaConcepto');
    }

    public function facturaEstado() {
        return $this->belongsTo(\App\Http\Models\FacturaEstado::class, 'idFacturaEstado', 'idFacturaEstado');
    }

    public function personaJuridica() {
        return $this->belongsTo(\App\Http\Models\PersonaJuridica::class, 'idClientePersonaJuridica', 'idPersonaJuridica');
    }

    public function personaNatural() {
        return $this->belongsTo(\App\Http\Models\PersonaNatural::class, 'idClientePersonaNatural', 'idPersonaNatural');
    }

    public function usuarioLegal() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idUsuarioCreador', 'idUsuarioLegal');
    }

    public function facturaFechaNotificacions() {
        return $this->hasMany(\App\Http\Models\FacturaFechaNotificacion::class, 'idFactura', 'idFactura');
    }

    public function facturaImporteParcials() {
        return $this->hasMany(\App\Http\Models\FacturaImporteParcial::class, 'idFactura', 'idFactura');
    }

    public function facturaObservacions() {
        return $this->hasMany(\App\Http\Models\FacturaObservacion::class, 'idFactura', 'idFactura');
    }


}
