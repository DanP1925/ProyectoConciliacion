<?php

namespace App\Library;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FiltroClienteLegal{

	var $nombre;
	var $dni;
	var $razonSocial;
	var $ruc;
	var $email;
	var $flagConsorcio;
	var $sector;

    function __construct(Request $request)
    {
		$this->nombre = $request->session()->get('filtroNombre');
		$this->dni = $request->session()->get('filtroDni');
		$this->razonSocial = $request->session()->get('filtroRazonSocial');
		$this->ruc = $request->session()->get('filtroRuc');
		$this->email = $request->session()->get('filtroEmail');
		$this->flagConsorcio = $request->session()->get('filtroFlagConsorcio');
		$this->sector = $request->session()->get('filtroSector');
	}

	public static function guardarEnSesion(Request $request)
	{
		$request->session()->put('filtroNombre', $request->input('nombre'));
		$request->session()->put('filtroDni', $request->input('dni'));
		$request->session()->put('filtroRazonSocial', $request->input('razonSocial'));
		$request->session()->put('filtroRuc', $request->input('ruc'));
		$request->session()->put('filtroEmail', $request->input('email'));
		$request->session()->put('filtroFlagConsorcio', $request->input('flagConsorcio'));
		$request->session()->put('filtroSector', $request->input('sector'));
	}

	public static function quitarDeSesion(Request $request)
	{
        $request->session()->forget('filtroNombre');
        $request->session()->forget('filtroDni');
        $request->session()->forget('filtroTelefono');
        $request->session()->forget('filtroRazonSocial');
        $request->session()->forget('filtroRuc');
        $request->session()->forget('filtroEmail');
        $request->session()->forget('filtroFlagConsorcio');
        $request->session()->forget('filtroSector');
	}
}
