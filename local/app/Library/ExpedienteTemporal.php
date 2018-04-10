<?php 

namespace App\Library;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Models\ExpedienteClienteLegal;
use App\Http\Models\ConsorcioPersonaDetalle;
use App\Http\Models\Region;
use App\Library\RecursoTemporal;
use App\Library\ParteLegalTemporal;

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
	var $parteDemandante;
	var $parteDemandado;
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

		if (!is_null($request->session()->get('parteDemandante')))
			$instance->parteDemandante = $request->session()->get('parteDemandante');

		if (!is_null($request->session()->get('parteDemandado')))
			$instance->parteDemandado = $request->session()->get('parteDemandado');

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
		$tempFechaSolicitud = explode(" ",$expediente->fechaSolicitud);
		$instance->fechaSolicitud = $tempFechaSolicitud[0];
		$instance->estadoExpediente = $expediente->idExpedienteEstado;
		$instance->numeroAsociado = $expediente->numeroAsociado;
		$instance->tipoCaso = $expediente->idExpedienteTipoCaso;
		$instance->subtipoCaso = $expediente->idExpedienteSubtipoCaso;
		$instance->cuantiaControversiaInicial = $expediente->cuantiaMontoInicial;
		$instance->cuantiaControversiaFinal = $expediente->cuantiaMontoFinal;
		$instance->tipoCuantia = $expediente->idCuantiaTipo;
		$instance->escalaPago = $expediente->idCuantiaEscalaPago;

		$secretarioResponsable = DB::table('usuario_legal')->where('idUsuarioLegal',$expediente->idSecretarioResponsable)->first();
		if (!is_null($secretarioResponsable)){
			$instance->idSecretarioResponsable = $secretarioResponsable->idUsuarioLegal;
			$instance->secretarioArbitral = ($secretarioResponsable->apellidoPaterno).' '.($secretarioResponsable->apellidoMaterno).' '.($secretarioResponsable->nombre);
		}

		$secretarioLider = DB::table('usuario_legal')->where('idUsuarioLegal',$expediente->idSecretarioLider)->first();
		if (!is_null($secretarioLider)){
			$instance->idSecretarioLider = $secretarioLider->idUsuarioLegal;
			$instance->secretarioArbitralLider = ($secretarioLider->apellidoPaterno).' '.($secretarioLider->apellidoMaterno).' '.($secretarioLider->nombre);
		}

		$instance->parteDemandante = ParteLegalTemporal::withId($id,"demandante");
		$instance->parteDemandado = ParteLegalTemporal::withId($id,"demandado");

		$instance->origenArbitraje = $expediente->idArbitrajeOrigen;
		$instance->montoContrato = $expediente->idArbitrajeMontoContrato;
		$instance->anhoContrato = $expediente->arbitrajeAnhoContrato;

		$regionesControversia = DB::table('region_controversia')->where('idExpediente',$expediente->idExpediente)->get()->all();
		$listaregiones = [];
		foreach($regionesControversia as $regionControversia){
			$region = DB::table('region')->where('idRegion',$regionControversia->idRegion)->first();
			array_push($listaregiones,$region->nombre);
		}	
		if ($listaregiones != [])
			$instance->regiones = $listaregiones;
		else
			$instance->regiones = null;

		if (!is_null($equipoLegal)){
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
		}

		$tempLaudoFecha = explode(" ",$expediente->laudofecha);
		$instance->fechaLaudo = $tempLaudoFecha[0];
		$instance->resultadoLaudo = $expediente->idLaudoResultado;
		$instance->resultadoEnSoles = $expediente->laudoMontoResultado;
		$instance->ejecucionLaudo = $expediente->idLaudoEjecucion;
		$instance->laudadoAFavor= $expediente->idLaudoAFavor;

		$listaRecursos = [];
		foreach ($recursosLaudo as $recurso){
			$tempFechaPresentacion = explode(" ",$recurso->fechaPresentacion);
			$fechaPresentacion = $tempFechaPresentacion[0];
			$tempFechaResultado = explode(" ",$recurso->fechaResultado);
			$fechaResultado = $tempFechaResultado[0];
			$recursoTemporal = RecursoTemporal::withData(
				$recurso->idLaudoRecurso,$fechaPresentacion,
				$recurso->idLaudoRecursoResultado,$fechaResultado);
			array_push($listaRecursos,$recursoTemporal);
		}
		if($listaRecursos != [])
			$instance->recursos = $listaRecursos;
		else
			$instance->recursos = null;

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

		$parteDemandante = ParteLegalTemporal::withRequest(
			$request->input('idDemandante'),$request->input('demandante'),
			$request->input('consorcioDemandante'),$request->input('miembrosDemandante'),
			$request->input('tipoDemandante'));
		$request->session()->put('parteDemandante',$parteDemandante);

		$parteDemandado = ParteLegalTemporal::withRequest(
			$request->input('idDemandado'),$request->input('demandado'),
			$request->input('consorcioDemandado'),$request->input('miembrosDemandado'),
			$request->input('tipoDemandado'));

		$request->session()->put('parteDemandado',$parteDemandado);

        if (!is_null($request->input('secretarioLider')))
            $request->session()->put('secretarioArbitralLider',$request->input('secretarioLider'));

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
        $request->session()->forget('parteDemandante');
        $request->session()->forget('parteDemandado');
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
		if (is_null($this->parteDemandante))
			$this->parteDemandante = new ParteLegalTemporal;
		$this->parteDemandante->actualizarId($idClienteLegal);
		$this->parteDemandante->actualizarNombre();
		$this->parteDemandante->actualizarConsorcio();
		$this->parteDemandante->actualizarMiembros();
	}

	function agregarDemandado($idClienteLegal){

		if (is_null($this->parteDemandado))
			$this->parteDemandado = new ParteLegalTemporal;
		$this->parteDemandado->actualizarId($idClienteLegal);
		$this->parteDemandado->actualizarNombre();
		$this->parteDemandado->actualizarConsorcio();
		$this->parteDemandado->actualizarMiembros();
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
