<?php

namespace App\Http\Controllers;

use App\Http\Models\ArbitrajeMontoContrato;
use App\Http\Models\ArbitrajeOrigen;
use App\Http\Models\CuantiaEscalaPago;
use App\Http\Models\CuantiaTipo;
use App\Http\Models\DesignacionTipo;
use App\Http\Models\ExpedienteEstado;
use App\Http\Models\ExpedienteSubtipoCaso;
use App\Http\Models\ExpedienteTipoCaso;
use App\Http\Models\LaudoAFavor;
use App\Http\Models\LaudoEjecucion;
use App\Http\Models\LaudoResultado;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function lista()
    {
        return view('expediente.lista');
    }

    public function nuevo()
    {
        $arrDatosPantalla = array();
        $arrDatosPantalla['expediente_estado'] = array();
        $arrDatosPantalla['expediente_tipo_caso'] = array();
        $arrDatosPantalla['expediente_subtipo_caso'] = array();
        $arrDatosPantalla['cuantia_tipo'] = array();
        $arrDatosPantalla['cuantia_escala_pago'] = array();
        $arrDatosPantalla['arbitraje_origen'] = array();
        $arrDatosPantalla['arbitraje_monto_contrato'] = array();
        $arrDatosPantalla['designacion_tipo'] = array();
        $arrDatosPantalla['laudo_resultado'] = array();
        $arrDatosPantalla['laudo_ejecucion'] = array();
        $arrDatosPantalla['laudo_a_favor'] = array();


        $qryExpedienteEstado = ExpedienteEstado::orderBy('nombre','ASC')->get();
        foreach($qryExpedienteEstado as $expedienteEstado){
            $subArray = array();
            $subArray['id'] = $expedienteEstado->idExpedienteEstado;
            $subArray['nombre'] = $expedienteEstado->nombre;
            array_push($arrDatosPantalla['expediente_estado'],$subArray);
        }

        $qryExpedienteTipoCaso = ExpedienteTipoCaso::orderBy('nombre','ASC')->get();
        foreach($qryExpedienteTipoCaso as $expedienteTipoCaso){
            $subArray = array();
            $subArray['id'] = $expedienteTipoCaso->idExpedienteTipoCaso;
            $subArray['nombre'] = $expedienteTipoCaso->nombre;
            array_push($arrDatosPantalla['expediente_tipo_caso'],$subArray);
        }

        $qryExpedienteSubtipoCaso = ExpedienteSubtipoCaso::orderBy('nombre','ASC')->get();
        foreach($qryExpedienteSubtipoCaso as $expedienteSubtipoCaso){
            $subArray = array();
            $subArray['id'] = $expedienteSubtipoCaso->idExpedienteSubtipoCaso;
            $subArray['nombre'] = $expedienteSubtipoCaso->nombre;
            array_push($arrDatosPantalla['expediente_subtipo_caso'],$subArray);
        }

        $qryCuantiaTipo = CuantiaTipo::orderBy('nombre','ASC')->get();
        foreach($qryCuantiaTipo as $cuantiaTipo){
            $subArray = array();
            $subArray['id'] = $cuantiaTipo->idCuantiaTipo;
            $subArray['nombre'] = $cuantiaTipo->nombre;
            array_push($arrDatosPantalla['cuantia_tipo'],$subArray);
        }

        $qryCuantiaEscalaPago = CuantiaEscalaPago::orderBy('nombre','ASC')->get();
        foreach($qryCuantiaEscalaPago as $cuantiaEscalaPago){
            $subArray = array();
            $subArray['id'] = $cuantiaEscalaPago->idCuantiaEscalaPago;
            $subArray['nombre'] = $cuantiaEscalaPago->nombre;
            array_push($arrDatosPantalla['cuantia_escala_pago'],$subArray);
        }

        $qryArbitrajeOrigen = ArbitrajeOrigen::orderBy('nombre','ASC')->get();
        foreach($qryArbitrajeOrigen as $arbitrajeOrigen){
            $subArray = array();
            $subArray['id'] = $arbitrajeOrigen->idArbitrajeOrigen;
            $subArray['nombre'] = $arbitrajeOrigen->nombre;
            array_push($arrDatosPantalla['arbitraje_origen'],$subArray);
        }

        $qryArbitrajeMontoContrato = ArbitrajeMontoContrato::orderBy('nombre','ASC')->get();
        foreach($qryArbitrajeMontoContrato as $arbitrajeMontoContrato){
            $subArray = array();
            $subArray['id'] = $arbitrajeMontoContrato->idArbitrajeMontoContrato;
            $subArray['nombre'] = $arbitrajeMontoContrato->nombre;
            array_push($arrDatosPantalla['arbitraje_monto_contrato'],$subArray);
        }

        $qryDesignacionTipo = DesignacionTipo::orderBy('nombre','ASC')->get();
        foreach($qryDesignacionTipo as $designacionTipo){
            $subArray = array();
            $subArray['id'] = $designacionTipo->idDesignacionTipo;
            $subArray['nombre'] = $designacionTipo->nombre;
            array_push($arrDatosPantalla['designacion_tipo'],$subArray);
        }

        $qryLaudoResultado = LaudoResultado::orderBy('nombre','ASC')->get();
        foreach($qryLaudoResultado as $laudoResultado){
            $subArray = array();
            $subArray['id'] = $laudoResultado->idLaudoResultado;
            $subArray['nombre'] = $laudoResultado->nombre;
            array_push($arrDatosPantalla['laudo_resultado'],$subArray);
        }

        $qryLaudoEjecucion = LaudoEjecucion::orderBy('nombre','ASC')->get();
        foreach($qryLaudoEjecucion as $laudoEjecucion){
            $subArray = array();
            $subArray['id'] = $laudoEjecucion->idLaudoEjecucion;
            $subArray['nombre'] = $laudoEjecucion->nombre;
            array_push($arrDatosPantalla['laudo_ejecucion'],$subArray);
        }

        $qryLaudoAFavor = LaudoAFavor::orderBy('nombre','ASC')->get();
        foreach($qryLaudoAFavor as $laudoAFavor){
            $subArray = array();
            $subArray['id'] = $laudoAFavor->idLaudoAFavor;
            $subArray['nombre'] = $laudoAFavor->nombre;
            array_push($arrDatosPantalla['laudo_a_favor'],$subArray);
        }


        return view('expediente.nuevo')
            ->with('objDatosPantalla',$arrDatosPantalla);
    }

    public function info()
    {
        return view('expediente.info');
    }

    public function editar()
    {
        return view('expediente.editar');
    }
}
