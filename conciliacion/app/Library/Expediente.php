<?php 

namespace App\Library;

class Expediente {

    var $numeroExpediente;
    var $fechaSolicitud;
    var $region01;
    var $region02;
    var $region03;
    var $tipoCaso01;
    var $tipoCaso02;
    var $cuantiaControversia;
    var $tipoCuantia;
    var $cuantiaDeterminada;
    var $secretarioResponable;
    var $secreatarioLider;
    var $demandante;
    var $demandado;
    var $origenArbitraje;
    var $montoContrato;
    var $anhoContrato;
    
    function __construct($request)
    {
        $this->numeroExpediente = $request->input('numeroExpediente');
        $this->fechaSolicitud = $request->input('fechaSolicitud');
        $this->region01 = $request->input('region01');
        $this->region02 = $request->input('region02');
        $this->region03 = $request->input('region03');
        $this->tipoCaso01 = $request->input('tipoCaso01');
        $this->tipoCaso02 = $request->input('tipoCaso02');
        $this->cuantiaControversia = $request->input('cuantiaControversia');
        $this->tipoCuantia = $request->input('tipoCuantía');
        $this->cuantiaDeterminada = $request->input('cuantiaDeterminada');
        $this->secretarioResponable = $request->input('secretarioResponable');
        $this->secreatarioLider = $request->input('secreatioLider ');
        $this->demandante = $request->input('demandante ');
        $this->demandado = $request->input('demandado ');
        $this->origenArbitraje = $request->input('origenArbitraje ');
        $this->montoContrato = $request->input('montoContrato ');
        $this->anhoContrato = $request->input('añoContrato');
    }

}
