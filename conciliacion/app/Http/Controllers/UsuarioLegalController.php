<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function buscarPersonal()
    {
        $profesiones = DB::table('usuario_legal_profesion')->get()->all();

        return view('usuariolegal.directorio',
            compact('profesiones'));
    }
}
