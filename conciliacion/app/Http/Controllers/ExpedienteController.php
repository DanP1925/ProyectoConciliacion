<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Library\ExpedienteTemporal;

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

    public function nuevo(Request $request)
    {
        $expedienteTemporal = new ExpedienteTemporal($request);

        ExpedienteTemporal::quitarDeSesion($request);

        if (!is_null($request->input('accion'))){
            $accion = explode(" ",$request->input('accion'));
            $tipoAccion = $accion[0];
            $resultadoAccion = $accion[1];
            
            if ($tipoAccion == "buscarSecretario")
                $expedienteTemporal->agregarSecretario($resultadoAccion);
            else if ($tipoAccion == "buscarLider")
                $expedienteTemporal->agregarSecretarioLider($resultadoAccion);
        }

        $estadosExpediente = DB::table('expediente_estado')->get()->all();
        $tipos = DB::table('expediente_tipo_caso')->get()->all();
        $subtipos = DB::table('expediente_subtipo_caso')->get()->all();
        $tiposCuantia = DB::table('cuantia_tipo')->get()->all();
        $escalasDePago  = DB::table('cuantia_escala_pago')->get()->all();

        $regiones = DB::table('region')->get()->all();

        return view('expediente.nuevo',
            compact('estadosExpediente',
                    'regiones',
                    'tipos',
                    'subtipos',
                    'tiposCuantia',
                    'escalasDePago',
                    'expedienteTemporal'));
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
