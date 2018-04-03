<?php

namespace App\Http\Controllers;

use App\Http\Models\ConsorcioPersonaDetalle;
use App\Http\Models\Expediente;
use App\Http\Models\ExpedienteClienteLegal;
use App\Http\Models\ExpedienteDesignacion;
use App\Http\Models\ExpedienteDesignacionPropuesta;
use App\Http\Models\ExpedienteDesignacionTipo;
use App\Http\Models\LegalEspecialidad;
use App\Http\Models\PersonaJuridica;
use App\Http\Models\PersonaNatural;
use App\Http\Models\StoreProcedure\DesignacionSP;
use App\Http\Models\UsuarioLegal;
use App\Http\Models\UsuarioLegalEspecialidad;
use App\Http\Models\UsuarioLegalProfesion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;

class DesignacionController extends Controller
{
    public function lista()
    {
        $numeroExpediente = Input::get('numeroExpediente');
        $fechaInicio = Input::get('fechaInicio');
        $fechaFin = Input::get('fechaFin');
        $tipoDesignacion = Input::get('tipoDesignacion');

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

        if($tipoDesignacion==null){
            $tipoDesignacion = "";
        }

        $qryDesignacion = DesignacionSP::designacionBuscarDesignaciones($numeroExpediente,$tipoDesignacion,$fechaInicio,$fechaFin);

        $lstDesignaciones = array();

        foreach($qryDesignacion as $designacion){
            $subArray = array();
            $subArray['id'] = $designacion->idExpedienteDesignacion;
            $subArray['tipoDesignacion'] =$designacion->tipoDesignacion;
            $subArray['expediente_numero'] = $designacion->numeroExpediente;
            $subArray['fecha_designacion'] = $designacion->fecha;

            $objExpediente = Expediente::where('idExpediente','=',$designacion->idExpediente)->first();
            $objDemandante = $objExpediente->expedienteDemandante;

            if($objDemandante->flgTipoPersona=="J"){
                $subArray["demandante"] = $objDemandante->personaJuridica->razonSocial;
            } else {
                $subArray["demandante"] = $objDemandante->personaNatural->nombre." ".$objDemandante->personaNatural->apellidoPaterno." ".$objDemandante->personaNatural->apellidoMaterno;
            }

            $objDemandado = $objExpediente->expedienteDemandado;

            if($objDemandado->flgTipoPersona=="J"){
                $subArray["demandado"] = $objDemandado->personaJuridica->razonSocial;
            } else {
                $subArray["demandado"] = $objDemandado->personaNatural->nombre." ".$objDemandado->personaNatural->apellidoPaterno." ".$objDemandado->personaNatural->apellidoMaterno;
            }

            array_push($lstDesignaciones,$subArray);
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage()-1;
        $collection = new Collection($lstDesignaciones);
        $perPage = 5;
        $currentResults = $collection->slice($currentPage * $perPage, $perPage)->all();
        $paginatedResults= new LengthAwarePaginator($currentResults, count($collection), $perPage,($currentPage+1),[
            'path'  => request()->url(),
            'query' => request()->query(),
        ]);


        // INCIDENTE TIPO
        $qryDesignacionTipo = ExpedienteDesignacionTipo::orderBy('nombre','ASC')->get();
        $arrDesignacionTipo = array();

        foreach($qryDesignacionTipo as $designacionTipo){
            $subArray = array();
            $subArray['id']=$designacionTipo->idExpedienteDesignacionTipo;
            $subArray['nombre']=$designacionTipo->nombre;
            array_push($arrDesignacionTipo,$subArray);
        }

        return view('designacion.lista')
            ->with('numeroExpediente',$numeroExpediente)
            ->with('fechaInicio',$fechaInicio)
            ->with('fechaFin',$fechaFin)
            ->with('tipo',$tipoDesignacion)
            ->with('lstDesignaciones',$paginatedResults)
            ->with('lstTipoDesignacion',$arrDesignacionTipo);

    }

    public function nuevo($idDesignacion)
    {
        if($idDesignacion=="-"){
            session(['objDesignacion' => null]);
        }

        $objDesignacion = session('objDesignacion');

        if($objDesignacion==null){
            $arrDesignacion = array();
            $arrDesignacion['idDesignacion'] = 0;
            $arrDesignacion['tipoDesignacion']=array();
            $arrDesignacion['expediente']=array();
            $arrDesignacion['propuestas']=array();

            $subArray = array();
            $subArray['id'] = 0;
            $subArray['nombre'] = "";
            array_push($arrDesignacion['tipoDesignacion'],$subArray);

            $subArray = array();
            $subArray['id'] = 0;
            $subArray['numero'] = "";
            array_push($arrDesignacion['expediente'],$subArray);

        }
        else{
            $arrDesignacion = $objDesignacion;
        }

        // INCIDENTE TIPO
        $qryDesignacionTipo = ExpedienteDesignacionTipo::orderBy('nombre','ASC')->get();
        $arrDesignacionTipo = array();

        foreach($qryDesignacionTipo as $designacionTipo){
            $subArray = array();
            $subArray['id']=$designacionTipo->idExpedienteDesignacionTipo;
            $subArray['nombre']=$designacionTipo->nombre;
            array_push($arrDesignacionTipo,$subArray);
        }

        return view('designacion.nuevo')
            ->with('objDesignacion',$arrDesignacion)
            ->with('lstTipoDesignacion',$arrDesignacionTipo);

    }

    public function borrar($idDesignacion)
    {
        ExpedienteDesignacionPropuesta::where('idExpedienteDesignacion','=',$idDesignacion)->delete();
        ExpedienteDesignacion::where('idExpedienteDesignacion','=',$idDesignacion)->delete();

        return "true";
    }


    public function editar($idDesignacion,$flgInicio)
    {
        if($flgInicio=="S"){
            session(['objDesignacion' => null]);
        }

        $objDesignacion = session('objDesignacion');
        $qryDesignacion = ExpedienteDesignacion::where('idExpedienteDesignacion','=',$idDesignacion)->first();

        if($objDesignacion==null){
            $arrDesignacion = array();
            $arrDesignacion['idDesignacion'] = $idDesignacion;

            $arrDesignacion['tipoDesignacion']=array();
            $subArray = array();
            $subArray['id'] = $qryDesignacion->expedienteDesignacionTipo->idExpedienteDesignacionTipo;
            $subArray['nombre'] = $qryDesignacion->expedienteDesignacionTipo->nombre;
            array_push($arrDesignacion['tipoDesignacion'],$subArray);

            $arrDesignacion['expediente']=array();
            $subArray = array();
            $subArray['id']=$qryDesignacion->expediente->idExpediente;
            $subArray['numero']=$qryDesignacion->expediente->numero;
            array_push($arrDesignacion['expediente'],$subArray);

            $arrDesignacion['propuestas']=array();
            foreach($qryDesignacion->expedienteDesignacionPropuesta as $propuesta){
                $subArray = array();
                $subArray['hash'] = $propuesta->idUsuarioLegal;
                $subArray['fecha'] = date("d/m/Y", strtotime($propuesta->fecha));
                $subArray['idPersonal'] = $propuesta->idUsuarioLegal;
                $subArray['nombrePersonal']=$propuesta->usuarioLegal->apellidoPaterno.' '.$propuesta->usuarioLegal->apellidoMaterno.', '.$propuesta->usuarioLegal->nombre;
                $subArray['especialidades']=array();
                foreach($propuesta->usuarioLegal->usuarioLegalEspecialidads as $usuarioEspecialidad){
                    $subArrayEspecialidad = array();
                    $subArrayEspecialidad['id']=$usuarioEspecialidad->legalEspecialidad->idLegalEspecialidad;
                    $subArrayEspecialidad['nombre']=$usuarioEspecialidad->legalEspecialidad->nombre;
                    array_push($subArray['especialidades'],$subArrayEspecialidad);
                }

                $subArray['observacion'] = $propuesta->observacion;
                $subArray['flgTipoDesignacion'] = $propuesta->flgTipoDesignacion;

                $subArray['estado'] = array();

                $subArrayEstado['id'] = $propuesta->estado;

                switch ($propuesta->estado) {
                    case 'DES':
                        $subArrayEstado['nombre'] = 'Designado';
                        break;
                    case 'PRP':
                        $subArrayEstado['nombre'] = 'Propuesto';
                        break;
                    case 'RCH':
                        $subArrayEstado['nombre'] = 'Rechazado';
                        break;
                    case 'REN':
                        $subArrayEstado['nombre'] = 'Renunciado';
                        break;
                    case 'REC':
                        $subArrayEstado['nombre'] = 'Recusado';
                        break;
                }
                array_push($subArray['estado'],$subArrayEstado);

                array_push($arrDesignacion['propuestas'],$subArray);

            }

            $objDesignacion = $arrDesignacion;

            // Actualizamos los contenidos de la variable SESSION
            session(['objDesignacion' => $objDesignacion]);

        }
        else{
            $arrDesignacion = $objDesignacion;
        }

        // DETALLE EXPEDIENTE
        $idExpediente = $qryDesignacion->expediente->idExpediente;
        $objExpediente = Expediente::where('idExpediente','=',$idExpediente)->first();
        $arrExpediente = array();
        $arrExpediente['numeroExpediente'] = $objExpediente->numero;
        $arrExpediente['cuantiaControversia'] = $objExpediente->cuantiaMontoInicial;
        $arrExpediente['fechaSolicitud'] = date("Y-m-d", strtotime($objExpediente->fechaSolicitud));
        $arrExpediente['demandante'] = $objExpediente->expedienteDemandante->nombre;
        $arrExpediente['demandado'] = $objExpediente->expedienteDemandado->nombre;

        // DEMANDANTE
        // 1. Obtenemos el id al cual pertence el Demandante
        $idDemandante = $objExpediente->idDemandante;
        $objExpedienteClienteLegal = ExpedienteClienteLegal::where('idExpedienteClienteLegal','=',$idDemandante)->first();
        $idConsorcioDemandante = $objExpedienteClienteLegal->idConsorcioPersona;

        // 2. Obtenemos el tipo de persona (natural,juridica) y el Id (natural,juridica) del demandadnte
        $flgTipoPersona = $objExpediente->expedienteDemandante->flgTipoPersona;
        $idPersonaDemandante = "";
        if($objExpediente->expedienteDemandante->flgTipoPersona=="J"){
            $idPersonaDemandante = $objExpediente->expedienteDemandante->idPersonaJuridica;
        } else {
            $idPersonaDemandante = $objExpediente->expedienteDemandante->idPersonaNatural;
        }

        // 3. Obtenemos la lista de personas que forman parte del consorcio del Demandante
        //    (de la lista excluimos al demandante utilizando los datos del punto 2)
        $arrMiembrosDemandante = array();
        $qryMiembrosDemandante = ConsorcioPersonaDetalle::where('idConsorcioPersona','=',$idConsorcioDemandante)->get();

        foreach($qryMiembrosDemandante as $miembroDemandante){
            if($miembroDemandante->flgTipoPersona=="J"){
                $objPersonaJuridica = PersonaJuridica::where('idPersonaJuridica','=',$miembroDemandante->idPersonaJuridica)->first();

                if($flgTipoPersona=="J"){
                    if($objPersonaJuridica->idPersonaJuridica!=$idPersonaDemandante){
                        $subArray = array();
                        $subArray['nombre'] = $objPersonaJuridica->razonSocial;
                        array_push($arrMiembrosDemandante,$subArray);
                    }
                }
            } else {
                $objPersonaNatural = PersonaNatural::where('idPersonaNatural','=',$miembroDemandante->idPersonaNatural)->first();

                if($flgTipoPersona=="N"){
                    if($objPersonaNatural->idPersonaNatural!=$idPersonaDemandante){
                        $subArray = array();
                        $subArray['nombre'] = $objPersonaNatural->apellidoPaterno.", ".$objPersonaNatural->apellidoMaterno." ".$objPersonaNatural->nombre;
                        array_push($arrMiembrosDemandante,$subArray);
                    }
                }
            }
        }


        // DEMANDADO
        // 1. Obtenemos el id al cual pertence el Demandado
        $idDemandado = $objExpediente->idDemandado;
        $objExpedienteClienteLegal = ExpedienteClienteLegal::where('idExpedienteClienteLegal','=',$idDemandado)->first();
        $idConsorcioDemandado = $objExpedienteClienteLegal->idConsorcioPersona;

        // 2. Obtenemos el tipo de persona (natural,juridica) y el Id (natural,juridica) del Demandado
        $flgTipoPersona = $objExpediente->expedienteDemandado->flgTipoPersona;
        $idPersonaDemandado = "";
        if($objExpediente->expedienteDemandado->flgTipoPersona=="J"){
            $idPersonaDemandado = $objExpediente->expedienteDemandado->idPersonaJuridica;
        } else {
            $idPersonaDemandado = $objExpediente->expedienteDemandado->idPersonaNatural;
        }

        // 3. Obtenemos la lista de personas que forman parte del consorcio del Demandado
        //    (de la lista excluimos al demandante utilizando los datos del punto 2)
        $arrMiembrosDemandado = array();
        $qryMiembrosDemandado = ConsorcioPersonaDetalle::where('idConsorcioPersona','=',$idConsorcioDemandado)->get();

        foreach($qryMiembrosDemandado as $miembroDemandado){
            if($miembroDemandado->flgTipoPersona=="J"){
                $objPersonaJuridica = PersonaJuridica::where('idPersonaJuridica','=',$miembroDemandado->idPersonaJuridica)->first();

                if($flgTipoPersona=="J"){
                    if($objPersonaJuridica->idPersonaJuridica!=$idPersonaDemandado){
                        $subArray = array();
                        $subArray['nombre'] = $objPersonaJuridica->razonSocial;
                        array_push($arrMiembrosDemandado,$subArray);
                    }
                }
            } else {
                $objPersonaNatural = PersonaNatural::where('idPersonaNatural','=',$miembroDemandado->idPersonaNatural)->first();

                if($flgTipoPersona=="N"){
                    if($objPersonaNatural->idPersonaNatural!=$idPersonaDemandado){
                        $subArray = array();
                        $subArray['nombre'] = $objPersonaNatural->apellidoPaterno.", ".$objPersonaNatural->apellidoMaterno." ".$objPersonaNatural->nombre;
                        array_push($arrMiembrosDemandado,$subArray);
                    }
                }
            }
        }

        if(count($objExpediente->expedienteEquipoLegals)>0) {
            $arrExpediente['arbitroDemandante'] = $objExpediente->expedienteEquipoLegals[0]->arbitroDemandante->apellidoPaterno.' '.$objExpediente->expedienteEquipoLegals[0]->arbitroDemandante->apellidoMaterno.', '.$objExpediente->expedienteEquipoLegals[0]->arbitroDemandante->nombre;
        } else {
            $arrExpediente['arbitroDemandante'] = "";
        }

        if(count($objExpediente->expedienteEquipoLegals)>0) {
            $arrExpediente['arbitroDemandado'] = $objExpediente->expedienteEquipoLegals[0]->arbitroDemandado->apellidoPaterno.' '.$objExpediente->expedienteEquipoLegals[0]->arbitroDemandado->apellidoMaterno.', '.$objExpediente->expedienteEquipoLegals[0]->arbitroDemandado->nombre;
        } else {
            $arrExpediente['arbitroDemandado'] = "";
        }

        return view('designacion.propuestaEditar')
            ->with('objDesignacion',$objDesignacion)
            ->with('consorcioDemandante',$arrMiembrosDemandante)
            ->with('consorcioDemandado',$arrMiembrosDemandado)
            ->with('objExpediente',$arrExpediente);
    }




    public function validarExpedientePropuesta(Request $request)
    {
        $idExpediente = $request->input('idExpediente');
        $tipo = $request->input('tipo');

        $objExpedienteDesignacion = ExpedienteDesignacion::where('idExpediente','=',$idExpediente)
                                                         ->where('idExpedienteDesignacionTipo','=',$tipo);

        if($objExpedienteDesignacion->exists()){
            return "false";
        }

        return "true";

    }




    public function propuesta()
    {
        $objDesignacion = session('objDesignacion');

        // DETALLE EXPEDIENTE
        $idExpediente = $objDesignacion['expediente'][0]['id'];
        $objExpediente = Expediente::where('idExpediente','=',$idExpediente)->first();
        $arrExpediente = array();
        $arrExpediente['numeroExpediente'] = $objExpediente->numero;
        $arrExpediente['cuantiaControversia'] = $objExpediente->cuantiaMontoInicial;
        $arrExpediente['fechaSolicitud'] = date("Y-m-d", strtotime($objExpediente->fechaSolicitud));
        $arrExpediente['demandante'] = $objExpediente->expedienteDemandante->nombre;
        $arrExpediente['demandado'] = $objExpediente->expedienteDemandado->nombre;

        // DEMANDANTE
        // 1. Obtenemos el id al cual pertence el Demandante
        $idDemandante = $objExpediente->idDemandante;
        $objExpedienteClienteLegal = ExpedienteClienteLegal::where('idExpedienteClienteLegal','=',$idDemandante)->first();
        $idConsorcioDemandante = $objExpedienteClienteLegal->idConsorcioPersona;

        // 2. Obtenemos el tipo de persona (natural,juridica) y el Id (natural,juridica) del demandadnte
        $flgTipoPersona = $objExpediente->expedienteDemandante->flgTipoPersona;
        $idPersonaDemandante = "";
        if($objExpediente->expedienteDemandante->flgTipoPersona=="J"){
            $idPersonaDemandante = $objExpediente->expedienteDemandante->idPersonaJuridica;
        } else {
            $idPersonaDemandante = $objExpediente->expedienteDemandante->idPersonaNatural;
        }

        // 3. Obtenemos la lista de personas que forman parte del consorcio del Demandante
        //    (de la lista excluimos al demandante utilizando los datos del punto 2)
        $arrMiembrosDemandante = array();
        $qryMiembrosDemandante = ConsorcioPersonaDetalle::where('idConsorcioPersona','=',$idConsorcioDemandante)->get();

        foreach($qryMiembrosDemandante as $miembroDemandante){
            if($miembroDemandante->flgTipoPersona=="J"){
                $objPersonaJuridica = PersonaJuridica::where('idPersonaJuridica','=',$miembroDemandante->idPersonaJuridica)->first();

                if($flgTipoPersona=="J"){
                    if($objPersonaJuridica->idPersonaJuridica!=$idPersonaDemandante){
                        $subArray = array();
                        $subArray['nombre'] = $objPersonaJuridica->razonSocial;
                        array_push($arrMiembrosDemandante,$subArray);
                    }
                }
            } else {
                $objPersonaNatural = PersonaNatural::where('idPersonaNatural','=',$miembroDemandante->idPersonaNatural)->first();

                if($flgTipoPersona=="N"){
                    if($objPersonaNatural->idPersonaNatural!=$idPersonaDemandante){
                        $subArray = array();
                        $subArray['nombre'] = $objPersonaNatural->apellidoPaterno.", ".$objPersonaNatural->apellidoMaterno." ".$objPersonaNatural->nombre;
                        array_push($arrMiembrosDemandante,$subArray);
                    }
                }
            }
        }


        // DEMANDADO
        // 1. Obtenemos el id al cual pertence el Demandado
        $idDemandado = $objExpediente->idDemandado;
        $objExpedienteClienteLegal = ExpedienteClienteLegal::where('idExpedienteClienteLegal','=',$idDemandado)->first();
        $idConsorcioDemandado = $objExpedienteClienteLegal->idConsorcioPersona;

        // 2. Obtenemos el tipo de persona (natural,juridica) y el Id (natural,juridica) del Demandado
        $flgTipoPersona = $objExpediente->expedienteDemandado->flgTipoPersona;
        $idPersonaDemandado = "";
        if($objExpediente->expedienteDemandado->flgTipoPersona=="J"){
            $idPersonaDemandado = $objExpediente->expedienteDemandado->idPersonaJuridica;
        } else {
            $idPersonaDemandado = $objExpediente->expedienteDemandado->idPersonaNatural;
        }

        // 3. Obtenemos la lista de personas que forman parte del consorcio del Demandado
        //    (de la lista excluimos al demandante utilizando los datos del punto 2)
        $arrMiembrosDemandado = array();
        $qryMiembrosDemandado = ConsorcioPersonaDetalle::where('idConsorcioPersona','=',$idConsorcioDemandado)->get();

        foreach($qryMiembrosDemandado as $miembroDemandado){
            if($miembroDemandado->flgTipoPersona=="J"){
                $objPersonaJuridica = PersonaJuridica::where('idPersonaJuridica','=',$miembroDemandado->idPersonaJuridica)->first();

                if($flgTipoPersona=="J"){
                    if($objPersonaJuridica->idPersonaJuridica!=$idPersonaDemandado){
                        $subArray = array();
                        $subArray['nombre'] = $objPersonaJuridica->razonSocial;
                        array_push($arrMiembrosDemandado,$subArray);
                    }
                }
            } else {
                $objPersonaNatural = PersonaNatural::where('idPersonaNatural','=',$miembroDemandado->idPersonaNatural)->first();

                if($flgTipoPersona=="N"){
                    if($objPersonaNatural->idPersonaNatural!=$idPersonaDemandado){
                        $subArray = array();
                        $subArray['nombre'] = $objPersonaNatural->apellidoPaterno.", ".$objPersonaNatural->apellidoMaterno." ".$objPersonaNatural->nombre;
                        array_push($arrMiembrosDemandado,$subArray);
                    }
                }
            }
        }

        if(count($objExpediente->expedienteEquipoLegals)>0) {
            $arrExpediente['arbitroDemandante'] = $objExpediente->expedienteEquipoLegals[0]->arbitroDemandante->apellidoPaterno.' '.$objExpediente->expedienteEquipoLegals[0]->arbitroDemandante->apellidoMaterno.', '.$objExpediente->expedienteEquipoLegals[0]->arbitroDemandante->nombre;
        } else {
            $arrExpediente['arbitroDemandante'] = "";
        }

        if(count($objExpediente->expedienteEquipoLegals)>0) {
            $arrExpediente['arbitroDemandado'] = $objExpediente->expedienteEquipoLegals[0]->arbitroDemandado->apellidoPaterno.' '.$objExpediente->expedienteEquipoLegals[0]->arbitroDemandado->apellidoMaterno.', '.$objExpediente->expedienteEquipoLegals[0]->arbitroDemandado->nombre;
        } else {
            $arrExpediente['arbitroDemandado'] = "";
        }

        return view('designacion.propuesta')
            ->with('objDesignacion',$objDesignacion)
            ->with('consorcioDemandante',$arrMiembrosDemandante)
            ->with('consorcioDemandado',$arrMiembrosDemandado)
            ->with('objExpediente',$arrExpediente);

    }

    public function propuestaDetalle($hash)
    {
        $objDesignacion = session('objDesignacion');

        $propuestaDetalle = array();

        foreach($objDesignacion['propuestas'] as $sesPropuesta){
            if($sesPropuesta['hash']==$hash){
                $propuestaDetalle=$sesPropuesta;
            }
        }

        return view('designacion.propuestaDetalle')
            ->with('objDesignacion',$objDesignacion)
            ->with('hash',$hash)
            ->with('nombreCompleto',$propuestaDetalle['nombrePersonal'])
            ->with('estado',$propuestaDetalle['estado'][0]['id'])
            ->with('flgTipoDesignacion',$propuestaDetalle['flgTipoDesignacion'])
            ->with('observacion',$propuestaDetalle['observacion']);

    }

    public function registrar(Request $request)
    {
        $idDesignacion = $request->input('idDesignacion');
        $idExpediente = $request->input('idExpediente');
        $numeroExpediente = $request->input('numeroExpediente');
        $tipo = $request->input('tipo');

        $sesionDesignacion = session('objDesignacion');

        $objExpedienteDesignacion = new ExpedienteDesignacion;
        $objExpedienteDesignacion->idExpediente = $idExpediente;
        $objExpedienteDesignacion->idExpedienteDesignacionTipo = $tipo;
        //$objExpedienteDesignacion->fecha = Carbon::now('America/Lima')->format('Y-m-d H:i:s');

        $fecha = str_replace('/', '-', $sesionDesignacion['fecha']);
        $parseFechaInicio = date("Y-m-d", strtotime($fecha));
        $carbonFecha = Carbon::parse($parseFechaInicio);
        $objExpedienteDesignacion->fecha = $carbonFecha;

        $objExpedienteDesignacion->save();

        // INICIO REGISTRO DATOS COMPLEMENTARIOS
        $idExpedienteDesignacion = $objExpedienteDesignacion->id;

        if(count($sesionDesignacion['propuestas'])>0){
            foreach($sesionDesignacion['propuestas'] as $propuesta){
                $objExpedienteDesignacionPropuesta = new ExpedienteDesignacionPropuesta;
                $objExpedienteDesignacionPropuesta->idExpedienteDesignacion = $idExpedienteDesignacion;
                $objExpedienteDesignacionPropuesta->idUsuarioLegal = $propuesta['idPersonal'];
                //$objExpedienteDesignacionPropuesta->fecha = Carbon::now('America/Lima')->format('Y-m-d H:i:s');

                $fecha = str_replace('/', '-', $propuesta['fecha']);
                $parseFechaInicio = date("Y-m-d", strtotime($fecha));
                $carbonFecha = Carbon::parse($parseFechaInicio);
                $objExpedienteDesignacionPropuesta->fecha = $carbonFecha;

                $objExpedienteDesignacionPropuesta->observacion = $propuesta['observacion'];
                $objExpedienteDesignacionPropuesta->flgTipoDesignacion = $propuesta['flgTipoDesignacion'];
                $objExpedienteDesignacionPropuesta->estado = $propuesta['estado'][0]['id'];
                $objExpedienteDesignacionPropuesta->save();
            }
        }

        return "true";
    }


    public function registrarEditar(Request $request)
    {
        $idDesignacion = $request->input('idDesignacion');

        // INICIO ACTUALIZACION DATOS COMPLEMENTARIOS
        $sesionDesignacion = session('objDesignacion');

        // ============
        //  PROPUESTAS
        // ============

        // 0. Creamos dos nuevos arrays: uno con los Ids registrados actualmente, y otro con los Ids de la sesion
        $arrIdPropuestaActuales = array();
        $qryExpedienteDesignacionPropuesta = ExpedienteDesignacionPropuesta::where('idExpedienteDesignacion','=',$idDesignacion)->get();
        foreach($qryExpedienteDesignacionPropuesta as $expedienteDesignacionPropuesta){
            array_push($arrIdPropuestaActuales,$expedienteDesignacionPropuesta->idUsuarioLegal);
        }

        $arrIdPropuestaSesion = array();
        foreach($sesionDesignacion['propuestas'] as $sesionPropuesta){
            array_push($arrIdPropuestaSesion,$sesionPropuesta['idPersonal']);
        }

        // 1. Obtenemos el array() con los Ids que se van a borrar, pues han sido eliminados en la actualizacion
        $arrPropuestaBorrar = array();
        foreach($arrIdPropuestaActuales as $idPropuesta){
            if (!in_array($idPropuesta, $arrIdPropuestaSesion)) {
                array_push($arrPropuestaBorrar,$idPropuesta);
            }
        }

        // 2. Borramos los Ids que esten dentro del arreglo de borrado
        foreach($arrPropuestaBorrar as $idPropuestaBorrar){
            ExpedienteDesignacionPropuesta::where('idUsuarioLegal','=',$idPropuestaBorrar)->delete();
        }

        // 3. Iniciamos el registro de los Ids
        foreach($sesionDesignacion['propuestas'] as $sesionPropuesta){

            $objExpedienteDesignacionPropuesta = ExpedienteDesignacionPropuesta::where('idUsuarioLegal','=',$sesionPropuesta['idPersonal']);

            if(!$objExpedienteDesignacionPropuesta->exists()){
                $objExpedienteDesignacionPropuesta = new ExpedienteDesignacionPropuesta;
                $objExpedienteDesignacionPropuesta->idExpedienteDesignacion = $idDesignacion;
                $objExpedienteDesignacionPropuesta->idUsuarioLegal = $sesionPropuesta['idPersonal'];

                $fecha = str_replace('/', '-', $sesionPropuesta['fecha']);
                $parseFechaInicio = date("Y-m-d", strtotime($fecha));
                $carbonFecha = Carbon::parse($parseFechaInicio);
                $objExpedienteDesignacionPropuesta->fecha = $carbonFecha;

                $objExpedienteDesignacionPropuesta->observacion = $sesionPropuesta['observacion'];
                $objExpedienteDesignacionPropuesta->flgTipoDesignacion = $sesionPropuesta['flgTipoDesignacion'];
                $objExpedienteDesignacionPropuesta->estado = $sesionPropuesta['estado'][0]['id'];
                $objExpedienteDesignacionPropuesta->save();
            }
        }

        return "true";
    }


    // ============================================================

    public function buscarExpediente()
    {
        $objDesignacion = session('objDesignacion');

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

        return view('designacion.buscarExpediente')
            ->with('objDesignacion',$objDesignacion)
            ->with('numeroExpediente',$numeroExpediente)
            ->with('lstExpedientes', $paginatedResults);

    }



    public function buscarPersonal()
    {
        $objDesignacion = session('objDesignacion');

        $nombre = Input::get('nombre');
        $apellidoPaterno = Input::get('apellidoPaterno');
        $apellidoMaterno = Input::get('apellidoMaterno');
        $profesion = Input::get('profesion');
        $especialidad = Input::get('especialidad');

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

        if($especialidad==null){
            $especialidad = "";
        }

        // 1. QUERY: colocamos la busqueda por LIKE
        $qryPersonal = UsuarioLegal::where('apellidoPaterno', 'LIKE', '%'.$apellidoPaterno.'%')
                                    ->where('apellidoMaterno', 'LIKE', '%'.$apellidoMaterno.'%')
                                    ->where('nombre', 'LIKE', '%'.$nombre.'%')
                                    ->whereIn('idUsuarioLegalTipo', array(1, 2));

        // 2. QUERY: Condicionamos la busqueda por parametros WHERE opcionales
        if($profesion!=""){
            $qryPersonal->where('idUsuarioLegalProfesion','=',$profesion);
        }

        // 3. QUERY: Ejecutamos la busqueda que sera usada en el FOREACH
        $qryPersonal = $qryPersonal->get();

        $lstPersonal = array();

        foreach ($qryPersonal as $personal) {
            $subArray = array();
            $subArray['id'] = $personal->idUsuarioLegal;
            $subArray['nombre'] = $personal->apellidoPaterno." ".$personal->apellidoMaterno.", ".$personal->nombre;
            $subArray['profesion'] = $personal->UsuarioLegalProfesion->nombre;
            $subArray['porLaCorte'] = ExpedienteDesignacionPropuesta::where('idUsuarioLegal','=',$personal->idUsuarioLegal)->where('flgTipoDesignacion','=','COR')->count();
            $subArray['porLaParte'] = ExpedienteDesignacionPropuesta::where('idUsuarioLegal','=',$personal->idUsuarioLegal)->where('flgTipoDesignacion','=','PAR')->count();
            $subArray['especialidades'] = array();

            $objUsuarioLegalEspecialidad = UsuarioLegalEspecialidad::where('idUsuarioLegal','=',$personal->idUsuarioLegal);

            if($especialidad!=""){
                if($objUsuarioLegalEspecialidad->where('idLegalEspecialidad','=',$especialidad)->exists()){
                    foreach($objUsuarioLegalEspecialidad->get() as $usuarioLegalEspecialidad){
                        $subArrayEspecialidad = array();
                        $subArrayEspecialidad['id']=$usuarioLegalEspecialidad->legalEspecialidad->idLegalEspecialidad;
                        $subArrayEspecialidad['nombre']=$usuarioLegalEspecialidad->legalEspecialidad->nombre;
                        array_push($subArray['especialidades'],$subArrayEspecialidad);
                    }
                    array_push($lstPersonal,$subArray);
                }
            } else {
                foreach ($objUsuarioLegalEspecialidad->get() as $usuarioLegalEspecialidad) {
                    $subArrayEspecialidad = array();
                    $subArrayEspecialidad['id'] = $usuarioLegalEspecialidad->legalEspecialidad->idLegalEspecialidad;
                    $subArrayEspecialidad['nombre'] = $usuarioLegalEspecialidad->legalEspecialidad->nombre;
                    array_push($subArray['especialidades'], $subArrayEspecialidad);
                }
                array_push($lstPersonal, $subArray);
            }
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage()-1;
        $collection = new Collection($lstPersonal);
        $perPage = 5;
        $currentResults = $collection->slice($currentPage * $perPage, $perPage)->all();
        $paginatedResults= new LengthAwarePaginator($currentResults, count($collection), $perPage,($currentPage+1),[
            'path'  => request()->url(),
            'query' => request()->query(),
        ]);

        $qryEspecialidad = LegalEspecialidad::all();
        $lstEspecialidad = array();

        foreach ($qryEspecialidad as $usuarioEspecialidad) {
            $subArray = array();
            $subArray['id'] = $usuarioEspecialidad->idLegalEspecialidad;
            $subArray['nombre'] = $usuarioEspecialidad->nombre;
            array_push($lstEspecialidad,$subArray);
        }

        $qryProfesion = UsuarioLegalProfesion::all();
        $lstProfesion = array();

        foreach ($qryProfesion as $usuarioProfesion) {
            $subArray = array();
            $subArray['id'] = $usuarioProfesion->idUsuarioLegalProfesion;
            $subArray['nombre'] = $usuarioProfesion->nombre;
            array_push($lstProfesion,$subArray);
        }

        return view('designacion.buscarPersonal')
            ->with('objDesignacion',$objDesignacion)
            ->with('nombre',$nombre)
            ->with('apellidoPaterno',$apellidoPaterno)
            ->with('apellidoMaterno',$apellidoMaterno)
            ->with('profesion',$profesion)
            ->with('especialidad',$especialidad)
            ->with('lstEspecialidad',$lstEspecialidad)
            ->with('lstProfesion',$lstProfesion)
            ->with('lstPersonal', $paginatedResults);
    }


    public function buscarPersonalHistorico($idPersonal)
    {
        $objDesignacion = session('objDesignacion');

        $objUsuarioLegal = UsuarioLegal::where('idUsuarioLegal','=',$idPersonal)->first();

        /*
        DES - Designado
        PRP - Propuesto
        RCH - Rechazado
        REN - Renunciado
        REC - Recusado
        */

        $objPersonal = array();
        $objPersonal['id'] = $idPersonal;
        $objPersonal['nombre'] = $objUsuarioLegal->nombre;
        $objPersonal['apellidoPaterno'] = $objUsuarioLegal->apellidoPaterno;
        $objPersonal['apellidoMaterno'] = $objUsuarioLegal->apellidoMaterno;
        $objPersonal['designaciones_total'] = ExpedienteDesignacionPropuesta::where('idUsuarioLegal','=',$idPersonal)->count();
        $objPersonal['designaciones_corte'] = ExpedienteDesignacionPropuesta::where('idUsuarioLegal','=',$idPersonal)->where('flgTipoDesignacion','=','C')->count();
        $objPersonal['designaciones_parte'] = ExpedienteDesignacionPropuesta::where('idUsuarioLegal','=',$idPersonal)->where('flgTipoDesignacion','=','P')->count();
        $objPersonal['designaciones_designado'] = ExpedienteDesignacionPropuesta::where('idUsuarioLegal','=',$idPersonal)->where('estado','=','DES')->count();
        $objPersonal['designaciones_propuestas'] = ExpedienteDesignacionPropuesta::where('idUsuarioLegal','=',$idPersonal)->where('estado','=','PRP')->count();
        $objPersonal['designaciones_rechazadas'] = ExpedienteDesignacionPropuesta::where('idUsuarioLegal','=',$idPersonal)->where('estado','=','RCH')->count();
        $objPersonal['designaciones_renunciadas'] = ExpedienteDesignacionPropuesta::where('idUsuarioLegal','=',$idPersonal)->where('estado','=','REN')->count();
        $objPersonal['designaciones_recusadas'] = ExpedienteDesignacionPropuesta::where('idUsuarioLegal','=',$idPersonal)->where('estado','=','REC')->count();
        $objPersonal['casos'] = array();

        $qryDesignacionPersonal = ExpedienteDesignacionPropuesta::where('idUsuarioLegal','=',$idPersonal)->get();

        foreach($qryDesignacionPersonal as $designacionPersonal){
            $subArrayCaso = array();

            $subArrayCaso['expediente'] = $designacionPersonal->expedienteDesignacion->expediente->numero;
            $subArrayCaso['fecha'] = date("Y-m-d", strtotime($designacionPersonal->expedienteDesignacion->fecha));

            switch ($designacionPersonal->estado) {
                case 'DES':
                    $subArrayCaso['estado'] = 'Designado';
                    break;
                case 'PRP':
                    $subArrayCaso['estado'] = 'Propuesto';
                    break;
                case 'RCH':
                    $subArrayCaso['estado'] = 'Rechazado';
                    break;
                case 'REN':
                    $subArrayCaso['estado'] = 'Renunciado';
                    break;
                case 'REC':
                    $subArrayCaso['estado'] = 'Recusado';
                    break;
            }

            switch ($designacionPersonal->flgTipoDesignacion) {
                case 'C':
                    $subArrayCaso['tipo'] = 'Por la Corte';
                    break;
                case 'P':
                    $subArrayCaso['tipo'] = 'Por las Partes';
                    break;
                default:
                    $subArrayCaso['tipo'] = 'Por Definir';
            }

            $subArrayCaso['cargo'] = $designacionPersonal->expedienteDesignacion->expedienteDesignacionTipo->nombre;

            array_push($objPersonal['casos'],$subArrayCaso);

        }


        return view('designacion.historicoPersonal')
            ->with('objDesignacion',$objDesignacion)
            ->with('objPersonal',$objPersonal);

    }


    // ===================
    //  SESSION FUNCTIONS
    // ===================

    public function sesionDatosExpediente(Request $request)
    {
        $idExpediente = $request->input('idExpediente');
        $numeroExpediente = $request->input('numeroExpediente');

        $objDesignacion = session('objDesignacion');

        $subArray = array();
        $subArray['id']=$idExpediente;
        $subArray['numero']=$numeroExpediente;

        $objDesignacion['expediente'] = array();
        array_push($objDesignacion['expediente'],$subArray);

        session(['objDesignacion' => $objDesignacion]);

        return "true";
    }


    public function sesionDatosPersonal(Request $request)
    {
        $idDesignacion = $request->input('idDesignacion');
        $idPersonal = $request->input('idPersonal');
        $nombrePersonal = $request->input('nombrePersonal');
        $estado =  $request->input('estado');

        $objDesignacion = session('objDesignacion');

        $existePersonal = false;
        foreach($objDesignacion['propuestas'] as $sesPropuesta){
            if($sesPropuesta['idPersonal']==$idPersonal){
                $existePersonal = true;
            }
        }

        if(!$existePersonal){
            $objUsuarioLegal = UsuarioLegal::where('idUsuarioLegal','=',$idPersonal)->first();

            $subArray = array();
            $subArray['hash'] = sha1(time());
            $subArray['idPersonal'] = $idPersonal;
            $subArray['nombrePersonal']=$nombrePersonal;
            $subArray['especialidades']=array();
            foreach($objUsuarioLegal->usuarioLegalEspecialidads as $usuarioEspecialidad){
                $subArrayEspecialidad = array();
                $subArrayEspecialidad['id']=$usuarioEspecialidad->legalEspecialidad->idLegalEspecialidad;
                $subArrayEspecialidad['nombre']=$usuarioEspecialidad->legalEspecialidad->nombre;
                array_push($subArray['especialidades'],$subArrayEspecialidad);
            }

            $subArray['observacion'] = "";
            $subArray['flgTipoDesignacion'] = "";
            $subArray['fecha'] = Carbon::now('America/Lima')->format('Y-m-d');

            $subArray['estado'] = array();

            $subArrayEstado['id'] = $estado;

            switch ($estado) {
                case 'DES':
                    $subArrayEstado['nombre'] = 'Designado';
                    break;
                case 'PRP':
                    $subArrayEstado['nombre'] = 'Propuesto';
                    break;
                case 'RCH':
                    $subArrayEstado['nombre'] = 'Rechazado';
                    break;
                case 'REN':
                    $subArrayEstado['nombre'] = 'Renunciado';
                    break;
                case 'REC':
                    $subArrayEstado['nombre'] = 'Recusado';
                    break;
            }
            array_push($subArray['estado'],$subArrayEstado);

            array_push($objDesignacion['propuestas'],$subArray);

        } else {
            return "false";
        }

        session(['objDesignacion' => $objDesignacion]);

        return "true";
    }



    public function sesionDatosPropuesta(Request $request)
    {
        $idDesignacion = $request->input('idDesignacion');
        $hash = $request->input('hash');
        $flgTipoDesignacion = $request->input('flgTipoDesignacion');
        $estado = $request->input('estado');
        $observacion = $request->input('observacion');

        $objDesignacion = session('objDesignacion');

        foreach ($objDesignacion['propuestas'] as $key => $propuesta) {
            if($propuesta['hash']==$hash){
                $objDesignacion['propuestas'][$key]['observacion'] = $observacion;
                $objDesignacion['propuestas'][$key]['flgTipoDesignacion'] = $flgTipoDesignacion;
                $objDesignacion['propuestas'][$key]['estado'] = array();

                $subArray['estado'] = array();
                $subArray['id'] = $estado;
                switch ($estado) {
                    case 'DES':
                        $subArray['nombre'] = 'Designado';
                        break;
                    case 'PRP':
                        $subArray['nombre'] = 'Propuesto';
                        break;
                    case 'RCH':
                        $subArray['nombre'] = 'Rechazado';
                        break;
                    case 'REN':
                        $subArray['nombre'] = 'Renunciado';
                        break;
                    case 'REC':
                        $subArray['nombre'] = 'Recusado';
                        break;
                }
                array_push($objDesignacion['propuestas'][$key]['estado'],$subArray);
            }
        }

        session(['objDesignacion' => $objDesignacion]);

        return "true";
    }



    public function sesionBorrarPersonal($hash)
    {
        $objDesignacion = session('objDesignacion');

        $objDesignacion['propuestas'] = $this->removeElementWithValue($objDesignacion['propuestas'], 'hash', $hash);

        session(['objDesignacion' => $objDesignacion]);

        return "true";

    }


    public function sesionVerificarPropuesta(Request $request)
    {   $idDesignacion = $request->input('idDesignacion');

        $objDesignacion = session('objDesignacion');

        if(count($objDesignacion['propuestas'])>0){
            return "true";
        }

        return "false";
    }


    public function sesionDatos(Request $request)
    {
        $idDesignacion = $request->input('idDesignacion');
        $idExpediente = $request->input('idExpediente');
        $numeroExpediente = $request->input('numeroExpediente');
        $tipo = $request->input('tipo');

        if($idDesignacion==null){
            $idDesignacion=0;
        }
        if($idExpediente==null){
            $idExpediente=0;
        }
        if($numeroExpediente==null){
            $numeroExpediente="";
        }
        if($tipo==null){
            $tipo=0;
        }

        $objDesignacion = session('objDesignacion');

        if($objDesignacion==null){

            $arrDesignacion = array();
            $arrDesignacion['idDesignacion'] = $idDesignacion;
            $arrDesignacion['fecha'] = Carbon::now('America/Lima')->format('Y-m-d');

            $arrDesignacion['tipoDesignacion']=array();
            $arrDesignacion['expediente']=array();
            $arrDesignacion['propuestas']=array();

            if($tipo==0){
                $subArray = array();
                $subArray['id'] = $tipo;
                $subArray['nombre'] = "";
                array_push($arrDesignacion['tipoDesignacion'],$subArray);
            } else {
                $objDesignacionTipo = ExpedienteDesignacionTipo::where('idExpedienteDesignacionTipo','=',$tipo)->first();
                $subArray = array();
                $subArray['id'] = $tipo;
                $subArray['nombre'] = $objDesignacionTipo->nombre;
                array_push($arrDesignacion['tipoDesignacion'],$subArray);
            }

            $subArray = array();
            $subArray['id']=$idExpediente;
            $subArray['numero']=$numeroExpediente;
            array_push($arrDesignacion['expediente'],$subArray);

            // Actualizamos los contenidos de la variable SESSION
            session(['objDesignacion' => $arrDesignacion]);

        }else{
            // 0. Actualizamos los valores del objeto session con los de REQUEST
            $objDesignacion['idDesignacion'] = $idDesignacion;

            $objDesignacion['tipoDesignacion']=array();
            $objDesignacion['expediente']=array();

            if($tipo==0){
                $subArray = array();
                $subArray['id'] = $tipo;
                $subArray['nombre'] = "";
                array_push($objDesignacion['tipoDesignacion'],$subArray);
            } else {
                $objDesignacionTipo = ExpedienteDesignacionTipo::where('idExpedienteDesignacionTipo','=',$tipo)->first();
                $subArray = array();
                $subArray['id'] = $tipo;
                $subArray['nombre'] = $objDesignacionTipo->nombre;
                array_push($objDesignacion['tipoDesignacion'],$subArray);
            }

            $subArray = array();
            $subArray['id']=$idExpediente;
            $subArray['numero']=$numeroExpediente;
            array_push($objDesignacion['expediente'],$subArray);

            // 3. Actualizamos los contenidos de la variable SESSION
            session(['objDesignacion' => $objDesignacion]);

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
