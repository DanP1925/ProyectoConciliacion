<?php

namespace App\Library;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FiltroExpediente{

	var $numeroExpediente;
	var $fechaInicio;
	var $fechaFin;
	var $demandante;
	var $demandado;
	var $miembroDemandante;
	var $miembroDemandado;
	var $secretarioResponsable;
	var $secretarioLider;
	var $estado;
	var $tipoCaso;
	var $subtipoCaso;

    function __construct(Request $request)
    {
		$this->numeroExpediente = $request->session()->get('filtroNumeroExpediente');
		$this->fechaInicio= $request->session()->get('filtroFechaInicio');
		$this->fechaFin= $request->session()->get('filtroFechaFin');
		$this->demandante= $request->session()->get('filtroDemandante');
		$this->demandado= $request->session()->get('filtroDemandado');
		$this->miembroDemandante = $request->session()->get('filtroMiembroDemandante');
		$this->miembroDemandado = $request->session()->get('filtroMiembroDemandado');
		$this->secretarioResponsable = $request->session()->get('filtroSecretarioResponsable');
		$this->secretarioLider = $request->session()->get('filtroSecretarioLider');
		$this->estado = $request->session()->get('filtroEstado');
		$this->tipoCaso = $request->session()->get('filtroTipoCaso');
		$this->subtipoCaso = $request->session()->get('filtroSubtipoCaso');
    }

	public static function guardarEnSesion(Request $request)
	{
		$request->session()->put('filtroNumeroExpediente', $request->input('numeroExpediente'));
		$request->session()->put('filtroFechaInicio', $request->input('fechaInicio'));
		$request->session()->put('filtroFechaFin', $request->input('fechaFin'));
		$request->session()->put('filtroDemandante', $request->input('demandante'));
		$request->session()->put('filtroDemandado', $request->input('demandado'));
		$request->session()->put('filtroMiembroDemandante', $request->input('miembroDemandante'));
		$request->session()->put('filtroMiembroDemandado', $request->input('miembroDemandado'));
		$request->session()->put('filtroSecretarioResponsable', $request->input('secretarioResponsable'));
		$request->session()->put('filtroSecretarioLider', $request->input('secretarioLider'));
		$request->session()->put('filtroEstado', $request->input('estado'));
		$request->session()->put('filtroTipoCaso', $request->input('tipoCaso'));
		$request->session()->put('filtroSubtipoCaso', $request->input('subtipoCaso'));
	}

	public static function quitarDeSesion(Request $request)
	{
        $request->session()->forget('filtroNumeroExpediente');
        $request->session()->forget('filtroFechaInicio');
        $request->session()->forget('filtroFechaFin');
        $request->session()->forget('filtroDemandante');
        $request->session()->forget('filtroDemandado');
        $request->session()->forget('filtroMiembroDemandante');
        $request->session()->forget('filtroMiembroDemandado');
        $request->session()->forget('filtroSecretarioResponsable');
        $request->session()->forget('filtroSecretarioLider');
        $request->session()->forget('filtroEstado');
        $request->session()->forget('filtroTipoCaso');
        $request->session()->forget('filtroSubtipoCaso');
	}
}
