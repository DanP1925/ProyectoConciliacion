<?php

namespace App\Library;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FiltroUsuarioLegal{

	var $nombre;
	var $apellidoPaterno;
	var $apellidoMaterno;
	var $profesion;
	var $pais;
	var $perfil;
	var $telefono;
	var $correo;

    function __construct(Request $request)
    {
		$this->nombre = $request->session()->get('filtroNombre');
		$this->apellidoPaterno = $request->session()->get('filtroApellidoPaterno');
		$this->apellidoMaterno = $request->session()->get('filtroApellidoMaterno');
		$this->profesion = $request->session()->get('filtroProfesion');
		$this->pais = $request->session()->get('filtroPais');
		$this->perfil = $request->session()->get('filtroPerfil');
		$this->telefono = $request->session()->get('filtroTelefono');
		$this->correo = $request->session()->get('filtroCorreo');
	}

	public static function guardarEnSesion(Request $request)
	{
		$request->session()->put('filtroNombre', $request->input('nombre'));
		$request->session()->put('filtroApellidoPaterno', $request->input('apellidoPaterno'));
		$request->session()->put('filtroApellidoMaterno', $request->input('apellidoMaterno'));
		$request->session()->put('filtroProfesion', $request->input('profesion'));
		$request->session()->put('filtroPais', $request->input('pais'));
		$request->session()->put('filtroPerfil', $request->input('perfil'));
		$request->session()->put('filtroTelefono', $request->input('telefono'));
		$request->session()->put('filtroCorreo', $request->input('correo'));
	}

	public static function quitarDeSesion(Request $request)
	{
        $request->session()->forget('filtroNombre');
        $request->session()->forget('filtroApellidoPaterno');
        $request->session()->forget('filtroApellidoMaterno');
        $request->session()->forget('filtroProfesion');
        $request->session()->forget('filtroPais');
        $request->session()->forget('filtroPerfil');
        $request->session()->forget('filtroTelefono');
        $request->session()->forget('filtroCorreo');
	}
}
