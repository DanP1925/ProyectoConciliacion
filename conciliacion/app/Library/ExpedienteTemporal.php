<?php 

namespace App\Library;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Models\ExpedienteClienteLegal;
use App\Http\Models\ConsorcioPersonaDetalle;

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
	var $miembroDemandante;
	var $miembroDemandante2;
	var $miembroDemandante3;
	var $consorcioDemandado;
	var $miembroDemandado;
	var $miembroDemandado2;
	var $miembroDemandado3;

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

		if (!is_null($request->session()->get('miembroDemandante')))
			$this->miembroDemandante = $request->session()->get('miembroDemandante');

		if (!is_null($request->session()->get('miembroDemandante2')))
			$this->miembroDemandante2 = $request->session()->get('miembroDemandante2');

		if (!is_null($request->session()->get('miembroDemandante3')))
			$this->miembroDemandante3 = $request->session()->get('miembroDemandante3');

		if (!is_null($request->session()->get('consorcioDemandado')))
			$this->consorcioDemandado = $request->session()->get('consorcioDemandado');

		if (!is_null($request->session()->get('miembroDemandado')))
			$this->miembroDemandado = $request->session()->get('miembroDemandado');

		if (!is_null($request->session()->get('miembroDemandado2')))
			$this->miembroDemandado2 = $request->session()->get('miembroDemandado2');

		if (!is_null($request->session()->get('miembroDemandado3')))
			$this->miembroDemandado3 = $request->session()->get('miembroDemandado3');
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

				$listaMiembros = $consorcio->getMiembros();

			}

		} else {
			$personaNatural = $demandante->getPersonaNatural();
			$this->demandante = $personaNatural->nombre;
			$this->demandante .= ' '.$personaNatural->apellidoPaterno;
			$this->demandante .= ' '.$personaNatural->apellidoMaterno;

			$consorcio = ConsorcioPersonaDetalle::where('idPersonaNatural',$personaNatural->idPersonaNatural)->first();

		}
	}

	function agregarDemandado($idClienteLegal){

		$demandado = ExpedienteClienteLegal::where('idExpedienteClienteLegal',$idClienteLegal)->first();

		if ($demandado->flgTipoPersona == 'J'){
			$personaJuridica = $demandado->getPersonaJuridica();
			$this->demandado= $personaJuridica->razonSocial;
		} else {
			$personaNatural = $demandado->getPersonaNatural();
			$this->demandado = $personaNatural->nombre;
			$this->demandado .= ' '.$personaNatural->apellidoPaterno;
			$this->demandado .= ' '.$personaNatural->apellidoMaterno;
		}
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

		if (!is_null($request->input('miembroDemandante')))
			$request->session()->put('miembroDemandante',$request->input('miembroDemandante'));

		if (!is_null($request->input('miembroDemandante2')))
			$request->session()->put('miembroDemandante2',$request->input('miembroDemandante2'));

		if (!is_null($request->input('miembroDemandante3')))
			$request->session()->put('miembroDemandante3',$request->input('miembroDemandante3'));

		if (!is_null($request->input('consorcioDemandado')))
			$request->session()->put('consorcioDemandado',$request->input('consorcioDemandado'));

		if (!is_null($request->input('miembroDemandado')))
			$request->session()->put('miembroDemandado',$request->input('miembroDemandado'));

		if (!is_null($request->input('miembroDemandado2')))
			$request->session()->put('miembroDemandado2',$request->input('miembroDemandado2'));

		if (!is_null($request->input('miembroDemandado3')))
			$request->session()->put('miembroDemandado3',$request->input('miembroDemandado3'));
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
		$request->session()->forget('miembroDemandante');
		$request->session()->forget('miembroDemandante2');
		$request->session()->forget('miembroDemandante3');
		$request->session()->forget('consorcioDemandado');
		$request->session()->forget('miembroDemandado');
		$request->session()->forget('miembroDemandado2');
		$request->session()->forget('miembroDemandado3');

    }
}
