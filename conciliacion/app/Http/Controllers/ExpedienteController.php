<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function lista()
    {
        return view('expediente.lista');
    }

    public function nuevo()
    {
        return view('expediente.nuevo');
    }

    public function info()
    {
        return view('expediente.info');
    }

    public function editar()
    {
        return view('expediente.editar');
    }
}
