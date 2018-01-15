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
        $regiones = DB::table('region')->get()->all();
        $primeraDivision = DB::table('tipo_caso')->get()->all();
        $segundaDivision = DB::table('tipo_caso_forma')->get()->all();
        $tiposCuantia = DB::table('cuantia_tipo')->get()->all();
        $tiposDeterminada = DB::table('cuantia_determinada')->get()->all();

        return view('expediente.nuevo',
            compact('regiones','primeraDivision', 'segundaDivision'
                    ,'tiposCuantia','tiposDeterminada'));
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
            'region01' => 'required',
            'region02' => 'nullable',
            'region03' => 'nullable',
            'tipoCaso01' => 'required',
            'tipoCaso02' => 'required',
            'cuantiaControversia' => 'required',
            'tipoCuantía' => 'required',
            'cuantiaDeterminada' => 'nullable',
        ]);

        dd($validatedData);
    }
}
