<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PropuestaController extends Controller
{
    public function lista()
    {
        return view('propuesta.lista');
    }

    public function nuevo()
    {
        return view('propuesta.nuevo');
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
}
