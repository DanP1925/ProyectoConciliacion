<?php

namespace App\Library;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FiltroRegion{

	var $nombre;

    function __construct(Request $request)
    {
		$this->nombre = $request->session()->get('filtroNombre');
	}

	public static function guardarEnSesion(Request $request)
	{
		$request->session()->put('filtroNombre', $request->input('nombre'));
	}

	public static function quitarDeSesion(Request $request)
	{
        $request->session()->forget('filtroNombre');
	}
}
