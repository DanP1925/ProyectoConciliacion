<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Region;
use App\Library\ExpedienteTemporal;

class RegionController extends Controller
{
	public function buscarRegion(Request $request)
	{
        $accion = $request->input('accion');
        $regiones = Region::buscarRegion($request); 
        ExpedienteTemporal::guardarEnSesion($request);

		return view('region.directorio',
			compact('regiones',
					'accion'));
	}

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
}
