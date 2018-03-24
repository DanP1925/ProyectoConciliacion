<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaudoRecursoPresentado extends Model {

    /**
     * Generated
     */

    protected $table = 'laudo_recurso_presentado';
    protected $fillable = ['idLaudoRecursoPresentado', 'idExpediente', 'idLaudoRecurso', 'idLaudorecursoResultado', 'fechaPresentacion', 'fechaResultado'];


    public function expediente() {
        return $this->belongsTo(\App\Http\Models\Expediente::class, 'idExpediente', 'idExpediente');
    }

    public function laudoEstado() {
        return $this->belongsTo(\App\Http\Models\LaudoRecurso::class, 'idLaudoRecurso', 'idLaudoRecurso');
    }

    public function laudoResultado() {
        return $this->belongsTo(\App\Http\Models\LaudoRecursoResultado::class, 'idLaudoRecursoResultado', 'idLaudoRecursoResultado');
    }

	public static function insertarRecursos($idExpediente, Request $request){

		$recursosPresentados = $request->input('recursoPresentado');
		$fechasPresentacion = $request->input('fechaPresentacion');
		$resultadosRecursosPresentado = $request->input('resultadoRecursoPresentado');
		$fechasResultado = $request->input('fechaResultado');

		$length = count($recursosPresentados);
		for($i=0;$i<$length;$i++){
			DB::table('laudo_recurso_presentado')->insert(
				['idExpediente' => $idExpediente,
				'idLaudoRecurso' => $recursosPresentados[$i],
				'idLaudoRecursoResultado' => $resultadosRecursosPresentado[$i],
				'fechaPresentacion' => $fechasPresentacion[$i],
				'fechaResultado' => $fechasResultado[$i]]
			);
		}
	}

	public static function actualizarRecursos($idExpediente, Request $request){

		DB::table('laudo_recurso_presentado')->where('idExpediente',$idExpediente)->delete();

		$recursosPresentados = $request->input('recursoPresentado');
		$fechasPresentacion = $request->input('fechaPresentacion');
		$resultadosRecursosPresentado = $request->input('resultadoRecursoPresentado');
		$fechasResultado = $request->input('fechaResultado');

		$length = count($recursosPresentados);
		for($i=0;$i<$length;$i++){
			DB::table('laudo_recurso_presentado')->insert(
				['idExpediente' => $idExpediente,
				'idLaudoRecurso' => $recursosPresentados[$i],
				'idLaudoRecursoResultado' => $resultadosRecursosPresentado[$i],
				'fechaPresentacion' => $fechasPresentacion[$i],
				'fechaResultado' => $fechasResultado[$i]]
			);
		}
	}
}
