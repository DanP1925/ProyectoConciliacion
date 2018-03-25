<?php

namespace App\Http\Models\StoreProcedure;

use Illuminate\Support\Facades\DB;

class FacturacionSP{

    public static function facturacionBuscarFacturas($nombreCliente,$numero,$numeroComprobante,$idFacturaConcepto,$idFacturaEstado,$fechaEmision,$fechaVencimiento){
        $results = DB::select("call facturacion_buscar_facturas (?,?,?,?,?,?,?)",array($nombreCliente,$numero,$numeroComprobante,$idFacturaConcepto,$idFacturaEstado,$fechaEmision,$fechaVencimiento));
        return $results;
    }

    public static function facturacionBuscarClientes($cliente,$tipoCliente){
        $results = DB::select("call facturacion_buscar_cliente (?,?)",array($cliente,$tipoCliente));
        return $results;
    }

}
