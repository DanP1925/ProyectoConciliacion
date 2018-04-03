<?php

namespace App\Http\Controllers;

use App\Http\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesionController extends Controller
{

    // SE LE ASIGNA EL MIDDLEWARE "AUTH" PARA TODAS SUS TRANSACCIONES
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function obtenerSesion(){
        $idPerfil = "";

        foreach (Auth::user()->usuarios as $usuario){
            $idPerfil = $usuario->perfil->idPerfil;
        }

        if($idPerfil=="ADM")  // LOGUEADO COMO ADMINISTRADOR
        {   return redirect('/expediente/lista');   }

        return redirect('/expediente/lista');
    }



}
