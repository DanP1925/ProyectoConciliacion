<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpedienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function lista()
    {
        return view('expediente.lista');
    }

    public function nuevo()
    {
        $estadosExpediente = DB::table('expediente_estado')->get()->all();
        $tipos = DB::table('tipo_caso')->get()->all();
        $subtipos = DB::table('tipo_caso_forma')->get()->all();
        $tiposCuantia = DB::table('cuantia_tipo')->get()->all();
        $tiposDeterminada = DB::table('cuantia_determinada')->get()->all();

        $regiones = DB::table('region')->get()->all();

        return view('expediente.nuevo',
            compact('estadosExpediente',
                    'regiones',
                    'tipos',
                    'subtipos',
                    'tiposCuantia',
                    'tiposDeterminada'));
    }

    public function info()
    {
        return view('expediente.info');
    }

    public function editar()
    {
        return view('expediente.editar');
    }

    public function guardar(Request $request)
    {
        $validatedData = $request->validate([
            'numeroExpediente' => 'required',
            'fechaSolicitud' => 'required|date',
            'estadoExpediente' => 'required',
            'numeroExpedienteAsociado' => 'nullable',
            'tipoCaso' => 'required',
            'subtipoCaso' => 'required',
            'subtipoCaso2' => 'nullable',
            'subtipoCaso3' => 'nullable',
            'cuantiaControversiaInicial' => 'required',
            'cuantiaControversiaFinal' => 'nullable',
            'tipoCuantia' => 'required',
            'escalaPago' => 'required',
        ]);

        dd($validatedData);
    }
}
