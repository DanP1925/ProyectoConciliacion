<?php 

namespace App\Library;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Models\ExpedienteClienteLegal;
use App\Http\Models\ConsorcioPersonaDetalle;
use App\Http\Models\Region;
use App\Library\RecursoTemporal;

class ExpedienteTemporal {

    var $numero;
    var $fechaSolicitud;
    var $estadoExpediente;
    var $numeroAsociado;
    var $tipoCaso;
    var $subtipoCaso;
    var $cuantiaControversiaInicial;
    var $cuantiaControversiaFinal;
    var $tipoCuantia;
    var $escalaPago;
	var $idSecretarioResponsable;
    var $secretarioArbitral;
	var $idSecretarioLider;
    var $secretarioArbitralLider;
	var $idDemandante;
	var $demandante;
	var $idDemandado;
	var $demandado;
	var $consorcioDemandante;
	var $miembrosDemandante;
	var $consorcioDemandado;
	var $miembrosDemandado;
	var $tipoDemandante;
	var $tipoDemandado;
	var $origenArbitraje;
	var $montoContrato;
	var $anhoContrato;
	var $regiones;
	var $arbitroUnico;
	var $designacionArbitroUnico;
	var $presidenteTribunal;
	var $arbitroDemandante;
	var $arbitroDemandado;
	var $designacionPresidenteTribunal;
	var $designacionDemandante;
	var $designacionDemandado;
	var $fechaLaudo;
	var $resultadoLaudo;
	var $resultadoEnSoles;
	var $ejecucionLaudo;
	var $laudadoAFavor;
	var $recursos;

    function __construct()
    {
    }

	public static function withRequest(Request $request)
	{
		$instance = new self();
        $instance->numero = $request->session()->get('numero');
        $instance->fechaSolicitud = $request->session()->get('fechaSolicitud');
        $instance->estadoExpediente = $request->session()->get('estadoExpediente');
        $instance->numeroAsociado = $request->session()->get('numeroAsociado');
        $instance->tipoCaso = $request->session()->get('tipoCaso');
        $instance->subtipoCaso = $request->session()->get('subtipoCaso');
        $instance->cuantiaControversiaInicial = $request->session()->get('cuantiaControversiaInicial');
        $instance->cuantiaControversiaFinal = $request->session()->get('cuantiaControversiaFinal');
        $instance->tipoCuantia = $request->session()->get('tipoCuantia');
        $instance->escalaPago = $request->session()->get('escalaPago');

        if (!is_null($request->session()->get('secretarioArbitral'))){
			$instance->idSecretarioResponsable = $request->session()->get('idSecretarioResponsable');
            $instance->secretarioArbitral = $request->session()->get('secretarioArbitral');
		}

        if (!is_null($request->session()->get('secretarioArbitralLider'))){
            $instance->idSecretarioLider= $request->session()->get('idSecretarioLider');
            $instance->secretarioArbitralLider = $request->session()->get('secretarioArbitralLider');
		}

		if (!is_null($request->session()->get('demandante'))){
			$instance->idDemandante = $request->session()->get('idDemandante');
			$instance->demandante = $request->session()->get('demandante');
		}

		if (!is_null($request->session()->get('demandado'))){
			$instance->idDemandado = $request->session()->get('idDemandado');
			$instance->demandado = $request->session()->get('demandado');
		}

		if (!is_null($request->session()->get('consorcioDemandante')))
			$instance->consorcioDemandante = $request->session()->get('consorcioDemandante');

		if (!is_null($request->session()->get('miembrosDemandante')))
			$instance->miembrosDemandante = $request->session()->get('miembrosDemandante');

		if (!is_null($request->session()->get('consorcioDemandado')))
			$instance->consorcioDemandado = $request->session()->get('consorcioDemandado');

		if (!is_null($request->session()->get('miembrosDemandado')))
			$instance->miembrosDemandado = $request->session()->get('miembrosDemandado');

        $instance->tipoDemandante = $request->session()->get('tipoDemandante');
        $instance->tipoDemandado = $request->session()->get('tipoDemandado');

		if (!is_null($request->session()->get('origenArbitraje')))
			$instance->origenArbitraje = $request->session()->get('origenArbitraje');

		if (!is_null($request->session()->get('montoContrato')))
			$instance->montoContrato = $request->session()->get('montoContrato');

		$instance->anhoContrato = $request->session()->get('anhoContrato');
		$instance->regiones = $request->session()->get('regiones');
		$instance->arbitroUnico = $request->session()->get('arbitroUnico');

		if (!is_null($request->session()->get('designacionArbitroUnico')))
			$instance->designacionArbitroUnico = $request->session()->get('designacionArbitroUnico');

		$instance->presidenteTribunal = $request->session()->get('presidenteTribunal');
		$instance->arbitroDemandante = $request->session()->get('arbitroDemandante');
		$instance->arbitroDemandado = $request->session()->get('arbitroDemandado');

		if (!is_null($request->session()->get('designacionPresidenteTribunal')))
			$instance->designacionPresidenteTribunal = $request->session()->get('designacionPresidenteTribunal');

		if (!is_null($request->session()->get('designacionDemandante')))
			$instance->designacionDemandante = $request->session()->get('designacionDemandante');

		if (!is_null($request->session()->get('designacionDemandado')))
			$instance->designacionDemandado = $request->session()->get('designacionDemandado');

		$instance->fechaLaudo = $request->session()->get('fechaLaudo');

		if (!is_null($request->session()->get('resultadoLaudo')))
			$instance->resultadoLaudo = $request->session()->get('resultadoLaudo');

		$instance->resultadoEnSoles = $request->session()->get('resultadoEnSoles');

		if (!is_null($request->session()->get('ejecucionLaudo')))
			$instance->ejecucionLaudo = $request->session()->get('ejecucionLaudo');

		if (!is_null($request->session()->get('laudadoAFavor')))
			$instance->laudadoAFavor = $request->session()->get('laudadoAFavor');

		$instance->recursos = $request->session()->get('recursos');
		return $instance;
	}

	public static function withId($id){
		$instance = new self();

		$expediente = DB::table('expediente')->where('idExpediente',$id)->first();
		$equipoLegal = DB::table('expediente_equipo_legal')->where('idExpediente',$id)->first();
		$recursosLaudo = DB::table('laudo_recurso_presentado')->where('idExpediente',$id)->get()->all();

        $instance->numero= $expediente->numero;
		$instance->fechaSolicitud = explode(" ",$expediente->fechaSolicitud)[0];
		$instance->estadoExpediente = $expediente->idExpedienteEstado;
		$instance->numeroAsociado = $expediente->numeroAsociado;
		$instance->tipoCaso = $expediente->idExpedienteTipoCaso;
		$instance->subtipoCaso = $expediente->idExpedienteSubtipoCaso;
		$instance->cuantiaControversiaInicial = $expediente->cuantiaMontoInicial;
		$instance->cuantiaControversiaFinal = $expediente->cuantiaMontoFinal;
		$instance->tipoCuantia = $expediente->idCuantiaTipo;
		$instance->escalaPago = $expediente->idCuantiaEscalaPago;

		$secretarioResponsable = DB::table('usuario_legal')->where('idUsuarioLegal',$expediente->idSecretarioResponsable)->first();
		$instance->idSecretarioResponsable = $secretarioResponsable->idUsuarioLegal;
		$instance->secretarioArbitral = ($secretarioResponsable->nombre).' '.($secretarioResponsable->apellidoPaterno).' '.($secretarioResponsable->apellidoMaterno);

		$secretarioLider = DB::table('usuario_legal')->where('idUsuarioLegal',$expediente->idSecretarioLider)->first();
		$instance->idSecretarioLider = $secretarioLider->idUsuarioLegal;
		$instance->secretarioArbitralLider = ($secretarioLider->nombre).' '.($secretarioLider->apellidoPaterno).' '.($secretarioLider->apellidoMaterno);

		$demandante = DB::table('expediente_cliente_legal')->where('idExpedienteClienteLegal',$expediente->idDemandante)->first();

		$instance->idDemandante = $demandante->idExpedienteClienteLegal;
		if ($demandante->flgTipoPersona == 'J'){
			$personaJuridica = DB::table('persona_juridica')->where('idPersonaJuridica',$demandante->idPersonaJuridica)->first();
			$instance->demandante = $personaJuridica->razonSocial;

			if (!is_null($personaJuridica)){
				$consorcioDemandante = DB::table('consorcio_persona_detalle')->where('idPersonaJuridica',$personaJuridica->idPersonaJuridica)->first();
				$nombreConsorcioPersona = DB::table('consorcio_persona')->where('idConsorcioPersona',$consorcioDemandante->idConsorcioPersona)->first();
				$instance->consorcioDemandante = $nombreConsorcioPersona->nombre;
				$miembrosConsorcio = DB::table('consorcio_persona_detalle')->where('idConsorcioPersona',$consorcioDemandante->idConsorcioPersona)->get()->all();
				$listaNombreMiembros = [];
				foreach($miembrosConsorcio as $miembro){
					$miembroJuridico = DB::table('persona_juridica')->where('idPersonaJuridica',$miembro->idPersonaJuridica)->first();
					array_push($listaNombreMiembros,$miembroJuridico->razonSocial);
				}
				$instance->miembrosDemandante = $listaNombreMiembros;
			}
		} else if ($demandante->flgTipoPersona == 'N'){
			$personaNatural = DB::table('persona_natural')->where('idPersonaNatural',$demandante->idPersonaNatural)->first();
			$instance->demandante = ($personaNatural->nombre).' '.($personaNatural->apellidoPaterno).' '.($personaNatural->apellidoMaterno);

			if (!is_null($personaNatural)){
				$consorcioDemandante = DB::table('consorcio_persona_detalle')->where('idPersonaNatural',$personaNatural->idPersonaNatural)->first();
				$nombreConsorcioPersona = DB::table('consorcio_persona')->where('idConsorcioPersona',$consorcioDemandante->idConsorcioPersona)->first();
				$instance->consorcioDemandante = $nombreConsorcioPersona->nombre;
				$miembrosConsorcio = DB::table('consorcio_persona_detalle')->where('idConsorcioPersona',$consorcioDemandante->idConsorcioPersona)->get()->all();
				$listaNombreMiembros = [];
				foreach($miembrosConsorcio as $miembro){
					$miembroNatural = DB::table('persona_natural')->where('idPersonaNatural',$miembro->idPersonaNatural)->first();
					$nombre = ($miembroNatural.nombre).' '.($miembroNatural.apellidoPaterno).' '.($miembroNatural.apellidoMaterno);
					array_push($listaNombreMiembros,$nombre);
				}
				$instance->miembrosDemandante = $listaNombreMiembros;
			}
		}

		$demandado = DB::table('expediente_cliente_legal')->where('idExpedienteClienteLegal',$expediente->idDemandado)->first();

		$instance->idDemandado = $demandado->idExpedienteClienteLegal;
		if ($demandado->flgTipoPersona == 'J'){
			$personaJuridica = DB::table('persona_juridica')->where('idPersonaJuridica',$demandado->idPersonaJuridica)->first();
			$instance->demandado = $personaJuridica->razonSocial;

			if (!is_null($personaJuridica)){
				$consorcioDemandado = DB::table('consorcio_persona_detalle')->where('idPersonaJuridica',$personaJuridica->idPersonaJuridica)->first();
				$nombreConsorcioPersona = DB::table('consorcio_persona')->where('idConsorcioPersona',$consorcioDemandado->idConsorcioPersona)->first();
				$instance->consorcioDemandado = $nombreConsorcioPersona->nombre;
				$miembrosConsorcio = DB::table('consorcio_persona_detalle')->where('idConsorcioPersona',$consorcioDemandado->idConsorcioPersona)->get()->all();
				$listaNombreMiembros = [];
				foreach($miembrosConsorcio as $miembro){
					$miembroJuridico = DB::table('persona_juridica')->where('idPersonaJuridica',$miembro->idPersonaJuridica)->first();
					array_push($listaNombreMiembros,$miembroJuridico->razonSocial);
				}
				$instance->miembrosDemandado = $listaNombreMiembros;
			}
		} else if ($demandado->flgTipoPersona == 'N'){
			$personaNatural = DB::table('persona_natural')->where('idPersonaNatural',$demandado->idPersonaNatural)->first();
			$instance->demandado = ($personaNatural->nombre).' '.($personaNatural->apellidoPaterno).' '.($personaNatural->apellidoMaterno);

			if (!is_null($personaNatural)){
				$consorcioDemandado = DB::table('consorcio_persona_detalle')->where('idPersonaNatural',$personaNatural->idPersonaNatural)->first();
				$nombreConsorcioPersona = DB::table('consorcio_persona')->where('idConsorcioPersona',$consorcioDemandado->idConsorcioPersona)->first();
				$instance->consorcioDemandado = $nombreConsorcioPersona->nombre;
				$miembrosConsorcio = DB::table('consorcio_persona_detalle')->where('idConsorcioPersona',$consorcioDemandado->idConsorcioPersona)->get()->all();
				$listaNombreMiembros = [];
				foreach($miembrosConsorcio as $miembro){
					$miembroNatural = DB::table('persona_natural')->where('idPersonaNatural',$miembro->idPersonaNatural)->first();
					$nombre = ($miembroNatural.nombre).' '.($miembroNatural.apellidoPaterno).' '.($miembroNatural.apellidoMaterno);
					array_push($listaNombreMiembros,$nombre);
				}
				$instance->miembrosDemandado = $listaNombreMiembros;
			}
		}

		$instance->tipoDemandante = $demandante->flgSector;
		$instance->tipoDemandado = $demandado->flgSector;
		$instance->origenArbitraje = $expediente->idArbitrajeOrigen;
		$instance->montoContrato = $expediente->idArbitrajeMontoContrato;
		$instance->anhoContrato = $expediente->arbitrajeAnhoContrato;

		$regionesControversia = DB::table('region_controversia')->where('idExpediente',$expediente->idExpediente)->get()->all();
		$listaregiones = [];
		foreach($regionesControversia as $regionControversia){
			$region = DB::table('region')->where('idRegion',$regionControversia->idRegion)->first();
			array_push($listaregiones,$region->nombre);
		}	
		$instance->regiones = $listaregiones;

		if(!is_null($equipoLegal->idArbitroUnico)){
			$arbitroUnico = DB::table('usuario_legal')->where('idUsuarioLegal',$equipoLegal->idArbitroUnico)->first(); 
			$instance->arbitroUnico = ($arbitroUnico->nombre).' '.($arbitroUnico->apellidoPaterno).' '.($arbitroUnico->apellidoMaterno);
		}

		if(!is_null($equipoLegal->tipDesArbitroUnico)){
			$tipDesArbitroUnico = DB::table('designacion_tipo')->where('idDesignacionTipo',$equipoLegal->tipDesArbitroUnico)->first();
			$instance->designacionArbitroUnico = $tipDesArbitroUnico->nombre;
		}

		if(!is_null($equipoLegal->idPresidenteTribunal)){
			$presidenteTribunal = DB::table('usuario_legal')->where('idUsuarioLegal',$equipoLegal->idPresidenteTribunal)->first(); 
			$instance->presidenteTribunal = ($presidenteTribunal->nombre).' '.($presidenteTribunal->apellidoPaterno).' '.($presidenteTribunal->apellidoMaterno);
		}

		if(!is_null($equipoLegal->tipDesPresidenteTribunal)){
			$tipDesPresidenteTribunal = DB::table('designacion_tipo')->where('idDesignacionTipo',$equipoLegal->tipDesPresidenteTribunal)->first();
			$instance->designacionPresidenteTribunal = $tipDesPresidenteTribunal->nombre;
		}

		if(!is_null($equipoLegal->idArbitroDemandante)){
			$arbitroDemandante = DB::table('usuario_legal')->where('idUsuarioLegal',$equipoLegal->idArbitroDemandante)->first(); 
			$instance->arbitroDemandante = ($arbitroDemandante->nombre).' '.($arbitroDemandante->apellidoPaterno).' '.($arbitroDemandante->apellidoMaterno);
		}

		if(!is_null($equipoLegal->tipDesArbitroDemandante)){
			$tipDesArbitroDemandante = DB::table('designacion_tipo')->where('idDesignacionTipo',$equipoLegal->tipDesArbitroDemandante)->first();
			$instance->designacionDemandante= $tipDesArbitroDemandante->nombre;
		}

		if(!is_null($equipoLegal->idArbitroDemandado)){
			$arbitroDemandado = DB::table('usuario_legal')->where('idUsuarioLegal',$equipoLegal->idArbitroDemandado)->first(); 
			$instance->arbitroDemandado = ($arbitroDemandado->nombre).' '.($arbitroDemandado->apellidoPaterno).' '.($arbitroDemandado->apellidoMaterno);
		}

		if(!is_null($equipoLegal->tipDesArbitroDemandado)){
			$tipDesArbitroDemandado = DB::table('designacion_tipo')->where('idDesignacionTipo',$equipoLegal->tipDesArbitroDemandado)->first();
			$instance->designacionDemandado = $tipDesArbitroDemandado->nombre;
		}

		$instance->fechaLaudo = (explode(" ",$expediente->laudofecha))[0];
		$instance->resultadoLaudo = $expediente->idLaudoResultado;
		$instance->resultadoEnSoles = $expediente->laudoMontoResultado;
		$instance->ejecucionLaudo = $expediente->idLaudoEjecucion;
		$instance->laudadoAFavor= $expediente->idLaudoAFavor;

		$listaRecursos = [];
		foreach ($recursosLaudo as $recurso){
			$fechaPresentacion = (explode(" ",$recurso->fechaPresentacion))[0];
			$fechaResultado = (explode(" ",$recurso->fechaResultado))[0];
			$recursoTemporal = RecursoTemporal::withData(
				$recurso->idLaudoRecurso,$fechaPresentacion,
				$recurso->idLaudoRecursoResultado,$fechaResultado);
			array_push($listaRecursos,$recursoTemporal);
		}
		$instance->recursos = $listaRecursos;

		return $instance;
	}

    public static function guardarEnSesion(Request $request){

        if (!is_null($request->input('numero')))
            $request->session()->put('numero',$request->input('numero'));

        if (!is_null($request->input('fechaSolicitud')))
            $request->session()->put('fechaSolicitud',$request->input('fechaSolicitud'));
        
        if (!is_null($request->input('estadoExpediente')))
            $request->session()->put('estadoExpediente',$request->input('estadoExpediente'));

        if (!is_null($request->input('numeroAsociado')))
            $request->session()->put('numeroAsociado',$request->input('numeroAsociado'));

        if (!is_null($request->input('tipoCaso')))
            $request->session()->put('tipoCaso',$request->input('tipoCaso'));

        if (!is_null($request->input('subtipoCaso')))
            $request->session()->put('subtipoCaso',$request->input('subtipoCaso'));

        if (!is_null($request->input('cuantiaControversiaInicial')))
            $request->session()->put('cuantiaControversiaInicial',$request->input('cuantiaControversiaInicial'));

        if (!is_null($request->input('cuantiaControversiaFinal')))
            $request->session()->put('cuantiaControversiaFinal',$request->input('cuantiaControversiaFinal'));

        if (!is_null($request->input('tipoCuantia')))
            $request->session()->put('tipoCuantia',$request->input('tipoCuantia'));

        if (!is_null($request->input('escalaPago')))
            $request->session()->put('escalaPago',$request->input('escalaPago'));

        if (!is_null($request->input('idSecretarioResponsable')))
            $request->session()->put('idSecretarioResponsable',$request->input('idSecretarioResponsable'));

        if (!is_null($request->input('secretarioResponsable')))
            $request->session()->put('secretarioArbitral',$request->input('secretarioResponsable'));

        if (!is_null($request->input('idSecretarioLider')))
            $request->session()->put('idSecretarioLider',$request->input('idSecretarioLider'));

        if (!is_null($request->input('secretarioLider')))
            $request->session()->put('secretarioArbitralLider',$request->input('secretarioLider'));

        if (!is_null($request->input('idDemandante')))
            $request->session()->put('idDemandante',$request->input('idDemandante'));

        if (!is_null($request->input('demandante')))
            $request->session()->put('demandante',$request->input('demandante'));

        if (!is_null($request->input('idDemandado')))
            $request->session()->put('idDemandado',$request->input('idDemandado'));

        if (!is_null($request->input('demandado')))
            $request->session()->put('demandado',$request->input('demandado'));

		if (!is_null($request->input('consorcioDemandante')))
			$request->session()->put('consorcioDemandante',$request->input('consorcioDemandante'));

		if (!is_null($request->input('miembrosDemandante')))
			$request->session()->put('miembrosDemandante',$request->input('miembrosDemandante'));

		if (!is_null($request->input('consorcioDemandado')))
			$request->session()->put('consorcioDemandado',$request->input('consorcioDemandado'));

		if (!is_null($request->input('miembrosDemandado')))
			$request->session()->put('miembrosDemandado',$request->input('miembrosDemandado'));

		if (!is_null($request->input('tipoDemandante')))
			$request->session()->put('tipoDemandante',$request->input('tipoDemandante'));

		if (!is_null($request->input('tipoDemandado')))
			$request->session()->put('tipoDemandado',$request->input('tipoDemandado'));

		if (!is_null($request->input('origenArbitraje')))
			$request->session()->put('origenArbitraje', $request->input('origenArbitraje'));

		if (!is_null($request->input('montoContrato')))
			$request->session()->put('montoContrato', $request->input('montoContrato'));

		if (!is_null($request->input('anhoContrato')))
			$request->session()->put('anhoContrato', $request->input('anhoContrato'));

		if (!is_null($request->input('regiones')))
			$request->session()->put('regiones', $request->input('regiones'));

		if (!is_null($request->input('arbitroUnico')))
			$request->session()->put('arbitroUnico', $request->input('arbitroUnico'));

		if (!is_null($request->input('designacionArbitroUnico')))
			$request->session()->put('designacionArbitroUnico', $request->input('designacionArbitroUnico'));

		if (!is_null($request->input('presidenteTribunal')))
			$request->session()->put('presidenteTribunal', $request->input('presidenteTribunal'));

		if (!is_null($request->input('arbitroDemandante')))
			$request->session()->put('arbitroDemandante', $request->input('arbitroDemandante'));

		if (!is_null($request->input('arbitroDemandado')))
			$request->session()->put('arbitroDemandado', $request->input('arbitroDemandado'));

		if (!is_null($request->input('designacionPresidenteTribunal')))
			$request->session()->put('designacionPresidenteTribunal', $request->input('designacionPresidenteTribunal'));
		
		if (!is_null($request->input('designacionDemandante')))
			$request->session()->put('designacionDemandante', $request->input('designacionDemandante'));

		if (!is_null($request->input('designacionDemandado')))
			$request->session()->put('designacionDemandado', $request->input('designacionDemandado'));

		if (!is_null($request->input('fechaLaudo')))
			$request->session()->put('fechaLaudo', $request->input('fechaLaudo'));

		if (!is_null($request->input('resultadoLaudo')))
			$request->session()->put('resultadoLaudo', $request->input('resultadoLaudo'));

		if (!is_null($request->input('resultadoEnSoles')))
			$request->session()->put('resultadoEnSoles', $request->input('resultadoEnSoles'));

		if (!is_null($request->input('ejecucionLaudo')))
			$request->session()->put('ejecucionLaudo', $request->input('ejecucionLaudo'));

		if (!is_null($request->input('laudadoAFavor')))
			$request->session()->put('laudadoAFavor', $request->input('laudadoAFavor'));

		// Recursos
		if (!is_null($request->input('recursoPresentado'))){

			$recursos = [];
			
			$recursosPresentados = $request->input('recursoPresentado');
			$fechasPresentacion = $request->input('fechaPresentacion');
			$resultadosRecursosPresentado = $request->input('resultadoRecursoPresentado');
			$fechasResultado = $request->input('fechaResultado');
			
			$length = count($recursosPresentados);
			for($i=0;$i<$length;$i++){
				$nuevoRecurso = RecursoTemporal::withData($recursosPresentados[$i],$fechasPresentacion[$i],
														$resultadosRecursosPresentado[$i],$fechasResultado[$i]);
				array_push($recursos,$nuevoRecurso);
			}

			$request->session()->put('recursos', $recursos);
		}
    }

    public static function quitarDeSesion(Request $request){

        $request->session()->forget('numero');
        $request->session()->forget('fechaSolicitud');
        $request->session()->forget('estadoExpediente');
        $request->session()->forget('numeroAsociado');
        $request->session()->forget('tipoCaso');
        $request->session()->forget('subtipoCaso');
        $request->session()->forget('cuantiaControversiaInicial');
        $request->session()->forget('cuantiaControversiaFinal');
        $request->session()->forget('tipoCuantia');
        $request->session()->forget('escalaPago');
        $request->session()->forget('idSecretarioResponsable');
        $request->session()->forget('secretarioArbitral');
        $request->session()->forget('idSecretarioLider');
        $request->session()->forget('secretarioArbitralLider');
        $request->session()->forget('idDemandante');
        $request->session()->forget('demandante');
        $request->session()->forget('idDemandado');
        $request->session()->forget('demandado');
		$request->session()->forget('consorcioDemandante');
		$request->session()->forget('miembrosDemandante');
		$request->session()->forget('consorcioDemandado');
		$request->session()->forget('miembrosDemandado');
        $request->session()->forget('tipoDemandante');
        $request->session()->forget('tipoDemandado');
        $request->session()->forget('origenArbitraje');
        $request->session()->forget('montoContrato');
        $request->session()->forget('anhoContrato');
		$request->session()->forget('regiones');
		$request->session()->forget('arbitroUnico');
		$request->session()->forget('designacionArbitroUnico');
		$request->session()->forget('presidenteTribunal');
		$request->session()->forget('arbitroDemandante');
		$request->session()->forget('arbitroDemandado');
		$request->session()->forget('designacionPresidenteTribunal');
		$request->session()->forget('designacionDemandante');
		$request->session()->forget('designacionDemandado');
		$request->session()->forget('fechaLaudo');
		$request->session()->forget('resultadoLaudo');
		$request->session()->forget('resultadoEnSoles');
		$request->session()->forget('ejecucionLaudo');
		$request->session()->forget('laudadoAFavor');
		$request->session()->forget('recursos');
    }

    function agregarSecretario($idUsuarioLegal){
        $secretario = DB::table('usuario_legal')->where('idUsuarioLegal',$idUsuarioLegal)->first();
		$this->idSecretarioResponsable = $secretario->idUsuarioLegal;
        $this->secretarioArbitral = $secretario->nombre;
        $this->secretarioArbitral .= ' '.$secretario->apellidoPaterno;
        $this->secretarioArbitral .= ' '.$secretario->apellidoMaterno;
    }

    function agregarSecretarioLider($idUsuarioLegal){
        $secretario = DB::table('usuario_legal')->where('idUsuarioLegal',$idUsuarioLegal)->first();
		$this->idSecretarioLider = $secretario->idUsuarioLegal;
        $this->secretarioArbitralLider = $secretario->nombre;
        $this->secretarioArbitralLider .= ' '.$secretario->apellidoPaterno;
        $this->secretarioArbitralLider .= ' '.$secretario->apellidoMaterno;
    }

	function agregarDemandante($idClienteLegal){

		$this->idDemandante = $idClienteLegal;
		$demandante = ExpedienteClienteLegal::where('idExpedienteClienteLegal',$idClienteLegal)->first();

		if ($demandante->flgTipoPersona == 'J'){
			$personaJuridica = $demandante->getPersonaJuridica();
			$this->demandante = $personaJuridica->razonSocial;

			$consorcio = ConsorcioPersonaDetalle::where('idPersonaJuridica',$personaJuridica->idPersonaJuridica)->first();

			if(!is_null($consorcio)){
				$this->consorcioDemandante = $consorcio->getConsorcioPersona()->nombre;

				$listaIds = $consorcio->getMiembros();
				$listaMiembros = [];
				foreach ($listaIds as $id){
					$nombre = DB::table('persona_juridica')->where('idPersonaJuridica',$id)->first()->razonSocial;
					array_push($listaMiembros,$nombre);
				}
				$this->miembrosDemandante = $listaMiembros;
			} else {
				$this->consorcioDemandante = null;
				$this->miembrosDemandante = null;
			}

		} else {
			$personaNatural = $demandante->getPersonaNatural();
			$this->demandante = $personaNatural->nombre;
			$this->demandante .= ' '.$personaNatural->apellidoPaterno;
			$this->demandante .= ' '.$personaNatural->apellidoMaterno;

			$consorcio = ConsorcioPersonaDetalle::where('idPersonaNatural',$personaNatural->idPersonaNatural)->first();

			if (!is_null($consorcio)){
				$this->consorcioDemandante = $consorcio->getConsorcioPersona()->nombre;

				$listaIds = $consorcio->getMiembros();
				$listaMiembros = [];
				foreach ($listaIds as $id){
					$nombre = DB::table('persona_natural')->where('idPersonaNatural',$id)->first()->nombre;
					$nombre += ' ';
					$nombre += DB::table('persona_natural')->where('idPersonaNatural',$id)->first()->apellidoPaterno;
					$nombre += ' ';
					$nombre += DB::table('persona_natural')->where('idPersonaNatural',$id)->first()->apellidoMaterno;
					array_push($listaMiembros,$nombre);
				}
				$this->miembrosDemandante = $listaMiembros;
			} else {
				$this->consorcioDemandante = null;
				$this->miembrosDemandante = null;
			}

		}
	}

	function agregarDemandado($idClienteLegal){

		$this->idDemandado = $idClienteLegal;
		$demandado = ExpedienteClienteLegal::where('idExpedienteClienteLegal',$idClienteLegal)->first();

		if ($demandado->flgTipoPersona == 'J'){
			$personaJuridica = $demandado->getPersonaJuridica();
			$this->demandado= $personaJuridica->razonSocial;

			$consorcio = ConsorcioPersonaDetalle::where('idPersonaJuridica',$personaJuridica->idPersonaJuridica)->first();
			if(!is_null($consorcio)){
				$this->consorcioDemandado = $consorcio->getConsorcioPersona()->nombre;

				$listaIds = $consorcio->getMiembros();
				$listaMiembros = [];
				foreach ($listaIds as $id){
					$nombre = DB::table('persona_juridica')->where('idPersonaJuridica',$id)->first()->razonSocial;
					array_push($listaMiembros,$nombre);
				}
				$this->miembrosDemandado = $listaMiembros;
			} else{
				$this->consorcioDemandado = null;
				$this->miembrosDemandado = null;
			}

		} else {
			$personaNatural = $demandado->getPersonaNatural();
			$this->demandado = $personaNatural->nombre;
			$this->demandado .= ' '.$personaNatural->apellidoPaterno;
			$this->demandado .= ' '.$personaNatural->apellidoMaterno;

			$consorcio = ConsorcioPersonaDetalle::where('idPersonaNatural',$personaNatural->idPersonaNatural)->first();

			if (!is_null($consorcio)){
				$this->consorcioDemandado = $consorcio->getConsorcioPersona()->nombre;

				$listaIds = $consorcio->getMiembros();
				$listaMiembros = [];
				foreach ($listaIds as $id){
					$nombre = DB::table('persona_natural')->where('idPersonaNatural',$id)->first()->nombre;
					$nombre += ' ';
					$nombre += DB::table('persona_natural')->where('idPersonaNatural',$id)->first()->apellidoPaterno;
					$nombre += ' ';
					$nombre += DB::table('persona_natural')->where('idPersonaNatural',$id)->first()->apellidoMaterno;
					array_push($listaMiembros,$nombre);
				}
				$this->miembrosDemandado = $listaMiembros;
			} else{
				$this->consorcioDemandado = null;
				$this->miembrosDemandado = null;
			}
		}
	}


	function agregarRegion($idRegion){
		$region = Region::where('idRegion',$idRegion)->first()->nombre;
		if (is_null($this->regiones))
			$this->regiones = [];
		array_push($this->regiones,$region);
	}

	function agregarRecurso(Request $request){
		$nuevoRecurso = RecursoTemporal::withRequest($request);
		if (is_null($this->recursos))
			$this->recursos= [];
		array_push($this->recursos,$nuevoRecurso);
	}

	function editarRecurso($id, Request $request){
		$nuevoRecurso = RecursoTemporal::withRequest($request);
		$this->recursos[$id] = $nuevoRecurso;

	}
}
