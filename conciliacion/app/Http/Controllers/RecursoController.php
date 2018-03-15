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
        ExpedienteTemporal::guardarEnSesion($request);

		return view('recurso.nuevo',
			compact('recursosPresentados',
					'resultadoRecursos',
					'accion'));
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
		$id = $accion[1];

		$nuevoRecurso = RecursoTemporal::withData($recursos[$id],$fechasPresentacion[$id],
			$resultadosRecursosPresentado[$id],$fechasResultado[$id]);

        $accion = $request->input('accion');
        ExpedienteTemporal::guardarEnSesion($request);
		return view('recurso.editar',
			compact('recursosPresentados',
					'resultadoRecursos',
					'accion',
					'nuevoRecurso'));
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
