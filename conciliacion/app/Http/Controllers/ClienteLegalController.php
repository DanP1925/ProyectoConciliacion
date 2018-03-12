<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\ExpedienteClienteLegal;
use App\Library\ExpedienteTemporal;

class ClienteLegalController extends Controller
{
    public function buscarCliente(Request $request)
    {
        $accion = $request->input('accion');
        $clientes = ExpedienteClienteLegal::buscarCliente($request); 
        ExpedienteTemporal::guardarEnSesion($request);

        return view('clientelegal.directorio',
			compact('clientes',
					'accion'));
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
