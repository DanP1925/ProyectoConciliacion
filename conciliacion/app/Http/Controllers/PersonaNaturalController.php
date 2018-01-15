<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Expediente;

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

    public function buscarPersonal()
    {
        $expediente = new Expediente;

        dd($expediente.helloLife());
    }

    public function buscarParteLegal()
    {
    }
}
