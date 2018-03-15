<?php 

namespace App\Library;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Models\ExpedienteClienteLegal;
use App\Http\Models\ConsorcioPersonaDetalle;
use App\Http\Models\Region;

class ExpedienteTemporal {

    var $numeroExpediente;
    var $fechaSolicitud;
    var $estadoExpediente;
    var $numeroExpedienteAsociado;
    var $tipoCaso;
    var $subtipoCaso;
    var $cuantiaControversiaInicial;
    var $cuantiaControversiaFinal;
    var $tipoCuantia;
    var $escalaPago;
    var $secretarioArbitral;
    var $secretarioArbitralLider;
	var $demandante;
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

    function __construct(Request $request)
    {
        $this->numeroExpediente = $request->session()->get('numeroExpediente');
        $this->fechaSolicitud = $request->session()->get('fechaSolicitud');
        $this->estadoExpediente = $request->session()->get('estadoExpediente');
        $this->numeroExpedienteAsociado = $request->session()->get('numeroExpedienteAsociado');
        $this->tipoCaso = $request->session()->get('tipoCaso');
        $this->subtipoCaso = $request->session()->get('subtipoCaso');
        $this->cuantiaControversiaInicial = $request->session()->get('cuantiaControversiaInicial');
        $this->cuantiaControversiaFinal = $request->session()->get('cuantiaControversiaFinal');
        $this->tipoCuantia = $request->session()->get('tipoCuantia');
        $this->escalaPago = $request->session()->get('escalaPago');

        if (!is_null($request->session()->get('secretarioArbitral')))
            $this->secretarioArbitral = $request->session()->get('secretarioArbitral');

        if (!is_null($request->session()->get('secretarioArbitralLider')))
            $this->secretarioArbitralLider = $request->session()->get('secretarioArbitralLider');

		if (!is_null($request->session()->get('demandante')))
			$this->demandante = $request->session()->get('demandante');

		if (!is_null($request->session()->get('demandado')))
			$this->demandado = $request->session()->get('demandado');

		if (!is_null($request->session()->get('consorcioDemandante')))
			$this->consorcioDemandante = $request->session()->get('consorcioDemandante');

		if (!is_null($request->session()->get('miembrosDemandante')))
			$this->miembrosDemandante = $request->session()->get('miembrosDemandante');

		if (!is_null($request->session()->get('consorcioDemandado')))
			$this->consorcioDemandado = $request->session()->get('consorcioDemandado');

		if (!is_null($request->session()->get('miembrosDemandado')))
			$this->miembrosDemandado = $request->session()->get('miembrosDemandado');

        $this->tipoDemandante = $request->session()->get('tipoDemandante');
        $this->tipoDemandado = $request->session()->get('tipoDemandado');

		if (!is_null($request->session()->get('origenArbitraje')))
			$this->origenArbitraje = $request->session()->get('origenArbitraje');

		if (!is_null($request->session()->get('montoContrato')))
			$this->montoContrato = $request->session()->get('montoContrato');

		$this->anhoContrato = $request->session()->get('anhoContrato');
		$this->regiones = $request->session()->get('regiones');
		$this->arbitroUnico = $request->session()->get('arbitroUnico');

		if (!is_null($request->session()->get('designacionArbitroUnico')))
			$this->designacionArbitroUnico = $request->session()->get('designacionArbitroUnico');

		$this->presidenteTribunal = $request->session()->get('presidenteTribunal');
		$this->arbitroDemandante = $request->session()->get('arbitroDemandante');
		$this->arbitroDemandado = $request->session()->get('arbitroDemandado');

		if (!is_null($request->session()->get('designacionPresidenteTribunal')))
			$this->designacionPresidenteTribunal = $request->session()->get('designacionPresidenteTribunal');

		if (!is_null($request->session()->get('designacionDemandante')))
			$this->designacionDemandante = $request->session()->get('designacionDemandante');

		if (!is_null($request->session()->get('designacionDemandado')))
			$this->designacionDemandado = $request->session()->get('designacionDemandado');

		$this->fechaLaudo = $request->session()->get('fechaLaudo');

		if (!is_null($request->session()->get('resultadoLaudo')))
			$this->resultadoLaudo = $request->session()->get('resultadoLaudo');

		$this->resultadoEnSoles = $request->session()->get('resultadoEnSoles');

		if (!is_null($request->session()->get('ejecucionLaudo')))
			$this->ejecucionLaudo = $request->session()->get('ejecucionLaudo');

		if (!is_null($request->session()->get('laudadoAFavor')))
			$this->laudadoAFavor = $request->session()->get('laudadoAFavor');
    }

    public static function guardarEnSesion(Request $request){

        if (!is_null($request->input('numeroExpediente')))
            $request->session()->put('numeroExpediente',$request->input('numeroExpediente'));

        if (!is_null($request->input('fechaSolicitud')))
            $request->session()->put('fechaSolicitud',$request->input('fechaSolicitud'));
        
        if (!is_null($request->input('estadoExpediente')))
            $request->session()->put('estadoExpediente',$request->input('estadoExpediente'));

        if (!is_null($request->input('numeroExpedienteAsociado')))
            $request->session()->put('numeroExpedienteAsociado',$request->input('numeroExpedienteAsociado'));

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

        if (!is_null($request->input('secretarioResponsable')))
            $request->session()->put('secretarioArbitral',$request->input('secretarioResponsable'));

        if (!is_null($request->input('secretarioLider')))
            $request->session()->put('secretarioArbitralLider',$request->input('secretarioLider'));

        if (!is_null($request->input('demandante')))
            $request->session()->put('demandante',$request->input('demandante'));

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
    }

    public static function quitarDeSesion(Request $request){

        $request->session()->forget('numeroExpediente');
        $request->session()->forget('fechaSolicitud');
        $request->session()->forget('estadoExpediente');
        $request->session()->forget('numeroExpedienteAsociado');
        $request->session()->forget('tipoCaso');
        $request->session()->forget('subtipoCaso');
        $request->session()->forget('cuantiaControversiaInicial');
        $request->session()->forget('cuantiaControversiaFinal');
        $request->session()->forget('tipoCuantia');
        $request->session()->forget('escalaPago');
        $request->session()->forget('secretarioArbitral');
        $request->session()->forget('secretarioArbitralLider');
        $request->session()->forget('demandante');
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
    }

    function agregarSecretario($idUsuarioLegal){
        $secretario = DB::table('usuario_legal')->where('idUsuario_legal',$idUsuarioLegal)->first();
        $this->secretarioArbitral = $secretario->nombre;
        $this->secretarioArbitral .= ' '.$secretario->apellidoPaterno;
        $this->secretarioArbitral .= ' '.$secretario->apellidoMaterno;
    }

    function agregarSecretarioLider($idUsuarioLegal){
        $secretario = DB::table('usuario_legal')->where('idUsuario_legal',$idUsuarioLegal)->first();
        $this->secretarioArbitralLider = $secretario->nombre;
        $this->secretarioArbitralLider .= ' '.$secretario->apellidoPaterno;
        $this->secretarioArbitralLider .= ' '.$secretario->apellidoMaterno;
    }

	function agregarDemandante($idClienteLegal){

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
}
