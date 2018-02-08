<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Expediente;
use App\Http\Models\UsuarioLegal;

class PersonaNaturalController extends Controller
{
    public function lista()
    {
        return view('personaNatural.lista');
    }

    public function nuevo()
    {
        return view('personaNatural.nuevo');
    }

    public function guardar(Request $request)
    {
        //
    }

    public function info($id)
    {
        return view('personaNatural.info');
    }

    public function editar($id)
    {
        return view('personaNatural.editar');
    }

    public function actualizar(Request $request, $id)
    {
        //
    }

    public function destruir($id)
    {
        //
    }

    public function buscarPersonal(Request $request)
    {
        $expediente = new Expediente($request);
        $usuariosLegales = UsuarioLegal::all(getNombreDelTipo()); 
        $personal = [];


        dd($usuariosLegales[0]->getNombreDelTipo());

        return view('personal.buscar',compact('expediente'));
    }

    public function buscarParteLegal()
    {
    }
}
