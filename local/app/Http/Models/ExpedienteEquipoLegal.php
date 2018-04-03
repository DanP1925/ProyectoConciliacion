<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpedienteEquipoLegal extends Model {

    /**
     * Generated
     */

    protected $table = 'expediente_equipo_legal';
    protected $fillable = ['idExpedienteEquipoLegal', 'idExpediente', 'idArbitroUnico', 'idPresidenteTribunal', 'idArbitroDemandante', 'idArbitroDemandado', 'tipDesArbitroUnico', 'tipDesPresidenteTribunal', 'tipDesArbitroDemandante', 'tipDesArbitroDemandado'];


    public function tipDesArbitroUnico() {
        return $this->belongsTo(\App\Http\Models\DesignacionTipo::class, 'tipDesArbitroUnico', 'idDesignacionTipo');
    }

    public function tipDesPresidenteTribunal() {
        return $this->belongsTo(\App\Http\Models\DesignacionTipo::class, 'tipDesPresidenteTribunal', 'idDesignacionTipo');
    }

    public function tipDesArbitroDemandante() {
        return $this->belongsTo(\App\Http\Models\DesignacionTipo::class, 'tipDesArbitroDemandante', 'idDesignacionTipo');
    }

    public function tipDesArbitroDemandado() {
        return $this->belongsTo(\App\Http\Models\DesignacionTipo::class, 'tipDesArbitroDemandado', 'idDesignacionTipo');
    }

    public function expediente() {
        return $this->belongsTo(\App\Http\Models\Expediente::class, 'idExpediente', 'idExpediente');
    }

    public function arbitroUnico() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idArbitroUnico', 'idUsuarioLegal');
    }

    public function presidenteTribunal() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idPresidenteTribunal', 'idUsuarioLegal');
    }

    public function arbitroDemandante() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idArbitroDemandante', 'idUsuarioLegal');
    }

    public function arbitroDemandado() {
        return $this->belongsTo(\App\Http\Models\UsuarioLegal::class, 'idArbitroDemandado', 'idUsuarioLegal');
    }

	public static function insertarEquipo($idExpediente, Request $request){
			
		$arbitroUnico = explode(" ",$request->input('arbitroUnico'));
		$presidenteTribunal = explode(" ",$request->input('presidenteTribunal'));
		$arbitroDemandante = explode(" ",$request->input('arbitroDemandante'));
		$arbitroDemandado = explode(" ",$request->input('arbitroDemandado'));
		
		$idArbitroUnico = null;
		$tipDesArbitroUnico = null;
		if (!is_null($request->input('arbitroUnico'))){

			$lengthUnico = count($arbitroUnico);
			if ($lengthUnico >0){
				$nombreUnico = $arbitroUnico[0];
				if ($lengthUnico >1){
					$apellidoPaternoUnico = $arbitroUnico[1];
					if ($lengthUnico >2)
						$apellidoMaternoUnico = $arbitroUnico[2];
				}
			}

			if ($lengthUnico >2)
				$idArbitroUnico = DB::table('usuario_legal')
				->where([['nombre','LIKE','%'.$nombreUnico.'%'],['apellidoPaterno','LIKE','%'.$apellidoPaternoUnico.'%'],['apellidoMaterno','LIKE','%'.$apellidoMaternoUnico.'%']])->first();
			else if ($lengthUnico > 1)
				$idArbitroUnico = DB::table('usuario_legal')
				->where([['nombre','LIKE','%'.$nombreUnico.'%'],['apellidoPaterno','LIKE','%'.$apellidoPaternoUnico.'%']])->first();
			else if ($lengthUnico == 1)
				$idArbitroUnico = DB::table('usuario_legal')
				->where('nombre','LIKE', '%'.$nombreUnico.'%')->first();

			if (!is_null($idArbitroUnico))
				$idArbitroUnico = $idArbitroUnico->idUsuarioLegal;

			if (!is_null($request->input('designacionArbitroUnico')))
				$tipDesArbitroUnico = DB::table('designacion_tipo')->where('nombre','=',$request->input('designacionArbitroUnico'))->first();

			if (!is_null($tipDesArbitroUnico))
				$tipDesArbitroUnico = $tipDesArbitroUnico->idDesignacionTipo;
		}


		$idPresidenteTribunal = null;
		$tipDesPresidenteTribunal = null;
		if (!is_null($request->input('presidenteTribunal'))){

			$lengthPresidente = count($presidenteTribunal);
			if ($lengthPresidente >0){
				$nombrePresidente = $presidenteTribunal[0];
				if ($lengthPresidente >1){
					$apellidoPaternoPresidente = $presidenteTribunal[1];
					if ($lengthPresidente >2)
						$apellidoMaternoPresidente = $presidenteTribunal[2];
				}
			}

			if ($lengthPresidente > 2)
				$idPresidenteTribunal = DB::table('usuario_legal')
				->where([['nombre','LIKE','%'.$nombrePresidente.'%'],['apellidoPaterno','LIKE','%'.$apellidoPaternoPresidente.'%'],['apellidoMaterno','LIKE','%'.$apellidoMaternoPresidente.'%']])->first();
			else if ($lengthPresidente > 1)
				$idPresidenteTribunal = DB::table('usuario_legal')
				->where([['nombre','LIKE', '%'.$nombrePresidente.'%'],['apellidoPaterno','','%'.$apellidoPaternoPresidente.'%']])->first();
			else if ($lengthPresidente ==1)
				$idPresidenteTribunal = DB::table('usuario_legal')
				->where('nombre','LIKE', '%'.$nombrePresidente.'%')->first();

			if (!is_null($idPresidenteTribunal))
				$idPresidenteTribunal = $idPresidenteTribunal->idUsuarioLegal;

			if (!is_null($request->input('designacionPresidenteTribunal')))
				$tipDesPresidenteTribunal = DB::table('designacion_tipo')->where('nombre','=',$request->input('designacionPresidenteTribunal'))->first();

			if (!is_null($tipDesPresidenteTribunal))
				$tipDesPresidenteTribunal = $tipDesPresidenteTribunal->idDesignacionTipo;
		}


		$idDemandante = null;
		$tipDesArbitroDemandante = null;
		if (!is_null($request->input('arbitroDemandante'))){
			$lengthDemandante = count($arbitroDemandante);
			if ($lengthDemandante >0){
				$nombreDemandante = $arbitroDemandante[0];
				if ($lengthDemandante >1){
					$apellidoPaternoDemandante = $arbitroDemandante[1];
					if ($lengthDemandante >2)
						$apellidoMaternoDemandante = $arbitroDemandante[2];
				}
			}

			if ($lengthDemandante > 2)
				$idDemandante= DB::table('usuario_legal')
				->where([['nombre','LIKE','%'.$nombreDemandante.'%'],['apellidoPaterno','LIKE','%'.$apellidoPaternoDemandante.'%'],['apellidoMaterno','LIKE','%'.$apellidoMaternoDemandante.'%']])->first();
			else if ($lengthDemandante > 1)
				$idDemandante = DB::table('usuario_legal')
				->where([['nombre','LIKE','%'.$nombreDemandante.'%'],['apellidoPaterno','LIKE','%'.$apellidoPaternoDemandante.'%']])->first();
			else if ($lengthDemandante ==1)
				$idDemandante = DB::table('usuario_legal')
				->where('nombre','LIKE', '%'.$nombreDemandante.'%')->first();

			if (!is_null($idDemandante))
				$idDemandante = $idDemandante->idUsuarioLegal;

			if (!is_null($request->input('designacionDemandante')))
				$tipDesArbitroDemandante = DB::table('designacion_tipo')->where('nombre','=',$request->input('designacionDemandante'))->first();

			if (!is_null($tipDesArbitroDemandante))
				$tipDesArbitroDemandante = $tipDesArbitroDemandante->idDesignacionTipo;
		}


		$idDemandado = null;
		$tipDesArbitroDemandado = null;
		if (!is_null($request->input('arbitroDemandado'))){
			
			$lengthDemandado = count($arbitroDemandado);
			if ($lengthDemandado >0){
				$nombreDemandado = $arbitroDemandado[0];
				if ($lengthDemandado >1){
					$apellidoPaternoDemandado = $arbitroDemandado[1];
					if ($lengthDemandado >2)
						$apellidoMaternoDemandado = $arbitroDemandado[2];
				}
			}

			if ($lengthDemandado > 2)
				$idDemandado = DB::table('usuario_legal')
				->where([['nombre','LIKE','%'.$nombreDemandado.'%'],['apellidoPaterno','LIKE','%'.$apellidoPaternoDemandado.'%'],['apellidoMaterno','LIKE','%'.$apellidoMaternoDemandado.'%']])->first();
			else if ($lengthDemandado > 1)
				$idDemandado = DB::table('usuario_legal')
				->where([['nombre','LIKE','%'.$nombreDemandado.'%'],['apellidoPaterno','LIKE','%'.$apellidoPaternoDemandado.'%']])->first();
			else if ($lengthDemandado == 1)
				$idDemandado = DB::table('usuario_legal')
				->where('nombre','LIKE','%'.$nombreDemandado.'%')->first();

			if (!is_null($idDemandado))
				$idDemandado = $idDemandado->idUsuarioLegal;

			if (!is_null($request->input('designacionDemandado')))
				$tipDesArbitroDemandado = DB::table('designacion_tipo')->where('nombre','=',$request->input('designacionDemandado'))->first();

			if (!is_null($tipDesArbitroDemandado))
				$tipDesArbitroDemandado = $tipDesArbitroDemandado->idDesignacionTipo;
		}

		DB::table('expediente_equipo_legal')->insert(
			['idExpediente' => $idExpediente,
			'idArbitroUnico' => $idArbitroUnico,
			'idPresidenteTribunal' => $idPresidenteTribunal,
			'idArbitroDemandante' => $idDemandante,
			'idArbitroDemandado' => $idDemandado,
			'tipDesArbitroUnico' => $tipDesArbitroUnico,
			'tipDesPresidenteTribunal' => $tipDesPresidenteTribunal,
			'tipDesArbitroDemandante' => $tipDesArbitroDemandante,
			'tipDesArbitroDemandado' => $tipDesArbitroDemandado
			]
		);
	}

	public static function actualizarEquipo($idExpediente, Request $request){

		$arbitroUnico = explode(" ",$request->input('arbitroUnico'));
		$presidenteTribunal = explode(" ",$request->input('presidenteTribunal'));
		$arbitroDemandante = explode(" ",$request->input('arbitroDemandante'));
		$arbitroDemandado = explode(" ",$request->input('arbitroDemandado'));
		
		$idArbitroUnico = null;
		$tipDesArbitroUnico = null;
		if (!is_null($request->input('arbitroUnico'))){

			$lengthUnico = count($arbitroUnico);
			if ($lengthUnico >0){
				$nombreUnico = $arbitroUnico[0];
				if ($lengthUnico >1){
					$apellidoPaternoUnico = $arbitroUnico[1];
					if ($lengthUnico >2)
						$apellidoMaternoUnico = $arbitroUnico[2];
				}
			}

			if ($lengthUnico >2)
				$idArbitroUnico = DB::table('usuario_legal')
				->where([['nombre','LIKE','%'.$nombreUnico.'%'],['apellidoPaterno','LIKE','%'.$apellidoPaternoUnico.'%'],['apellidoMaterno','LIKE','%'.$apellidoMaternoUnico.'%']])->first();
			else if ($lengthUnico > 1)
				$idArbitroUnico = DB::table('usuario_legal')
				->where([['nombre','LIKE','%'.$nombreUnico.'%'],['apellidoPaterno','LIKE','%'.$apellidoPaternoUnico.'%']])->first();
			else if ($lengthUnico == 1)
				$idArbitroUnico = DB::table('usuario_legal')
				->where('nombre','LIKE', '%'.$nombreUnico.'%')->first();

			if (!is_null($idArbitroUnico))
				$idArbitroUnico = $idArbitroUnico->idUsuarioLegal;

			if (!is_null($request->input('designacionArbitroUnico')))
				$tipDesArbitroUnico = DB::table('designacion_tipo')->where('nombre','=',$request->input('designacionArbitroUnico'))->first();

			if (!is_null($tipDesArbitroUnico))
				$tipDesArbitroUnico = $tipDesArbitroUnico->idDesignacionTipo;
		}


		$idPresidenteTribunal = null;
		$tipDesPresidenteTribunal = null;
		if (!is_null($request->input('presidenteTribunal'))){

			$lengthPresidente = count($presidenteTribunal);
			if ($lengthPresidente >0){
				$nombrePresidente = $presidenteTribunal[0];
				if ($lengthPresidente >1){
					$apellidoPaternoPresidente = $presidenteTribunal[1];
					if ($lengthPresidente >2)
						$apellidoMaternoPresidente = $presidenteTribunal[2];
				}
			}

			if ($lengthPresidente > 2)
				$idPresidenteTribunal = DB::table('usuario_legal')
				->where([['nombre','LIKE','%'.$nombrePresidente.'%'],['apellidoPaterno','LIKE','%'.$apellidoPaternoPresidente.'%'],['apellidoMaterno','LIKE','%'.$apellidoMaternoPresidente.'%']])->first();
			else if ($lengthPresidente > 1)
				$idPresidenteTribunal = DB::table('usuario_legal')
				->where([['nombre','LIKE', '%'.$nombrePresidente.'%'],['apellidoPaterno','','%'.$apellidoPaternoPresidente.'%']])->first();
			else if ($lengthPresidente ==1)
				$idPresidenteTribunal = DB::table('usuario_legal')
				->where('nombre','LIKE', '%'.$nombrePresidente.'%')->first();


			if (!is_null($idPresidenteTribunal))
				$idPresidenteTribunal = $idPresidenteTribunal->idUsuarioLegal;

			if (!is_null($request->input('designacionPresidenteTribunal')))
				$tipDesPresidenteTribunal = DB::table('designacion_tipo')->where('nombre','=',$request->input('designacionPresidenteTribunal'))->first();

			if (!is_null($tipDesPresidenteTribunal))
				$tipDesPresidenteTribunal = $tipDesPresidenteTribunal->idDesignacionTipo;
		}


		$idDemandante = null;
		$tipDesArbitroDemandante = null;
		if (!is_null($request->input('arbitroDemandante'))){
			$lengthDemandante = count($arbitroDemandante);
			if ($lengthDemandante >0){
				$nombreDemandante = $arbitroDemandante[0];
				if ($lengthDemandante >1){
					$apellidoPaternoDemandante = $arbitroDemandante[1];
					if ($lengthDemandante >2)
						$apellidoMaternoDemandante = $arbitroDemandante[2];
				}
			}

			if ($lengthDemandante > 2)
				$idDemandante= DB::table('usuario_legal')
				->where([['nombre','LIKE','%'.$nombreDemandante.'%'],['apellidoPaterno','LIKE','%'.$apellidoPaternoDemandante.'%'],['apellidoMaterno','LIKE','%'.$apellidoMaternoDemandante.'%']])->first();
			else if ($lengthDemandante > 1)
				$idDemandante = DB::table('usuario_legal')
				->where([['nombre','LIKE','%'.$nombreDemandante.'%'],['apellidoPaterno','LIKE','%'.$apellidoPaternoDemandante.'%']])->first();
			else if ($lengthDemandante ==1)
				$idDemandante = DB::table('usuario_legal')
				->where('nombre','LIKE', '%'.$nombreDemandante.'%')->first();

			if (!is_null($idDemandante))
				$idDemandante = $idDemandante->idUsuarioLegal;

			if (!is_null($request->input('designacionDemandante')))
				$tipDesArbitroDemandante = DB::table('designacion_tipo')->where('nombre','=',$request->input('designacionDemandante'))->first();

			if (!is_null($tipDesArbitroDemandante))
				$tipDesArbitroDemandante = $tipDesArbitroDemandante->idDesignacionTipo;
		}


		$idDemandado = null;
		$tipDesArbitroDemandado = null;
		if (!is_null($request->input('arbitroDemandado'))){
			
			$lengthDemandado = count($arbitroDemandado);
			if ($lengthDemandado >0){
				$nombreDemandado = $arbitroDemandado[0];
				if ($lengthDemandado >1){
					$apellidoPaternoDemandado = $arbitroDemandado[1];
					if ($lengthDemandado >2)
						$apellidoMaternoDemandado = $arbitroDemandado[2];
				}
			}

			if ($lengthDemandado > 2)
				$idDemandado = DB::table('usuario_legal')
				->where([['nombre','LIKE','%'.$nombreDemandado.'%'],['apellidoPaterno','LIKE','%'.$apellidoPaternoDemandado.'%'],['apellidoMaterno','LIKE','%'.$apellidoMaternoDemandado.'%']])->first();
			else if ($lengthDemandado > 1)
				$idDemandado = DB::table('usuario_legal')
				->where([['nombre','LIKE','%'.$nombreDemandado.'%'],['apellidoPaterno','LIKE','%'.$apellidoPaternoDemandado.'%']])->first();
			else if ($lengthDemandado == 1)
				$idDemandado = DB::table('usuario_legal')
				->where('nombre','LIKE','%'.$nombreDemandado.'%')->first();

			if (!is_null($idDemandado))
				$idDemandado = $idDemandado->idUsuarioLegal;

			if (!is_null($request->input('designacionDemandado')))
				$tipDesArbitroDemandado = DB::table('designacion_tipo')->where('nombre','=',$request->input('designacionDemandado'))->first();

			if (!is_null($tipDesArbitroDemandado))
				$tipDesArbitroDemandado = $tipDesArbitroDemandado->idDesignacionTipo;
		}

		DB::table('expediente_equipo_legal')->where('idExpediente',$idExpediente)->update
			(['idArbitroUnico' => $idArbitroUnico,
			'idPresidenteTribunal' => $idPresidenteTribunal,
			'idArbitroDemandante' => $idDemandante,
			'idArbitroDemandado' => $idDemandado,
			'tipDesArbitroUnico' => $tipDesArbitroUnico,
			'tipDesPresidenteTribunal' => $tipDesPresidenteTribunal,
			'tipDesArbitroDemandante' => $tipDesArbitroDemandante,
			'tipDesArbitroDemandado' => $tipDesArbitroDemandado
			]
		);
	}

}
