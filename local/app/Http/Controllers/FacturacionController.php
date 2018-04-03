<?php

namespace App\Http\Controllers;

use App\Http\Models\Expediente;
use App\Http\Models\Factura;
use App\Http\Models\FacturaConcepto;
use App\Http\Models\FacturaEstado;
use App\Http\Models\FacturaFechaNotificacion;
use App\Http\Models\FacturaImporteParcial;
use App\Http\Models\FacturaObservacion;
use App\Http\Models\PersonaJuridica;
use App\Http\Models\PersonaNatural;
use App\Http\Models\StoreProcedure\FacturacionSP;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class FacturacionController extends Controller
{
    public function lista()
    {
        $razonSocial = Input::get('razonSocial');
        $numeroExpediente = Input::get('numeroExpediente');
        $numeroComprobante = Input::get('numeroComprobante');
        $concepto = Input::get('concepto');
        $estado = Input::get('estado');
        $fechaEmision = Input::get('fechaEmision');
        $fechaVencimiento = Input::get('fechaVencimiento');


        if($razonSocial==null){
            $razonSocial = "";
        }

        if($numeroExpediente==null){
            $numeroExpediente = "";
        }

        if($numeroComprobante==null){
            $numeroComprobante = "";
        }

        if($concepto==null){
            $concepto = "-";
        }

        if($estado==null){
            $estado = "-";
        }

        if($fechaEmision==null){
            $fechaEmision = "";
            $carbonFechaEmision = "";
        }
        else {
            $fechaEmision = str_replace('/', '-', $fechaEmision);
            $parseFechaEmision = date("Y-m-d", strtotime($fechaEmision));
            $carbonFechaEmision = Carbon::parse($parseFechaEmision);
        }

        if($fechaVencimiento==null){
            $fechaVencimiento = "";
            $carbonFechaVencimiento = "";
        }
        else{
            $fechaVencimiento = str_replace('/', '-', $fechaVencimiento);
            $parseFechaVencimiento = date("Y-m-d", strtotime($fechaVencimiento));
            $carbonFechaVencimiento = Carbon::parse($parseFechaVencimiento);
        }

        $qryFacturas = FacturacionSP::facturacionBuscarFacturas($razonSocial,$numeroExpediente,$numeroComprobante,$concepto,$estado,$fechaEmision,$fechaVencimiento);

        $lstFacturas = array();

        foreach ($qryFacturas as $factura) {
            $subArray = array();
            $subArray['id'] = $factura->idFactura;
            $subArray['numeroExpediente'] = $factura->numeroExpediente;
            $subArray['nombreCliente'] = $factura->nombreCliente;
            $subArray['fechaEmision'] = $factura->fechaEmision;
			$subArray['fechaVencimiento'] = $factura->fechaVencimiento;
			$subArray['numeroComprobante'] = $factura->numeroComprobante;
			$subArray['facturaConcepto'] = $factura->facturaConcepto;
			$subArray['facturaEstado'] = $factura->facturaEstado;
			$subArray['idDemandante'] = $factura->idDemandante;
			$subArray['nombreDemandante'] = $factura->nombreDemandante;
			$subArray['idDemandado'] = $factura->idDemandado;
			$subArray['nombreDemandado'] = $factura->nombreDemandado;
			$subArray['numNotificaciones'] = $factura->numNotificaciones;

            array_push($lstFacturas,$subArray);
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage()-1;
        $collection = new Collection($lstFacturas);
        $perPage = 5;
        $currentResults = $collection->slice($currentPage * $perPage, $perPage)->all();
        $paginatedResults= new LengthAwarePaginator($currentResults, count($collection), $perPage,($currentPage+1),[
            'path'  => request()->url(),
            'query' => request()->query(),
        ]);

        // FACTURA CONCEPTO
        $qryFacturaConcepto = FacturaConcepto::orderBy('nombre','ASC')->get();
        $arrFacturaConcepto = array();

        foreach($qryFacturaConcepto as $facturaConcepto){
            $arrSubFacturaConcepto = array();
            $arrSubFacturaConcepto['idFacturaConcepto']=$facturaConcepto->idFacturaConcepto;
            $arrSubFacturaConcepto['nombre']=$facturaConcepto->nombre;
            array_push($arrFacturaConcepto,$arrSubFacturaConcepto);
        }

        // FACTURA ESTADO
        $qryFacturaEstado = FacturaEstado::orderBy('nombre','ASC')->get();
        $arrFacturaEstado= array();

        foreach($qryFacturaEstado as $facturaEstado){
            $arrSubFacturaEstado = array();
            $arrSubFacturaEstado['idFacturaEstado']=$facturaEstado->idFacturaEstado;
            $arrSubFacturaEstado['nombre']=$facturaEstado->nombre;
            array_push($arrFacturaEstado,$arrSubFacturaEstado);
        }

        return view('facturacion.lista')
            ->with('razonSocial',$razonSocial)
            ->with('numeroExpediente',$numeroExpediente)
            ->with('numeroComprobante',$numeroComprobante)
            ->with('concepto',$concepto)
            ->with('estado',$estado)
            ->with('fechaEmision',$fechaEmision)
            ->with('fechaVencimiento',$fechaVencimiento)
            ->with('lstFacturas',$paginatedResults)
            ->with('lstFacturaConcepto',$arrFacturaConcepto)
            ->with('lstFacturaEstado',$arrFacturaEstado);
    }

    public function nuevo($idFactura)
    {
        if($idFactura=="-"){
            session(['objFactura' => null]);
        }

        $objFactura = session('objFactura');

        if($objFactura==null){
            $arrFactura = array();
            $arrFactura['idFactura'] = "0";
            $arrFactura['cliente'] = array();
            $arrFactura['expediente'] = array();
            $arrFactura['numero_comprobante'] = "";
            $arrFactura['concepto'] = array();
            $arrFactura['estado'] = array();
            $arrFactura['importe_facturacion'] = "";
            $arrFactura['fecha_emision'] = "";
            $arrFactura['fecha_vencimiento'] = "";
            $arrFactura['fechas_notificacion'] = array();
            $arrFactura['importes_facturados'] = array();
            $arrFactura['observaciones'] = array();

            $subArrayCliente = array();
            $subArrayCliente['idCliente']="0";
            $subArrayCliente['flgClienteTipoPersona']="";
            $subArrayCliente['nombreCliente']="";
            array_push($arrFactura['cliente'],$subArrayCliente);

            $subArrayExpediente = array();
            $subArrayExpediente['idExpediente']="0";
            $subArrayExpediente['numeroExpediente']="";
            array_push($arrFactura['expediente'],$subArrayExpediente);

            $subArrayConcepto = array();
            $subArrayConcepto['idConcepto']="0";
            $subArrayConcepto['nombreConcepto']="";
            array_push($arrFactura['concepto'],$subArrayConcepto);

            $subArrayEstado = array();
            $subArrayEstado['idEstado']="0";
            $subArrayEstado['nombreEstado']="";
            array_push($arrFactura['estado'],$subArrayEstado);
        }
        else{
            $arrFactura = $objFactura;
        }

        // FACTURA CONCEPTO
        $qryFacturaConcepto = FacturaConcepto::orderBy('nombre','ASC')->get();
        $arrFacturaConcepto = array();

        foreach($qryFacturaConcepto as $facturaConcepto){
            $arrSubFacturaConcepto = array();
            $arrSubFacturaConcepto['idFacturaConcepto']=$facturaConcepto->idFacturaConcepto;
            $arrSubFacturaConcepto['nombre']=$facturaConcepto->nombre;
            array_push($arrFacturaConcepto,$arrSubFacturaConcepto);
        }

        // FACTURA ESTADO
        $qryFacturaEstado = FacturaEstado::orderBy('nombre','ASC')->get();
        $arrFacturaEstado= array();

        foreach($qryFacturaEstado as $facturaEstado){
            $arrSubFacturaEstado = array();
            $arrSubFacturaEstado['idFacturaEstado']=$facturaEstado->idFacturaEstado;
            $arrSubFacturaEstado['nombre']=$facturaEstado->nombre;
            array_push($arrFacturaEstado,$arrSubFacturaEstado);
        }

        return view('facturacion.nuevo')
            ->with('objFactura',$arrFactura)
            ->with('lstFacturaConcepto',$arrFacturaConcepto)
            ->with('lstFacturaEstado',$arrFacturaEstado);
    }

    public function editar($idFactura,$flgInicio)
    {
        if($flgInicio=="S"){
            session(['objFactura' => null]);
        }

        $objFactura = session('objFactura');

        if($objFactura==null){
            $qryfactura = Factura::where('idFactura','=',$idFactura)->first();

            $arrFactura = array();
            $arrFactura['idFactura'] = $qryfactura->idFactura;
            $arrFactura['cliente'] = array();
            $arrFactura['expediente'] = array();
            $arrFactura['numero_comprobante'] = $qryfactura->numeroComprobante;
            $arrFactura['concepto'] = array();
            $arrFactura['estado'] = array();
            $arrFactura['importe_facturacion'] = $qryfactura->importeTotal;
            $arrFactura['fecha_emision'] = date("Y-m-d", strtotime($qryfactura->fechaEmision));
            $arrFactura['fecha_vencimiento'] = date("Y-m-d", strtotime($qryfactura->fechaVencimiento));
            $arrFactura['fechas_notificacion'] = array();
            $arrFactura['importes_facturados'] = array();
            $arrFactura['observaciones'] = array();

            $subArrayCliente = array();

            if($qryfactura->flgClientePersonaTipo=="J"){
                $subArrayCliente['idCliente']=$qryfactura->personaJuridica->idPersonaJuridica;
                $subArrayCliente['nombreCliente']=$qryfactura->personaJuridica->razonSocial;
                $subArrayCliente['flgClienteTipoPersona']="J";
                array_push($arrFactura['cliente'],$subArrayCliente);
            } else {
                $subArrayCliente['idCliente']=$qryfactura->personaNatural->idPersonaNatural;
                $subArrayCliente['nombreCliente']=$qryfactura->personaNatural->nombre.' '.$qryfactura->personaNatural->apellidoPaterno.' '.$qryfactura->personaNatural->apellidoMaterno;
                $subArrayCliente['flgClienteTipoPersona']="N";
                array_push($arrFactura['cliente'],$subArrayCliente);
            }

            $qryExpediente = Expediente::where('idExpediente','=',$qryfactura->idExpediente)->first();

            $subArrayExpediente = array();
            $subArrayExpediente['idExpediente']=$qryExpediente->idExpediente;
            $subArrayExpediente['numeroExpediente']=$qryExpediente->numero;
            array_push($arrFactura['expediente'],$subArrayExpediente);

            $subArrayConcepto = array();
            $subArrayConcepto['idConcepto']=$qryfactura->facturaConcepto->idFacturaConcepto;
            $subArrayConcepto['nombreConcepto']=$qryfactura->facturaConcepto->nombre;
            array_push($arrFactura['concepto'],$subArrayConcepto);

            $subArrayEstado = array();
            $subArrayEstado['idEstado']=$qryfactura->facturaEstado->idFacturaEstado;
            $subArrayEstado['nombreEstado']=$qryfactura->facturaEstado->nombre;
            array_push($arrFactura['estado'],$subArrayEstado);

            foreach($qryfactura->facturaFechaNotificacions as $fechaNotificacion){
                $subArray = array();
                $subArray['hash'] = $fechaNotificacion->idFacturaFechaNotificacion;
                $subArray['id'] = $fechaNotificacion->idFacturaFechaNotificacion;
                $subArray['fecha'] = date("Y-m-d", strtotime($fechaNotificacion->fecha));
                array_push($arrFactura['fechas_notificacion'],$subArray);
            }

            foreach($qryfactura->facturaImporteParcials as $importeParcial){
                $subArray = array();
                $subArray['hash'] = $importeParcial->idFacturaImporteParcial;
                $subArray['id'] = $importeParcial->idFacturaImporteParcial;
                $subArray['importeParcial'] = $importeParcial->importe;
                array_push($arrFactura['importes_facturados'],$subArray);
            }

            foreach($qryfactura->facturaObservacions as $observacion){
                $subArray = array();
                $subArray['hash'] = $observacion->idFacturaObservacion;
                $subArray['id'] = $observacion->idFacturaObservacion;
                $subArray['observacion'] = $observacion->observacion;
                array_push($arrFactura['observaciones'],$subArray);
            }

            session(['objFactura' => $arrFactura]);

        }
        else{
            $arrFactura = $objFactura;
        }

        // FACTURA CONCEPTO
        $qryFacturaConcepto = FacturaConcepto::orderBy('nombre','ASC')->get();
        $arrFacturaConcepto = array();

        foreach($qryFacturaConcepto as $facturaConcepto){
            $arrSubFacturaConcepto = array();
            $arrSubFacturaConcepto['idFacturaConcepto']=$facturaConcepto->idFacturaConcepto;
            $arrSubFacturaConcepto['nombre']=$facturaConcepto->nombre;
            array_push($arrFacturaConcepto,$arrSubFacturaConcepto);
        }

        // FACTURA ESTADO
        $qryFacturaEstado = FacturaEstado::orderBy('nombre','ASC')->get();
        $arrFacturaEstado= array();

        foreach($qryFacturaEstado as $facturaEstado){
            $arrSubFacturaEstado = array();
            $arrSubFacturaEstado['idFacturaEstado']=$facturaEstado->idFacturaEstado;
            $arrSubFacturaEstado['nombre']=$facturaEstado->nombre;
            array_push($arrFacturaEstado,$arrSubFacturaEstado);
        }

        return view('facturacion.editar')
            ->with('objFactura',$arrFactura)
            ->with('lstFacturaConcepto',$arrFacturaConcepto)
            ->with('lstFacturaEstado',$arrFacturaEstado);
    }

    public function borrar($idFactura)
    {
        FacturaFechaNotificacion::where('idFactura','=',$idFactura)->delete();
        FacturaImporteParcial::where('idFactura','=',$idFactura)->delete();
        FacturaObservacion::where('idFactura','=',$idFactura)->delete();
        Factura::where('idFactura','=',$idFactura)->delete();

        return "true";
    }


    public function registrar(Request $request)
    {
        $idCliente = $request->input('idCliente');
        $flgClienteTipoPersona = $request->input('flgClienteTipoPersona');
        $idExpediente = $request->input('idExpediente');
        $numeroComprobante = $request->input('numeroComprobante');
        $concepto = $request->input('concepto');
        $estado = $request->input('estado');
        $importeFacturacion = $request->input('importeFacturacion');
        $fechaEmision = $request->input('fechaEmision');
        $fechaVencimiento = $request->input('fechaVencimiento');

        $fechaEmision = str_replace('/', '-', $fechaEmision);
        $fechaVencimiento = str_replace('/', '-', $fechaVencimiento);
        $parseFechaEmision = date("Y-m-d", strtotime($fechaEmision));
        $parseFechaVencimiento = date("Y-m-d", strtotime($fechaVencimiento));

        $carbonFechaEmision = Carbon::parse($parseFechaEmision);
        $carbonFechaVencimiento = Carbon::parse($parseFechaVencimiento);

        $objFactura = new Factura;
        $objFactura->idExpediente = $idExpediente;
        $objFactura->idUsuarioCreador = Auth::user()->usuarios[0]->idUsuario;
        $objFactura->idFacturaConcepto = $concepto;
        $objFactura->idFacturaEstado = $estado;

        if($flgClienteTipoPersona=="J"){
            $objCliente = PersonaJuridica::where('idPersonaJuridica','=',$idCliente)->first();
            $objFactura->idClientePersonaNatural = null;
            $objFactura->idClientePersonaJuridica = $idCliente;
            $objFactura->nombreCliente = $objCliente->razonSocial;
        } else {
            $objCliente = PersonaNatural::where('idPersonaNatural','=',$idCliente)->first();
            $objFactura->idClientePersonaNatural = $idCliente;
            $objFactura->idClientePersonaJuridica = null;
            $objFactura->nombreCliente = $objCliente->nombre.' '.$objCliente->apellidoPaterno.' '.$objCliente->apellidoMaterno;
        }

        $objFactura->numeroComprobante = $numeroComprobante;
        $objFactura->fechaEmision = $carbonFechaEmision;
        $objFactura->fechaVencimiento = $carbonFechaVencimiento;
        $objFactura->importeTotal = $importeFacturacion;
        $objFactura->flgClientePersonaTipo = $flgClienteTipoPersona;

        $objFactura->save();

        // INICIO REGISTRO DATOS COMPLEMENTARIOS
        $idFactura = $objFactura->id;
        $sesionFactura = session('objFactura');

        if(count($sesionFactura['fechas_notificacion'])>0){
            foreach($sesionFactura['fechas_notificacion'] as $fechaNotificacion){
                $objFacturaFechaNotificacion = new FacturaFechaNotificacion;
                $objFacturaFechaNotificacion->idFactura = $idFactura;
                $objFacturaFechaNotificacion->fecha = $fechaNotificacion['fecha'];
                $objFacturaFechaNotificacion->save();
            }
        }

        if(count($sesionFactura['importes_facturados'])>0){
            foreach($sesionFactura['importes_facturados'] as $importeFacturado){
                $objImporteFacturado = new FacturaImporteParcial;
                $objImporteFacturado->idFactura = $idFactura;
                $objImporteFacturado->importe = $importeFacturado['importeParcial'];
                $objImporteFacturado->save();
            }
        }

        if(count($sesionFactura['observaciones'])>0){
            foreach($sesionFactura['observaciones'] as $observacion){
                $objObservacion = new FacturaObservacion;
                $objObservacion->idFactura = $idFactura;
                $objObservacion->observacion = $observacion['observacion'];
                $objObservacion->save();
            }
        }

        return "true";
    }




    public function registrarEditar(Request $request)
    {
        $idFactura = $request->input('idFactura');
        $idCliente = $request->input('idCliente');
        $flgClienteTipoPersona = $request->input('flgClienteTipoPersona');
        $idExpediente = $request->input('idExpediente');
        $numeroComprobante = $request->input('numeroComprobante');
        $concepto = $request->input('concepto');
        $estado = $request->input('estado');
        $importeFacturacion = $request->input('importeFacturacion');
        $fechaEmision = $request->input('fechaEmision');
        $fechaVencimiento = $request->input('fechaVencimiento');

        $fechaEmision = str_replace('/', '-', $fechaEmision);
        $fechaVencimiento = str_replace('/', '-', $fechaVencimiento);
        $parseFechaEmision = date("Y-m-d", strtotime($fechaEmision));
        $parseFechaVencimiento = date("Y-m-d", strtotime($fechaVencimiento));

        $carbonFechaEmision = Carbon::parse($parseFechaEmision);
        $carbonFechaVencimiento = Carbon::parse($parseFechaVencimiento);

        // INICIO DE ACTUALIZACION DE FACTURA
        $objFactura = Factura::where("idFactura","=",$idFactura);

        if($flgClienteTipoPersona=="J"){
            $objCliente = PersonaJuridica::where('idPersonaJuridica','=',$idCliente)->first();

            $objFactura->update([
                'idExpediente' => $idExpediente,
                'idUsuarioCreador' => Auth::user()->usuarios[0]->idUsuario,
                'idFacturaConcepto' => $concepto,
                'idFacturaEstado' => $estado,
                'idClientePersonaNatural' => null,
                'idClientePersonaJuridica' => $idCliente,
                'nombreCliente' => $objCliente->razonSocial,
                'numeroComprobante' => $numeroComprobante,
                'fechaEmision' => $carbonFechaEmision,
                'fechaVencimiento' => $carbonFechaVencimiento,
                'importeTotal' => $importeFacturacion,
                'flgClientePersonaTipo' => $flgClienteTipoPersona,
            ]);
        } else {
            $objCliente = PersonaNatural::where('idPersonaNatural','=',$idCliente)->first();

            $objFactura->update([
                'idExpediente' => $idExpediente,
                'idUsuarioCreador' => Auth::user()->usuarios[0]->idUsuario,
                'idFacturaConcepto' => $concepto,
                'idFacturaEstado' => $estado,
                'idClientePersonaNatural' => $idCliente,
                'idClientePersonaJuridica' => null,
                'nombreCliente' => $objCliente->nombre.' '.$objCliente->apellidoPaterno.' '.$objCliente->apellidoMaterno,
                'numeroComprobante' => $numeroComprobante,
                'fechaEmision' => $carbonFechaEmision,
                'fechaVencimiento' => $carbonFechaVencimiento,
                'importeTotal' => $importeFacturacion,
                'flgClientePersonaTipo' => $flgClienteTipoPersona,
            ]);
        }


        // INICIO ACTUALIZACION DATOS COMPLEMENTARIOS
        $sesionFactura = session('objFactura');


        // =====================
        //  FECHA NOTIFICACION
        // =====================

        // 0. Creamos dos nuevos arrays: uno con los Ids registrados actualmente, y otro con los Ids de la sesion
        $arrIdFechaNotificacionActuales = array();
        $qryFacturaFechaNotificacion = FacturaFechaNotificacion::where('idFactura','=',$idFactura)->get();
        foreach($qryFacturaFechaNotificacion as $fechaNotificacion){
            array_push($arrIdFechaNotificacionActuales,$fechaNotificacion->idFacturaFechaNotificacion);
        }

        $arrIdFechaNotificacionSesion = array();
        foreach($sesionFactura['fechas_notificacion'] as $sesionFechaNotificacion){
            array_push($arrIdFechaNotificacionSesion,$sesionFechaNotificacion['id']);
        }

        // 1. Obtenemos el array() con los Ids que se van a borrar, pues han sido eliminados en la actualizacion
        $arrNotificacionBorrar = array();
        foreach($arrIdFechaNotificacionActuales as $idFechaNotificacion){
            if (!in_array($idFechaNotificacion, $arrIdFechaNotificacionSesion)) {
                array_push($arrNotificacionBorrar,$idFechaNotificacion);
            }
        }

        // 2. Borramos los Ids que esten dentro del arreglo de borrado
        foreach($arrNotificacionBorrar as $idNotificacionBorrar){
            FacturaFechaNotificacion::where('idFacturaFechaNotificacion','=',$idNotificacionBorrar)->delete();
        }

        // 3. Iniciamos el registro de los Ids
        foreach($sesionFactura['fechas_notificacion'] as $sesionFechaNotificacion){

            $objFacturaFechaNotificacion = FacturaFechaNotificacion::where('idFacturaFechaNotificacion','=',$sesionFechaNotificacion['id']);

            if(!$objFacturaFechaNotificacion->exists()){
                $objFacturaFechaNotificacion = new FacturaFechaNotificacion;
                $objFacturaFechaNotificacion->idFactura = $idFactura;
                $objFacturaFechaNotificacion->fecha = $sesionFechaNotificacion['fecha'];
                $objFacturaFechaNotificacion->save();
            }
        }


        // =====================
        //  IMPORTES FACTURADOS
        // =====================

        // 0. Creamos dos nuevos arrays: uno con los Ids registrados actualmente, y otro con los Ids de la sesion
        $arrIdImporteFacturadoActuales = array();
        $qryFacturaImporteParcial = FacturaImporteParcial::where('idFactura','=',$idFactura)->get();
        foreach($qryFacturaImporteParcial as $importeParcial){
            array_push($arrIdImporteFacturadoActuales,$importeParcial->idFacturaImporteParcial);
        }

        $arrIdImporteFacturadoSesion = array();
        foreach($sesionFactura['importes_facturados'] as $sesionImporteFacturado){
            array_push($arrIdImporteFacturadoSesion,$sesionImporteFacturado['id']);
        }

        // 1. Obtenemos el array() con los Ids que se van a borrar, pues han sido eliminados en la actualizacion
        $arrImporteBorrar = array();
        foreach($arrIdImporteFacturadoActuales as $idImporteFacturado){
            if (!in_array($idImporteFacturado, $arrIdImporteFacturadoSesion)) {
                array_push($arrImporteBorrar,$idImporteFacturado);
            }
        }

        // 2. Borramos los Ids que esten dentro del arreglo de borrado
        foreach($arrImporteBorrar as $idImporteBorrar){
            FacturaImporteParcial::where('idFacturaImporteParcial','=',$idImporteBorrar)->delete();
        }

        // 3. Iniciamos el registro de los Ids
        foreach($sesionFactura['importes_facturados'] as $sesionImporteFacturado){

            $objFacturaImporteParcial = FacturaImporteParcial::where('idFacturaImporteParcial','=',$sesionImporteFacturado['id']);

            if(!$objFacturaImporteParcial->exists()){
                $objFacturaImporteParcial = new FacturaImporteParcial;
                $objFacturaImporteParcial->idFactura = $idFactura;
                $objFacturaImporteParcial->importe = $sesionImporteFacturado['importeParcial'];
                $objFacturaImporteParcial->save();
            }
        }


        // ===============
        //  OBSERVACIONES
        // ===============

        // 0. Creamos dos nuevos arrays: uno con los Ids registrados actualmente, y otro con los Ids de la sesion
        $arrIdObservacionActuales = array();
        $qryFacturaObservacion = FacturaObservacion::where('idFactura','=',$idFactura)->get();
        foreach($qryFacturaObservacion as $observacion){
            array_push($arrIdObservacionActuales,$observacion->idFacturaObservacion);
        }

        $arrIdObservacionSesion = array();
        foreach($sesionFactura['observaciones'] as $sesionObservacion){
            array_push($arrIdObservacionSesion,$sesionObservacion['id']);
        }

        // 1. Obtenemos el array() con los Ids que se van a borrar, pues han sido eliminados en la actualizacion
        $arrObservacionBorrar = array();
        foreach($arrIdObservacionActuales as $idObservacion){
            if (!in_array($idObservacion, $arrIdObservacionSesion)) {
                array_push($arrObservacionBorrar,$idObservacion);
            }
        }

        // 2. Borramos los Ids que esten dentro del arreglo de borrado
        foreach($arrObservacionBorrar as $idObservacionBorrar){
            FacturaObservacion::where('idFacturaObservacion','=',$idObservacionBorrar)->delete();
        }

        // 3. Iniciamos el registro de los Ids
        foreach($sesionFactura['observaciones'] as $sesionObservacion){

            $objFacturaObservacion = FacturaObservacion::where('idFacturaObservacion','=',$sesionObservacion['id']);

            if(!$objFacturaObservacion->exists()){
                $objFacturaObservacion = new FacturaObservacion;
                $objFacturaObservacion->idFactura = $idFactura;
                $objFacturaObservacion->observacion = $sesionObservacion['observacion'];
                $objFacturaObservacion->save();
            }
        }

        return "true";
    }

    public function actualizar($idFactura)
    {
        return view('facturacion.editar');
    }

    // ========================================================

    public function nuevaNotificacion($idFactura)
    {
        $objFactura = session('objFactura');

        return view('facturacion.notificacion')
            ->with('objFactura',$objFactura);
    }

    public function nuevoImporte($idFactura)
    {
        $objFactura = session('objFactura');

        return view('facturacion.importe')
            ->with('objFactura',$objFactura);
    }

    public function nuevaObservacion($idFactura)
    {
        $objFactura = session('objFactura');

        return view('facturacion.observacion')
            ->with('objFactura',$objFactura);
    }

    public function buscarCliente()
    {
        $objFactura = session('objFactura');

        $razonSocial = Input::get('razonSocial');
        $tipoCliente = Input::get('tipoCliente');

        if($razonSocial==null){
            $razonSocial = "";
        }

        if($tipoCliente==null){
            $tipoCliente = "-";
        }

        $spClientes = FacturacionSP::facturacionBuscarClientes($razonSocial,$tipoCliente);
        $lstClientes = array();

        foreach ($spClientes as $cliente) {
            $subArray = array();
            $subArray["id"] = $cliente->id;
            $subArray["nombre"] = $cliente->nombre;
            $subArray["tipo_persona"] = $cliente->tipo_persona;
            $subArray["tipo_persona_nombre"] = $cliente->tipo_persona_nombre;

            array_push($lstClientes,$subArray);
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage()-1;
        $collection = new Collection($lstClientes);
        $perPage = 5;
        $currentResults = $collection->slice($currentPage * $perPage, $perPage)->all();
        $paginatedResults= new LengthAwarePaginator($currentResults, count($collection), $perPage,($currentPage+1),[
            'path'  => request()->url(),
            'query' => request()->query(),
        ]);

        return view('facturacion.buscarCliente')
            ->with('objFactura',$objFactura)
            ->with('razonSocial',$razonSocial)
            ->with('tipoCliente',$tipoCliente)
            ->with('lstClientes', $paginatedResults);
    }


    public function buscarExpediente()
    {
        $objFactura = session('objFactura');

        $numeroExpediente = Input::get('numeroExpediente');

        if($numeroExpediente==null){
            $numeroExpediente = "";
        }

        $qryExpedientes = Expediente::where('numero','like','%'.$numeroExpediente.'%')->get();
        $lstExpedientes = array();

        foreach ($qryExpedientes as $expediente) {
            $subArray = array();
            $subArray["id"] = $expediente->idExpediente;
            $subArray["numero"] = $expediente->numero;

            $objDemandante = $expediente->expedienteDemandante;

            if($objDemandante->flgTipoPersona=="J"){
                $subArray["demandante"] = $objDemandante->personaJuridica->razonSocial;
            } else {
                $subArray["demandante"] = $objDemandante->personaNatural->nombre." ".$objDemandante->personaNatural->apellidoPaterno." ".$objDemandante->personaNatural->apellidoMaterno;
            }

            $objDemandado = $expediente->expedienteDemandado;

            if($objDemandado->flgTipoPersona=="J"){
                $subArray["demandado"] = $objDemandado->personaJuridica->razonSocial;
            } else {
                $subArray["demandado"] = $objDemandado->personaNatural->nombre." ".$objDemandado->personaNatural->apellidoPaterno." ".$objDemandado->personaNatural->apellidoMaterno;
            }

            array_push($lstExpedientes,$subArray);
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage()-1;
        $collection = new Collection($lstExpedientes);
        $perPage = 5;
        $currentResults = $collection->slice($currentPage * $perPage, $perPage)->all();
        $paginatedResults= new LengthAwarePaginator($currentResults, count($collection), $perPage,($currentPage+1),[
            'path'  => request()->url(),
            'query' => request()->query(),
        ]);

        return view('facturacion.buscarExpediente')
            ->with('objFactura',$objFactura)
            ->with('numeroExpediente',$numeroExpediente)
            ->with('lstExpedientes', $paginatedResults);

    }


    // ===================
    //  SESSION FUNCTIONS
    // ===================

    public function sesionDatosCliente(Request $request)
    {
        $idCliente = $request->input('idCliente');
        $nombreCliente = $request->input('nombreCliente');
        $flgClienteTipoPersona = $request->input('flgClienteTipoPersona');

        $objFactura = session('objFactura');

        $subArray = array();
        $subArray['idCliente']=$idCliente;
        $subArray['nombreCliente']=$nombreCliente;
        $subArray['flgClienteTipoPersona']=$flgClienteTipoPersona;

        $objFactura['cliente'] = array();
        array_push($objFactura['cliente'],$subArray);

        session(['objFactura' => $objFactura]);

        return "true";
    }

    public function sesionDatosExpediente(Request $request)
    {
        $idExpediente = $request->input('idExpediente');
        $numeroExpediente = $request->input('numeroExpediente');

        $objFactura = session('objFactura');

        $subArray = array();
        $subArray['idExpediente']=$idExpediente;
        $subArray['numeroExpediente']=$numeroExpediente;

        $objFactura['expediente'] = array();
        array_push($objFactura['expediente'],$subArray);

        session(['objFactura' => $objFactura]);

        return "true";
    }

    public function sesionDatosNotificacion(Request $request)
    {
        $fechaNotificacion = $request->input('fechaNotificacion');

        $objFactura = session('objFactura');

        $subArray = array();
        $subArray['hash'] = sha1(time());
        $subArray['id'] = '-';
        $subArray['fecha'] = $fechaNotificacion;

        array_push($objFactura['fechas_notificacion'],$subArray);

        session(['objFactura' => $objFactura]);

        return "true";
    }

    public function sesionBorrarNotificacion($hash)
    {
        $objFactura = session('objFactura');

        $objFactura['fechas_notificacion'] = $this->removeElementWithValue($objFactura['fechas_notificacion'], 'hash', $hash);

        session(['objFactura' => $objFactura]);

        return "true";

    }


    public function sesionDatosImporte(Request $request)
    {
        $importeParcial = $request->input('importeParcial');

        $objFactura = session('objFactura');

        $subArray = array();
        $subArray['hash'] = sha1(time());
        $subArray['id'] = '-';
        $subArray['importeParcial'] = $importeParcial;

        array_push($objFactura['importes_facturados'],$subArray);

        session(['objFactura' => $objFactura]);

        return "true";

    }

    public function sesionBorrarImporte($hash)
    {
        $objFactura = session('objFactura');

        $objFactura['importes_facturados'] = $this->removeElementWithValue($objFactura['importes_facturados'], 'hash', $hash);

        session(['objFactura' => $objFactura]);

        return "true";

    }


    public function sesionDatosObservacion(Request $request)
    {
        $observacion = $request->input('observacion');

        $objFactura = session('objFactura');

        $subArray = array();
        $subArray['hash'] = sha1(time());
        $subArray['id'] = '-';
        $subArray['observacion'] = $observacion;

        array_push($objFactura['observaciones'],$subArray);

        session(['objFactura' => $objFactura]);

        return "true";
    }

    public function sesionBorrarObservacion($hash)
    {
        $objFactura = session('objFactura');

        $objFactura['observaciones'] = $this->removeElementWithValue($objFactura['observaciones'], 'hash', $hash);

        session(['objFactura' => $objFactura]);

        return "true";

    }


    public function sesionDatos(Request $request)
    {
        $idFactura = $request->input('idFactura');
        $idCliente = $request->input('idCliente');
        $nombreCliente = $request->input('nombreCliente');
        $flgClienteTipoPersona = $request->input('flgClienteTipoPersona');
        $idExpediente = $request->input('idExpediente');
        $numeroExpediente = $request->input('numeroExpediente');
        $numeroComprobante = $request->input('numeroComprobante');
        $concepto = $request->input('concepto');
        $estado = $request->input('estado');
        $importeFacturacion = $request->input('importeFacturacion');
        $fechaEmision = $request->input('fechaEmision');
        $fechaVencimiento = $request->input('fechaVencimiento');

        if($idCliente==null){
            $idCliente=0;
        }
        if($flgClienteTipoPersona==null){
            $flgClienteTipoPersona="";
        }
        if($idExpediente==null){
            $idExpediente=0;
        }
        if($numeroComprobante==null){
            $numeroComprobante="";
        }
        if($concepto==""){
            $concepto=0;
        }
        if($estado==""){
            $estado=0;
        }
        if($importeFacturacion==null){
            $importeFacturacion="";
        }
        if($fechaEmision==null){
            $fechaEmision="";
        }
        if($fechaVencimiento==null){
            $fechaVencimiento="";
        }

        $objFactura = session('objFactura');

        if($objFactura==null){
            $arrFactura = array();

            $arrFactura['idFactura'] = $idFactura;
            $arrFactura['numero_comprobante'] = $numeroComprobante;
            $arrFactura['importe_facturacion'] = $importeFacturacion;
            $arrFactura['fecha_emision'] = $fechaEmision;
            $arrFactura['fecha_vencimiento'] = $fechaVencimiento;

            $arrFactura['cliente'] = array();
            $arrFactura['expediente'] = array();
            $arrFactura['concepto'] = array();
            $arrFactura['estado'] = array();

            $arrFactura['fechas_notificacion'] = array();
            $arrFactura['importes_facturados'] = array();
            $arrFactura['observaciones'] = array();

            $subArrayCliente = array();
            if($idCliente=="0"){
                $subArrayCliente['idCliente']="0";
                $subArrayCliente['nombreCliente']=$nombreCliente;
                $subArrayCliente['flgClienteTipoPersona']="";
            } else {
                if($flgClienteTipoPersona=="J"){
                    $objCliente = PersonaJuridica::where('idPersonaJuridica',$idCliente)->first();
                    $subArrayCliente['idCliente']=$idCliente;
                    $subArrayCliente['nombreCliente']=$objCliente->razonSocial;
                    $subArrayCliente['flgClienteTipoPersona']=$flgClienteTipoPersona;
                }else{
                    $objCliente = PersonaNatural::where('idPersonaNatural',$idCliente)->first();
                    $subArrayCliente['idCliente']=$idCliente;
                    $subArrayCliente['nombreCliente']=$objCliente->nombre." ".$objCliente->apellidoPaterno." ".$objCliente->apellidoMaterno;
                    $subArrayCliente['flgClienteTipoPersona']=$flgClienteTipoPersona;
                }
            }
            array_push($arrFactura['cliente'],$subArrayCliente);


            $subArrayExpediente = array();
            if($idExpediente=="0") {
                $subArrayExpediente['idExpediente']="0";
                $subArrayExpediente['numeroExpediente']=$numeroExpediente;
            } else {
                $objExpediente = Expediente::where('idExpediente','=',$idExpediente)->first();
                $subArrayExpediente = array();
                $subArrayExpediente['idExpediente']=$objExpediente->idExpediente;
                $subArrayExpediente['numeroExpediente']=$objExpediente->numero;
            }
            array_push($arrFactura['expediente'],$subArrayExpediente);


            $subArrayConcepto = array();
            if($concepto=="0") {
                $subArrayConcepto['idConcepto']="0";
                $subArrayConcepto['nombreConcepto']="";
            } else {
                $objConcepto = FacturaConcepto::where('idFacturaConcepto','=',$concepto)->first();
                $subArrayConcepto['idConcepto']=$objConcepto->idFacturaConcepto;
                $subArrayConcepto['nombreConcepto']=$objConcepto->nombre;
            }
            array_push($arrFactura['concepto'],$subArrayConcepto);

            $subArrayEstado = array();
            if($estado=="0") {
                $subArrayEstado['idEstado']="0";
                $subArrayEstado['nombreEstado']="";
            } else {
                $objEstado = FacturaEstado::where('idFacturaEstado','=',$estado)->first();
                $subArrayEstado['idEstado']=$objEstado->idFacturaEstado;
                $subArrayEstado['nombreEstado']=$objEstado->nombre;
            }
            array_push($arrFactura['estado'],$subArrayEstado);

            // 3. Actualizamos los contenidos de la variable SESSION
            //Session::set('objFactura',$arrFactura);
            session(['objFactura' => $arrFactura]);

        }else{
            // 0. Actualizamos los valores del objeto session con los de REQUEST
            $objFactura['numero_comprobante'] = $numeroComprobante;
            $objFactura['importe_facturacion'] = $importeFacturacion;
            $objFactura['fecha_emision'] = $fechaEmision;
            $objFactura['fecha_vencimiento'] = $fechaVencimiento;

            // 1. Limpiamos los valores de ARRAY del objeto SESSION
            $objFactura['cliente'] = array();
            $objFactura['expediente'] = array();
            $objFactura['concepto'] = array();
            $objFactura['estado'] = array();

            // 2. Actualizamos los valores de ARRAY del objeto session con los de REQUEST
            $subArrayCliente = array();
            if($idCliente=="0"){
                $subArrayCliente['idCliente']="0";
                $subArrayCliente['nombreCliente']="";
                $subArrayCliente['flgClienteTipoPersona']="";
            } else {
                if($flgClienteTipoPersona=="J"){
                    $objCliente = PersonaJuridica::where('idPersonaJuridica',$idCliente)->first();
                    $subArrayCliente['idCliente']=$idCliente;
                    $subArrayCliente['nombreCliente']=$objCliente->razonSocial;
                    $subArrayCliente['flgClienteTipoPersona']=$flgClienteTipoPersona;
                }else{
                    $objCliente = PersonaNatural::where('idPersonaNatural',$idCliente)->first();
                    $subArrayCliente['idCliente']=$idCliente;
                    $subArrayCliente['nombreCliente']=$objCliente->nombre." ".$objCliente->apellidoPaterno." ".$objCliente->apellidoMaterno;
                    $subArrayCliente['flgClienteTipoPersona']=$flgClienteTipoPersona;
                }
            }
            array_push($objFactura['cliente'],$subArrayCliente);


            $subArrayExpediente = array();
            if($idExpediente=="0") {
                $subArrayExpediente['idExpediente']="0";
                $subArrayExpediente['numeroExpediente']="";
            } else {
                $objExpediente = Expediente::where('idExpediente','=',$idExpediente)->first();
                $subArrayExpediente = array();
                $subArrayExpediente['idExpediente']=$objExpediente->idExpediente;
                $subArrayExpediente['numeroExpediente']=$objExpediente->numero;
            }
            array_push($objFactura['expediente'],$subArrayExpediente);


            $subArrayConcepto = array();
            if($concepto=="0") {
                $subArrayConcepto['idConcepto']="0";
                $subArrayConcepto['nombreConcepto']="";
            } else {
                $objConcepto = FacturaConcepto::where('idFacturaConcepto','=',$concepto)->first();
                $subArrayConcepto['idConcepto']=$objConcepto->idFacturaConcepto;
                $subArrayConcepto['nombreConcepto']=$objConcepto->nombre;
            }
            array_push($objFactura['concepto'],$subArrayConcepto);

            $subArrayEstado = array();
            if($estado=="0") {
                $subArrayEstado['idEstado']="0";
                $subArrayEstado['nombreEstado']="";
            } else {
                $objEstado = FacturaEstado::where('idFacturaEstado','=',$estado)->first();
                $subArrayEstado['idEstado']=$objEstado->idFacturaEstado;
                $subArrayEstado['nombreEstado']=$objEstado->nombre;
            }
            array_push($objFactura['estado'],$subArrayEstado);


            // 3. Actualizamos los contenidos de la variable SESSION
            //Session::set('objFactura',$objfactura);
            session(['objFactura' => $objFactura]);
        }

        return "true";
    }

    // ===================
    //  PRIVATE FUNCTIONS
    // ===================

    function removeElementWithValue($array, $key, $value){
        foreach($array as $subKey => $subArray){
            if($subArray[$key] == $value){
                unset($array[$subKey]);
            }
        }
        return $array;
    }
}
