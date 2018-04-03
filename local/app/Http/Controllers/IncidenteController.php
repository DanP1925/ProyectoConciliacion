<?php

namespace App\Http\Controllers;

use App\Http\Models\Expediente;
use App\Http\Models\Incidente;
use App\Http\Models\IncidenteDetalle;
use App\Http\Models\IncidenteFecha;
use App\Http\Models\IncidenteObservacion;
use App\Http\Models\IncidenteTipo;
use App\Http\Models\IncidenteUsuario;
use App\Http\Models\StoreProcedure\IncidenteSP;
use App\Http\Models\UsuarioLegal;
use App\Http\Models\UsuarioLegalPais;
use App\Http\Models\UsuarioLegalProfesion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;

class IncidenteController extends Controller
{
    public function lista()
    {
        $numeroExpediente = Input::get('numeroExpediente');
        $fechaInicio = Input::get('fechaInicio');
        $fechaFin = Input::get('fechaFin');
        $secretario = Input::get('secretario');
        $tipoIncidente = Input::get('tipoIncidente');
        $estado = Input::get('estado');

        if($numeroExpediente==null){
            $numeroExpediente = "";
        }

        if($fechaInicio==null){
            $fechaInicio = "";
            $carbonFechaInicio = "";
        } else {
            $fechaInicio = str_replace('/', '-', $fechaInicio);
            $parseFechaInicio = date("Y-m-d", strtotime($fechaInicio));
            $carbonFechaInicio = Carbon::parse($parseFechaInicio);
        }

        if($fechaFin==null){
            $fechaFin = "";
            $carbonFechaFin = "";
        } else {
            $fechaFin = str_replace('/', '-', $fechaFin);
            $parseFechaFin = date("Y-m-d", strtotime($fechaFin));
            $carbonFechaFin = Carbon::parse($parseFechaFin);
        }

        if($secretario==null){
            $secretario = "";
        }

        if($tipoIncidente==null){
            $tipoIncidente = "";
        }

        if($estado==null){
            $estado = "";
        }

        $qryIncidentes = IncidenteSP::incidenteBuscarIncidentes($numeroExpediente,$fechaInicio,$fechaFin,$secretario,$tipoIncidente,$estado);
        $lstIncidentes = array();

        foreach($qryIncidentes as $incidente){
            $subArray = array();
            $subArray['id']=$incidente->idIncidente;
			$subArray['fecha']=$incidente->fecha;
			$subArray['idExpediente']=$incidente->idExpediente;
            $subArray['numeroExpediente']=$incidente->numeroExpediente;
            $subArray['tipo']=$incidente->tipo;
            $subArray['secretario']=$incidente->secretario;
            $subArray['estado']=$incidente->estado;

            array_push($lstIncidentes,$subArray);
        }

        // INCIDENTE TIPO
        $qryIncidenteTipo = IncidenteTipo::orderBy('nombre','ASC')->get();
        $arrIncidenteTipo = array();

        foreach($qryIncidenteTipo as $incidenteTipo){
            $subArray = array();
            $subArray['idIncidenteTipo']=$incidenteTipo->idIncidenteTipo;
            $subArray['nombre']=$incidenteTipo->nombre;
            array_push($arrIncidenteTipo,$subArray);
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage()-1;
        $collection = new Collection($lstIncidentes);
        $perPage = 5;
        $currentResults = $collection->slice($currentPage * $perPage, $perPage)->all();
        $paginatedResults= new LengthAwarePaginator($currentResults, count($collection), $perPage,($currentPage+1),[
            'path'  => request()->url(),
            'query' => request()->query(),
        ]);

        return view('incidente.lista')
            ->with('numeroExpediente',$numeroExpediente)
            ->with('fechaInicio',$fechaInicio)
            ->with('fechaFin',$fechaFin)
            ->with('secretario',$secretario)
            ->with('tipoIncidente',$tipoIncidente)
            ->with('estado',$estado)
            ->with('lstIncidentes',$paginatedResults)
            ->with('lstIncidenteTipo',$arrIncidenteTipo);

    }

    public function nuevo($idIncidente)
    {
        if($idIncidente=="-"){
            session(['objIncidente' => null]);
        }

        $objIncidente = session('objIncidente');

        if($objIncidente==null){
            $arrIncidente = array();
            $arrIncidente['idIncidente'] = "0";
            $arrIncidente['expediente'] = array();
            $arrIncidente['tipo'] = array();
            $arrIncidente['secretario'] = array();
            $arrIncidente['fecha_incidente'] = "";
            $arrIncidente['estado'] = "P";
            $arrIncidente['personal_recusante'] = array();
            $arrIncidente['personal_renunciante'] = array();
            $arrIncidente['observaciones'] = array();
            $arrIncidente['fechas'] = array();

            $subArray = array();
            $subArray['idExpediente']="0";
            $subArray['numero']="";
            array_push($arrIncidente['expediente'],$subArray);

            $subArray = array();
            $subArray['idIncidenteTipo']="0";
            $subArray['nombre']="";
            array_push($arrIncidente['tipo'],$subArray);

            $subArray = array();
            $subArray['idSecretario']="0";
            $subArray['nombre']="";
            array_push($arrIncidente['secretario'],$subArray);

        }
        else{
            $arrIncidente = $objIncidente;
        }

        // INCIDENTE TIPO
        $qryIncidenteTipo = IncidenteTipo::orderBy('nombre','ASC')->get();
        $arrIncidenteTipo = array();

        foreach($qryIncidenteTipo as $incidenteTipo){
            $subArray = array();
            $subArray['idIncidenteTipo']=$incidenteTipo->idIncidenteTipo;
            $subArray['nombre']=$incidenteTipo->nombre;
            array_push($arrIncidenteTipo,$subArray);
        }

        return view('incidente.nuevo')
            ->with('objIncidente',$arrIncidente)
            ->with('lstIncidenteTipo',$arrIncidenteTipo);

    }


    public function editar($idIncidente,$flgInicio)
    {
        if($flgInicio=="S"){
            session(['objIncidente' => null]);
        }

        $objIncidente = session('objIncidente');

        if($objIncidente==null){
            $qryIncidente = Incidente::where('idIncidente','=',$idIncidente)->first();

            $arrIncidente = array();
            $arrIncidente['idIncidente'] = $qryIncidente->idIncidente;
            $arrIncidente['expediente'] = array();
            $arrIncidente['tipo'] = $qryIncidente->incidenteTipo->idIncidenteTipo;
            $arrIncidente['tipo_nombre'] = $qryIncidente->incidenteTipo->nombre;

            $arrIncidente['secretario'] = array();
            $arrIncidente['fecha_incidente'] =  date("Y-m-d", strtotime($qryIncidente->fecha));
            $arrIncidente['estado'] = $qryIncidente->estado;
            $arrIncidente['personal_recusante'] = array();
            $arrIncidente['personal_renunciante'] = array();
            $arrIncidente['observaciones'] = array();
            $arrIncidente['fechas'] = array();

            $subArray = array();
            $subArray['idExpediente']=$qryIncidente->expediente->idExpediente;
            $subArray['numero']=$qryIncidente->expediente->numero;
            array_push($arrIncidente['expediente'],$subArray);

            $subArray = array();
            $subArray['idSecretario']=$qryIncidente->incidenteSecretarios->idUsuarioLegal;
            $subArray['nombre']=$qryIncidente->incidenteSecretarios->apellidoPaterno." ".$qryIncidente->incidenteSecretarios->apellidoMaterno.", ".$qryIncidente->incidenteSecretarios->nombre;
            array_push($arrIncidente['secretario'],$subArray);

            if($arrIncidente['tipo']==1){   // RECUSACIÓN
                foreach($qryIncidente->incidenteUsuarios as $incidenteUsuario){
                    $subArray = array();
                    $subArray['hash'] = $incidenteUsuario->usuarioIncidente->idUsuarioLegal;
                    $subArray['id'] = $incidenteUsuario->usuarioIncidente->idUsuarioLegal;
                    $subArray['nombre']=$incidenteUsuario->usuarioIncidente->nombre.' '.$incidenteUsuario->usuarioIncidente->apellidoPaterno.' '.$incidenteUsuario->usuarioIncidente->apellidoMaterno;
                    array_push($arrIncidente['personal_recusante'],$subArray);
                }
            }

            if($arrIncidente['tipo']==2){   // RENUNCIA
                foreach($qryIncidente->incidenteUsuarios as $incidenteUsuario){
                    $subArray = array();
                    $subArray['hash'] = $incidenteUsuario->usuarioIncidente->idUsuarioLegal;
                    $subArray['id'] = $incidenteUsuario->usuarioIncidente->idUsuarioLegal;
                    $subArray['nombre']=$incidenteUsuario->usuarioIncidente->nombre.' '.$incidenteUsuario->usuarioIncidente->apellidoPaterno.' '.$incidenteUsuario->usuarioIncidente->apellidoMaterno;
                    array_push($arrIncidente['personal_renunciante'],$subArray);
                }
            }

            foreach($qryIncidente->incidenteDetalles as $fecha){
                $subArray = array();
                $subArray['hash'] = $fecha->idIncidenteDetalle;
                $subArray['id'] = $fecha->idIncidenteDetalle;
                $subArray['fecha_id'] = $fecha->incidenteFecha->idIncidenteFecha;
                $subArray['fecha_orden'] = $fecha->incidenteFecha->orden;
                $subArray['fecha_nombre'] = $fecha->incidenteFecha->nombre;
                $subArray['fecha'] = date("Y-m-d", strtotime($fecha->fecha));
                array_push($arrIncidente['fechas'],$subArray);
            }

            foreach($qryIncidente->incidenteObservacions as $observacion){
                $subArray = array();
                $subArray['hash'] = $observacion->idIncidenteObservacion;
                $subArray['id'] = $observacion->idIncidenteObservacion;
                $subArray['observacion'] = $observacion->observacion;
                array_push($arrIncidente['observaciones'],$subArray);
            }

            session(['objIncidente' => $arrIncidente]);

        }
        else{
            $arrIncidente = $objIncidente;
        }

        return view('incidente.editar')
            ->with('objIncidente',$arrIncidente);
    }

    public function borrar($idIncidente)
    {
        IncidenteDetalle::where('idIncidente','=',$idIncidente)->delete();
        IncidenteObservacion::where('idIncidente','=',$idIncidente)->delete();
        IncidenteUsuario::where('idIncidente','=',$idIncidente)->delete();
        Incidente::where('idIncidente','=',$idIncidente)->delete();

        return "true";
    }

    public function registrar(Request $request)
    {
        $idIncidente = $request->input('idIncidente');
        $idExpediente = $request->input('idExpediente');
        $tipo = $request->input('tipo');
        $idSecretario = $request->input('idSecretario');
        $fechaIncidente = $request->input('fechaIncidente');
        $estado = $request->input('estado');

        $fechaIncidente = str_replace('/', '-', $fechaIncidente);
        $parseFechaIncidente = date("Y-m-d", strtotime($fechaIncidente));
        $carbonFechaIncidente = Carbon::parse($parseFechaIncidente);

        $objIncidente = new Incidente;
        $objIncidente->idIncidente = $idIncidente;
        $objIncidente->idExpediente = $idExpediente;
        $objIncidente->idIncidenteTipo = $tipo;
        $objIncidente->idSecretario = $idSecretario;
        $objIncidente->fecha = $carbonFechaIncidente;
        $objIncidente->estado = $estado;

        $objIncidente->save();

        // INICIO REGISTRO DATOS COMPLEMENTARIOS
        $idIncidente = $objIncidente->id;
        $sesionIncidente = session('objIncidente');

        if($tipo==1){   // RECUSACIÓN
            if(count($sesionIncidente['personal_recusante'])>0){
                foreach($sesionIncidente['personal_recusante'] as $recusante){
                    $objIncidenteUsuario = new IncidenteUsuario;
                    $objIncidenteUsuario->idIncidente = $idIncidente;
                    $objIncidenteUsuario->idUsuarioIncidente = $recusante["id"];
                    $objIncidenteUsuario->save();
                }
            }
        }

        if($tipo==2){   // RENUNCIA
            if(count($sesionIncidente['personal_renunciante'])>0){
                foreach($sesionIncidente['personal_renunciante'] as $renunciante){
                    $objIncidenteUsuario = new IncidenteUsuario;
                    $objIncidenteUsuario->idIncidente = $idIncidente;
                    $objIncidenteUsuario->idUsuarioIncidente = $renunciante["id"];
                    $objIncidenteUsuario->save();
                }
            }
        }

        if(count($sesionIncidente['fechas'])>0){
            foreach($sesionIncidente['fechas'] as $fecha){
                $objIncidenteDetalle = new IncidenteDetalle;
                $objIncidenteDetalle->idIncidente = $idIncidente;
                $objIncidenteDetalle->idIncidenteFecha = $fecha["fecha_id"];
                $objIncidenteDetalle->fecha = $fecha["fecha"];
                $objIncidenteDetalle->save();
            }
        }

        if(count($sesionIncidente['observaciones'])>0){
            foreach($sesionIncidente['observaciones'] as $observacion){
                $objObservacion = new IncidenteObservacion;
                $objObservacion->idIncidente = $idIncidente;
                $objObservacion->observacion = $observacion['observacion'];
                $objObservacion->save();
            }
        }

        return "true";
    }




    public function registrarEditar(Request $request)
    {
        $idIncidente = $request->input('idIncidente');
        $idExpediente = $request->input('idExpediente');
        $tipo = $request->input('tipo');
        $idSecretario = $request->input('idSecretario');
        $fechaIncidente = $request->input('fechaIncidente');
        $estado = $request->input('estado');

        $fechaIncidente = str_replace('/', '-', $fechaIncidente);
        $parseFechaIncidente = date("Y-m-d", strtotime($fechaIncidente));
        $carbonFechaIncidente = Carbon::parse($parseFechaIncidente);

        // INICIO DE ACTUALIZACION DE INCIDENTE
        $objIncidente = Incidente::where('idIncidente','=',$idIncidente);

        $objIncidente->update([
            'idIncidente' => $idIncidente,
            'idExpediente' => $idExpediente,
            'idIncidenteTipo' => $tipo,
            'idSecretario' => $idSecretario,
            'fecha' => $carbonFechaIncidente,
            'estado' => $estado
        ]);

        // INICIO ACTUALIZACION DATOS COMPLEMENTARIOS
        $sesionIncidente = session('objIncidente');

        if($tipo==1) {   // RECUSACIÓN
            // =====================
            //  PERSONAL RECUSACION
            // =====================

            // 0. Creamos dos nuevos arrays: uno con los Ids registrados actualmente, y otro con los Ids de la sesion
            $arrIdRecusacionActuales = array();
            $qryIncidenteUsuario = IncidenteUsuario::where('idIncidente', '=', $idIncidente)->get();
            foreach ($qryIncidenteUsuario as $incidenteUsuario) {
                array_push($arrIdRecusacionActuales, $incidenteUsuario->idUsuarioIncidente);
            }

            $arrIdRecusacionSesion = array();
            foreach ($sesionIncidente['personal_recusante'] as $sesionRecusacion) {
                array_push($arrIdRecusacionSesion, $sesionRecusacion['id']);
            }

            // 1. Obtenemos el array() con los Ids que se van a borrar, pues han sido eliminados en la actualizacion
            $arrRecusacionBorrar = array();
            foreach ($arrIdRecusacionActuales as $idRecusacion) {
                if (!in_array($idRecusacion, $arrIdRecusacionSesion)) {
                    array_push($arrRecusacionBorrar, $idRecusacion);
                }
            }

            // 2. Borramos los Ids que esten dentro del arreglo de borrado
            foreach($arrRecusacionBorrar as $idRecusacionBorrar){
                IncidenteUsuario::where('idUsuarioIncidente','=',$idRecusacionBorrar)->delete();
            }

            // 3. Iniciamos el registro de los Ids
            foreach($sesionIncidente['personal_recusante'] as $sesionRecusante){

                $objIncidenteUsuario = IncidenteUsuario::where('idUsuarioIncidente','=',$sesionRecusante['id']);

                if(!$objIncidenteUsuario->exists()){
                    $objIncidenteUsuario = new IncidenteUsuario;
                    $objIncidenteUsuario->idIncidente = $idIncidente;
                    $objIncidenteUsuario->idUsuarioIncidente = $sesionRecusante["id"];
                    $objIncidenteUsuario->save();
                }
            }
        }

        if($tipo==2) {   // RENUNCIA
            // ===================
            //  PERSONAL RENUNCIA
            // ===================

            // 0. Creamos dos nuevos arrays: uno con los Ids registrados actualmente, y otro con los Ids de la sesion
            $arrIdRecusacionActuales = array();
            $qryIncidenteUsuario = IncidenteUsuario::where('idIncidente', '=', $idIncidente)->get();
            foreach ($qryIncidenteUsuario as $incidenteUsuario) {
                array_push($arrIdRecusacionActuales, $incidenteUsuario->idUsuarioIncidente);
            }

            $arrIdRecusacionSesion = array();
            foreach ($sesionIncidente['personal_recusante'] as $sesionRecusacion) {
                array_push($arrIdRecusacionSesion, $sesionRecusacion['id']);
            }

            // 1. Obtenemos el array() con los Ids que se van a borrar, pues han sido eliminados en la actualizacion
            $arrRecusacionBorrar = array();
            foreach ($arrIdRecusacionActuales as $idRecusacion) {
                if (!in_array($idRecusacion, $arrIdRecusacionSesion)) {
                    array_push($arrRecusacionBorrar, $idRecusacion);
                }
            }

            // 2. Borramos los Ids que esten dentro del arreglo de borrado
            foreach($arrRecusacionBorrar as $idRecusacionBorrar){
                IncidenteUsuario::where('idUsuarioIncidente','=',$idRecusacionBorrar)->delete();
            }

            // 3. Iniciamos el registro de los Ids
            foreach($sesionIncidente['personal_renunciante'] as $sesionRenunciante){

                $objIncidenteUsuario = IncidenteUsuario::where('idUsuarioIncidente','=',$sesionRenunciante['id']);

                if(!$objIncidenteUsuario->exists()){
                    $objIncidenteUsuario = new IncidenteUsuario;
                    $objIncidenteUsuario->idIncidente = $idIncidente;
                    $objIncidenteUsuario->idUsuarioIncidente = $sesionRenunciante["id"];
                    $objIncidenteUsuario->save();
                }
            }
        }

        // ========
        //  FECHAS
        // ========

        // 0. Creamos dos nuevos arrays: uno con los Ids registrados actualmente, y otro con los Ids de la sesion
        $arrIdFechaActuales = array();
        $qryIncidenteDetalle = IncidenteDetalle::where('idIncidente','=',$idIncidente)->get();
        foreach($qryIncidenteDetalle as $incidenteDetalle){
            array_push($arrIdFechaActuales,$incidenteDetalle->idIncidenteDetalle);
        }

        $arrIdFechaSesion = array();
        foreach($sesionIncidente['fechas'] as $sesionFecha){
            array_push($arrIdFechaSesion,$sesionFecha['id']);
        }

        // 1. Obtenemos el array() con los Ids que se van a borrar, pues han sido eliminados en la actualizacion
        $arrFechaBorrar = array();
        foreach($arrIdFechaActuales as $idFecha){
            if (!in_array($idFecha, $arrIdFechaSesion)) {
                array_push($arrFechaBorrar,$idFecha);
            }
        }

        // 2. Borramos los Ids que esten dentro del arreglo de borrado
        foreach($arrFechaBorrar as $idFechaBorrar){
            IncidenteDetalle::where('idIncidenteDetalle','=',$idFechaBorrar)->delete();
        }

        // 3. Iniciamos el registro de los Ids
        foreach($sesionIncidente['fechas'] as $sesionFecha){

            $objFecha = IncidenteDetalle::where('idIncidenteDetalle','=',$sesionFecha['id']);

            if(!$objFecha->exists()){
                $objFecha = new IncidenteDetalle;
                $objFecha->idIncidente = $idIncidente;
                $objFecha->idIncidenteFecha = $sesionFecha["fecha_id"];
                $objFecha->fecha = $sesionFecha["fecha"];
                $objFecha->save();
            }
        }

        // ===============
        //  OBSERVACIONES
        // ===============

        // 0. Creamos dos nuevos arrays: uno con los Ids registrados actualmente, y otro con los Ids de la sesion
        $arrIdObservacionActuales = array();
        $qryIncidenteObservacion = IncidenteObservacion::where('idIncidente','=',$idIncidente)->get();
        foreach($qryIncidenteObservacion as $observacion){
            array_push($arrIdObservacionActuales,$observacion->idIncidenteObservacion);
        }

        $arrIdObservacionSesion = array();
        foreach($sesionIncidente['observaciones'] as $sesionObservacion){
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
            IncidenteObservacion::where('idIncidenteObservacion','=',$idObservacionBorrar)->delete();
        }

        // 3. Iniciamos el registro de los Ids
        foreach($sesionIncidente['observaciones'] as $sesionObservacion){

            $objIncidenteObservacion = IncidenteObservacion::where('idIncidenteObservacion','=',$sesionObservacion['id']);

            if(!$objIncidenteObservacion->exists()){
                $objIncidenteObservacion = new IncidenteObservacion;
                $objIncidenteObservacion->idIncidente = $idIncidente;
                $objIncidenteObservacion->observacion = $sesionObservacion['observacion'];
                $objIncidenteObservacion->save();
            }
        }


        return "true";
    }





    // ========================================================

    public function nuevaFecha($idIncidente)
    {
        $objIncidente = session('objIncidente');

        $qryIncidenteFecha = IncidenteFecha::where('idIncidenteTipo','=',$objIncidente['tipo'])->orderBy('orden','ASC')->get();
        $lstIncidenteFecha = array();

        foreach($qryIncidenteFecha as $incidenteFecha){
            $subArray = array();
            $subArray['idIncidenteFecha'] = $incidenteFecha->idIncidenteFecha;
            $subArray['orden'] = $incidenteFecha->orden;
            $subArray['nombre'] = $incidenteFecha->nombre;
            array_push($lstIncidenteFecha,$subArray);
        }

        return view('incidente.fecha')
            ->with('lstIncidenteFecha',$lstIncidenteFecha)
            ->with('objIncidente',$objIncidente);
    }

    public function nuevaObservacion($idIncidente)
    {
        $objIncidente = session('objIncidente');

        return view('incidente.observacion')
            ->with('objIncidente',$objIncidente);
    }


    public function buscarExpediente()
    {
        $objIncidente = session('objIncidente');

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

        return view('incidente.buscarExpediente')
            ->with('objIncidente',$objIncidente)
            ->with('numeroExpediente',$numeroExpediente)
            ->with('lstExpedientes', $paginatedResults);

    }



    public function buscarPersonal($tipoPersonal)
    {
        $objIncidente = session('objIncidente');

        $nombre = Input::get('nombre');
        $apellidoPaterno = Input::get('apellidoPaterno');
        $apellidoMaterno = Input::get('apellidoMaterno');
        $profesion = Input::get('profesion');
        $pais = Input::get('pais');

        if($nombre==null){
            $nombre = "";
        }

        if($apellidoPaterno==null){
            $apellidoPaterno = "";
        }

        if($apellidoMaterno==null){
            $apellidoMaterno = "";
        }

        if($profesion==null){
            $profesion = "";
        }

        if($pais==null){
            $pais = "";
        }

        $qryPersonal = IncidenteSP::incidenteBuscarPersonal($nombre,$apellidoPaterno,$apellidoMaterno,$profesion,$pais);
        $lstPersonal = array();

        foreach ($qryPersonal as $personal) {
            $subArray = array();
            $subArray['id'] = $personal->idUsuarioLegal;
            $subArray['nombre'] = $personal->apellidoPaterno." ".$personal->apellidoMaterno.", ".$personal->nombre;
            $subArray['profesion'] = $personal->profesion;
            $subArray['pais'] = $personal->pais;
            array_push($lstPersonal,$subArray);
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage()-1;
        $collection = new Collection($lstPersonal);
        $perPage = 5;
        $currentResults = $collection->slice($currentPage * $perPage, $perPage)->all();
        $paginatedResults= new LengthAwarePaginator($currentResults, count($collection), $perPage,($currentPage+1),[
            'path'  => request()->url(),
            'query' => request()->query(),
        ]);

        $qryPais = UsuarioLegalPais::all();
        $lstPais = array();

        foreach ($qryPais as $usuarioPais) {
            $subArray = array();
            $subArray['id'] = $usuarioPais->idUsuarioLegalPais;
            $subArray['nombre'] = $usuarioPais->nombre;
            array_push($lstPais,$subArray);
        }

        $qryProfesion = UsuarioLegalProfesion::all();
        $lstProfesion = array();

        foreach ($qryProfesion as $usuarioProfesion) {
            $subArray = array();
            $subArray['id'] = $usuarioProfesion->idUsuarioLegalProfesion;
            $subArray['nombre'] = $usuarioProfesion->nombre;
            array_push($lstProfesion,$subArray);
        }

        return view('incidente.buscarPersonal')
            ->with('tipoPersonal',$tipoPersonal)
            ->with('objIncidente',$objIncidente)
            ->with('nombre',$nombre)
            ->with('apellidoPaterno',$apellidoPaterno)
            ->with('apellidoMaterno',$apellidoMaterno)
            ->with('profesion',$profesion)
            ->with('pais',$pais)
            ->with('lstProfesion',$lstProfesion)
            ->with('lstPais',$lstPais)
            ->with('lstPersonal', $paginatedResults);
    }




    // ===================
    //  SESSION FUNCTIONS
    // ===================

    public function sesionDatosExpediente(Request $request)
    {
        $idExpediente = $request->input('idExpediente');
        $numeroExpediente = $request->input('numeroExpediente');

        $objIncidente = session('objIncidente');

        $subArray = array();
        $subArray['idExpediente']=$idExpediente;
        $subArray['numero']=$numeroExpediente;

        $objIncidente['expediente'] = array();
        array_push($objIncidente['expediente'],$subArray);

        session(['objIncidente' => $objIncidente]);

        return "true";
    }

    public function sesionDatosPersonal(Request $request)
    {
        $idPersonal = $request->input('idPersonal');
        $nombrePersonal = $request->input('nombrePersonal');
        $tipoPersonal = $request->input('tipoPersonal');

        $objIncidente = session('objIncidente');

        if($tipoPersonal=="SCR"){
            $subArray = array();
            $subArray['idSecretario']=$idPersonal;
            $subArray['nombre']=$nombrePersonal;

            $objIncidente['secretario'] = array();
            array_push($objIncidente['secretario'],$subArray);
        }

        if($tipoPersonal=="REC"){
            $existeRecusante = false;
            foreach($objIncidente['personal_recusante'] as $sesRecusante){
                if($sesRecusante['id']==$idPersonal){
                    $existeRecusante = true;
                }
            }

            if(!$existeRecusante){
                $subArray = array();
                $subArray['hash'] = sha1(time());
                $subArray['id'] = $idPersonal;
                $subArray['nombre']=$nombrePersonal;

                array_push($objIncidente['personal_recusante'],$subArray);

            } else {
                return "false";
            }
        }

        if($tipoPersonal=="REN"){
            $existeRenunciante = false;
            foreach($objIncidente['personal_renunciante'] as $sesRecusante){
                if($sesRecusante['id']==$idPersonal){
                    $existeRenunciante = true;
                }
            }

            if(!$existeRenunciante){
                $subArray = array();
                $subArray['hash'] = sha1(time());
                $subArray['id'] = $idPersonal;
                $subArray['nombre']=$nombrePersonal;

                array_push($objIncidente['personal_renunciante'],$subArray);

            } else {
                return "false";
            }
        }

        session(['objIncidente' => $objIncidente]);

        return "true";
    }

    public function sesionBorrarRecusante($hash)
    {
        $objIncidente = session('objIncidente');

        $objIncidente['personal_recusante'] = $this->removeElementWithValue($objIncidente['personal_recusante'], 'hash', $hash);

        session(['objIncidente' => $objIncidente]);

        return "true";

    }

    public function sesionBorrarRenunciante($hash)
    {
        $objIncidente = session('objIncidente');

        $objIncidente['personal_renunciante'] = $this->removeElementWithValue($objIncidente['personal_renunciante'], 'hash', $hash);

        session(['objIncidente' => $objIncidente]);

        return "true";

    }


    public function sesionDatosFecha(Request $request)
    {
        $idIncidenteFecha = $request->input('idIncidenteFecha');
        $fecha = $request->input('fecha');
        $existeFecha = false;

        $objIncidente = session('objIncidente');

        foreach($objIncidente['fechas'] as $sesFecha){
            if($sesFecha['fecha_id']==$idIncidenteFecha){
                $existeFecha = true;
            }
        }

        if(!$existeFecha){
            $objIncidenteFecha = IncidenteFecha::where('idIncidenteFecha','=',$idIncidenteFecha)->first();

            $subArray = array();
            $subArray['hash'] = sha1(time());
            $subArray['id'] = '-';
            $subArray['fecha_id'] = $objIncidenteFecha->idIncidenteFecha;
            $subArray['fecha_orden'] = $objIncidenteFecha->orden;
            $subArray['fecha_nombre'] = $objIncidenteFecha->nombre;
            $subArray['fecha'] = $fecha;

            array_push($objIncidente['fechas'],$subArray);

            // ORDENAMOS EL ARRAY POR "ORDEN" ALFABETICAMENTE
            $objIncidente['fechas'] = collect($objIncidente['fechas'])->sortBy('fecha_orden')->toArray();

            session(['objIncidente' => $objIncidente]);

            return "true";
        }

        return "false";

    }

    public function sesionBorrarFecha($hash)
    {
        $objIncidente = session('objIncidente');

        $objIncidente['fechas'] = $this->removeElementWithValue($objIncidente['fechas'], 'hash', $hash);

        session(['objIncidente' => $objIncidente]);

        return "true";

    }


    public function sesionDatosObservacion(Request $request)
    {
        $observacion = $request->input('observacion');

        $objIncidente = session('objIncidente');

        $subArray = array();
        $subArray['hash'] = sha1(time());
        $subArray['id'] = '-';
        $subArray['observacion'] = $observacion;

        array_push($objIncidente['observaciones'],$subArray);

        session(['objIncidente' => $objIncidente]);

        return "true";
    }

    public function sesionBorrarObservacion($hash)
    {
        $objIncidente = session('objIncidente');

        $objIncidente['observaciones'] = $this->removeElementWithValue($objIncidente['observaciones'], 'hash', $hash);

        session(['objIncidente' => $objIncidente]);

        return "true";

    }


    public function sesionDatos(Request $request)
    {
        $idIncidente = $request->input('idIncidente');
        $idExpediente = $request->input('idExpediente');
        $idSecretario = $request->input('idSecretario');
        $numeroExpediente = $request->input('numeroExpediente');
        $tipo = $request->input('tipo');
        $nombreSecretario = $request->input('nombreSecretario');
        $fechaIncidente = $request->input('fechaIncidente');
        $estado = $request->input('estado');

        if($idExpediente==null){
            $idExpediente=0;
        }
        if($idSecretario==null){
            $idSecretario=0;
        }
        if($tipo==null){
            $tipo=0;
        }
        if($numeroExpediente==null){
            $numeroExpediente='';
        }
        if($nombreSecretario==null){
            $nombreSecretario='';
        }
        if($fechaIncidente==null){
            $fechaIncidente='';
        }
        if($estado==null){
            $estado='P';
        }

        $objIncidente = session('objIncidente');

        if($objIncidente==null){

            $arrIncidente = array();
            $arrIncidente['idIncidente'] = $idIncidente;
            $arrIncidente['fecha_incidente'] = $fechaIncidente;

            if($tipo==0){
                $arrIncidente['tipo'] = $tipo;
                $arrIncidente['tipo_nombre'] = "";

            } else {
                $objIncidenteTipo = IncidenteTipo::where('idIncidenteTipo','=',$tipo)->first();
                $arrIncidente['tipo'] = $tipo;
                $arrIncidente['tipo_nombre'] = $objIncidenteTipo->nombre;
            }

            $arrIncidente['estado'] = $estado;

            $arrIncidente['expediente'] = array();
            $arrIncidente['secretario'] = array();

            $arrIncidente['personal_recusante'] = array();
            $arrIncidente['personal_renunciante'] = array();
            $arrIncidente['observaciones'] = array();
            $arrIncidente['fechas'] = array();

            $subArray = array();
            $subArray['idExpediente']=$idExpediente;
            $subArray['numero']=$numeroExpediente;
            array_push($arrIncidente['expediente'],$subArray);

            $subArray = array();
            $subArray['idSecretario']=$idSecretario;
            $subArray['nombre']=$nombreSecretario;
            array_push($arrIncidente['secretario'],$subArray);

            // Actualizamos los contenidos de la variable SESSION
            session(['objIncidente' => $arrIncidente]);

        }else{
            // 0. Actualizamos los valores del objeto session con los de REQUEST
            $objIncidente['idIncidente'] = $idIncidente;
            $objIncidente['fecha_incidente'] = $fechaIncidente;

            if($tipo==0){
                $objIncidente['tipo'] = $tipo;
                $objIncidente['tipo_nombre'] = "";

            } else {
                $objIncidenteTipo = IncidenteTipo::where('idIncidenteTipo','=',$tipo)->first();
                $objIncidente['tipo'] = $tipo;
                $objIncidente['tipo_nombre'] = $objIncidenteTipo->nombre;
            }

            $objIncidente['estado'] = $estado;

            // 1. Limpiamos los valores de ARRAY del objeto SESSION
            $objIncidente['expediente'] = array();
            $objIncidente['secretario'] = array();

            // 2. Actualizamos los valores de ARRAY del objeto session con los de REQUEST
            $subArray = array();
            if($idExpediente=="0"){
                $subArray['idExpediente']='0';
                $subArray['numero']='';
            } else {
                $objExpediente = Expediente::where('idExpediente','=',$idExpediente)->first();
                $subArray['idExpediente']=$objExpediente->idExpediente;
                $subArray['numero']=$objExpediente->numero;
            }
            array_push($objIncidente['expediente'],$subArray);

            $subArray = array();
            if($idSecretario=="0"){
                $subArray['idSecretario']='0';
                $subArray['nombre']='';
            } else {
                $objSecretario = UsuarioLegal::where('idUsuarioLegal','=',$idSecretario)->first();
                $subArray['idSecretario']=$objSecretario->idUsuarioLegal;
                $subArray['nombre']=$objSecretario->nombre." ".$objSecretario->apellidoPaterno." ".$objSecretario->apellidoMaterno;
            }
            array_push($objIncidente['secretario'],$subArray);

            // 3. Actualizamos los contenidos de la variable SESSION
            session(['objIncidente' => $objIncidente]);
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
