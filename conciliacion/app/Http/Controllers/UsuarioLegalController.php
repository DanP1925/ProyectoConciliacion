<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Models\UsuarioLegal;
use App\Library\ExpedienteTemporal;

class UsuarioLegalController extends Controller
{
    public function lista()
    {
        //
    }

    public function nuevo()
    {
        //
    }

    public function guardar(Request $request)
    {
        //
    }

    public function detalle($id)
    {
        //
    }

    public function editar($id)
    {
        //
    }

    public function actualizar(Request $request, $id)
    {
        //
    }

    public function borrar($id)
    {
        //
    }

    public function buscarArbitro()
    {
        return view('usuariolegal.arbitros');
    }

    public function buscarPersonal(Request $request)
    {

        $profesiones = DB::table('usuario_legal_profesion')->get()->all();
        $paises = DB::table('usuario_legal_pais')->get()->all();
        $perfiles = DB::table('usuario_legal_tipo')->get()->all();

        $accion = $request->input('accion');
        if (is_null($accion))
            $secretarios = UsuarioLegal::buscarPersonal($request);
        else
        {
            ExpedienteTemporal::guardarEnSesion($request);
            $secretarios = UsuarioLegal::all();
        }

        return view('usuariolegal.directorio',
            compact('profesiones',
                    'paises',
                    'perfiles',
                    'secretarios'));
    }
}
