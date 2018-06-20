<?php 

namespace App\Library;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecursoTemporal {

    var $recursoPresentado;
    var $fechaPresentacion;
	var $recursoAFavor;
    var $resultadoRecursoPresentado;
    var $fechaResultado;

    function __construct()
	{
	}

	public static function withRequest(Request $request)
	{
		$instance = new self();
        $instance->recursoPresentado = $request->input('recursoPresentado');
        $instance->fechaPresentacion = $request->input('fechaPresentacion');
		$instance->recursoAFavor = $request->input('recursoAFavor');
        $instance->resultadoRecursoPresentado= $request->input('resultadoRecursoPresentado');
        $instance->fechaResultado= $request->input('fechaResultado');
		return $instance;
	}

	public static function withData($recursoPresentado,$fechaPresentacion,$recursoAFavor,$resultadoRecursoPresentado,$fechaResultado)
	{
		$instance = new self();
        $instance->recursoPresentado= $recursoPresentado;
        $instance->fechaPresentacion= $fechaPresentacion;
		$instance->recursoAFavor = $recursoAFavor;
        $instance->resultadoRecursoPresentado= $resultadoRecursoPresentado;
        $instance->fechaResultado= $fechaResultado;
		return $instance;
	}	

	public function getNombreRecurso()
	{
		return DB::table('laudo_recurso')->where('idLaudoRecurso',$this->recursoPresentado)->first()->nombre;
	}

	public function getNombreResultado()
	{
		return DB::table('laudo_recurso_resultado')->where('idLaudoRecursoResultado',$this->resultadoRecursoPresentado)->first()->nombre;
	}

	public function getNombreRecursoAFavor()
	{
		return DB::table('laudo_a_favor')->where('idLaudoAFavor',$this->recursoAFavor)->first()->nombre;
	}
}
