<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesignacionController extends Controller
{
    public function lista()
    {
        return view('designacion.lista');
    }

    public function nuevo()
    {
        //
    }

    public function guardar(Request $request)
    {
        //
    }

    //public function info($id)
    public function info()
    {
        return view('designacion.info');
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
