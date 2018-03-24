<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\ExpedienteTemporal;
use App\Library\RecursoTemporal;
use Illuminate\Support\Facades\DB;

class RecursoController extends Controller
{
    public function lista()
    {
        //
    }

    public function nuevo(Request $request)
    {
		$recursosPresentados = DB::table('laudo_recurso')->get()->all();
		$resultadoRecursos = DB::table('laudo_recurso_resultado')->get()->all();

        $accion = $request->input('accion');
		$tipoAccion = (explode(" ",$accion))[0];
		$id = 0;
		if ($tipoAccion == "agregarRecursoId")
			$id = (explode(" ",$accion))[1];

        ExpedienteTemporal::guardarEnSesion($request);

		return view('recurso.nuevo',
			compact('recursosPresentados',
					'resultadoRecursos',
					'accion',
					'tipoAccion',
					'id'));
    }

    public function editar(Request $request)
    {
		$recursosPresentados = DB::table('laudo_recurso')->get()->all();
		$resultadoRecursos = DB::table('laudo_recurso_resultado')->get()->all();

		$recursos = $request->input('recursoPresentado');
		$fechasPresentacion = $request->input('fechaPresentacion');
		$resultadosRecursosPresentado = $request->input('resultadoRecursoPresentado');
		$fechasResultado = $request->input('fechaResultado');

		$accion = explode(" ",$request->input('accion'));
		$tipoAccion = $accion[0];
		$id = 0;
		if ($tipoAccion == "editarRecursoId"){
			$id = $accion[1];
			$idRecurso = $accion[2];
		} else
			$idRecurso = $accion[1];

		$nuevoRecurso = RecursoTemporal::withData($recursos[$idRecurso],$fechasPresentacion[$idRecurso],
			$resultadosRecursosPresentado[$idRecurso],$fechasResultado[$idRecurso]);

        $accion = $request->input('accion');
        ExpedienteTemporal::guardarEnSesion($request);
		return view('recurso.editar',
			compact('recursosPresentados',
					'resultadoRecursos',
					'accion',
					'nuevoRecurso',
					'tipoAccion',
					'id'));
    }

    public function guardar(Request $request)
    {
        //
    }

    public function detalle($id)
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
