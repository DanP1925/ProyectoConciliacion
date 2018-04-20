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

			$idArbitroUnico = ExpedienteEquipoLegal::obtenerId($arbitroUnico);

			if (!is_null($request->input('designacionArbitroUnico')))
				$tipDesArbitroUnico = $request->input('designacionArbitroUnico');
		}


		$idPresidenteTribunal = null;
		$tipDesPresidenteTribunal = null;
		if (!is_null($request->input('presidenteTribunal'))){

			$idPresidenteTribunal = ExpedienteEquipoLegal::obtenerId($presidenteTribunal);

			if (!is_null($request->input('designacionPresidenteTribunal')))
				$tipDesPresidenteTribunal = $request->input('designacionPresidenteTribunal');
		}


		$idDemandante = null;
		$tipDesArbitroDemandante = null;
		if (!is_null($request->input('arbitroDemandante'))){

			$idDemandante = ExpedienteEquipoLegal::obtenerId($arbitroDemandado);

			if (!is_null($request->input('designacionDemandante')))
				$tipDesArbitroDemandante = $request->input('designacionDemandante');
		}


		$idDemandado = null;
		$tipDesArbitroDemandado = null;
		if (!is_null($request->input('arbitroDemandado'))){
			
			$idDemandado = ExpedienteEquipoLegal::obtenerId($arbitroDemandado);

			if (!is_null($request->input('designacionDemandado')))
				$tipDesArbitroDemandado = $request->input('designacionDemandado');
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

	public static function separaNombres($listaNombre){

		$nombre = null;
		$apellidoPaterno = null;
		$apellidoMaterno = null;

		$tamanho = count($listaNombre);
		if ($tamanho >0){
			$apellidoPaterno = $listaNombre[0];
			if ($tamanho >1){
				$apellidoMaterno = $listaNombre[1];
				if ($tamanho >2)
					$nombre = $listaNombre[2];
			}
		}

		return array($nombre,$apellidoPaterno,$apellidoMaterno, $tamanho);
	}

	public static function obtenerId($listaNombre){

		list($nombre,$apellidoPaterno,$apellidoMaterno,$length) =
			ExpedienteEquipoLegal::separaNombres($listaNombre);

		$usuario = UsuarioLegal::getUsandoNombreYApellidos($nombre,$apellidoPaterno,$apellidoMaterno,$length);

		if (!is_null($usuario))
			$id = $usuario->idUsuarioLegal;
		else{
			//Si no Existe el Arbitro Unico
			$id = DB::table('usuario_legal')->insertGetId(
				['idUsuarioLegalTipo' => '1',
				'idUsuarioLegalProfesion' => '1',
				'idUsuarioLegalPais' => '1',
				'nombre' => $nombre,
				'apellidoPaterno' => $apellidoPaterno,
				'apellidoMaterno' => $apellidoMaterno,
				'flagValidado' => 'N']
			);
		}

		return $id;
	}

	public static function actualizarEquipo($idExpediente, Request $request){

		$arbitroUnico = explode(" ",$request->input('arbitroUnico'));
		$presidenteTribunal = explode(" ",$request->input('presidenteTribunal'));
		$arbitroDemandante = explode(" ",$request->input('arbitroDemandante'));
		$arbitroDemandado = explode(" ",$request->input('arbitroDemandado'));
		
		$idArbitroUnico = null;
		$tipDesArbitroUnico = null;
		if (!is_null($request->input('arbitroUnico'))){

			$idArbitroUnico = ExpedienteEquipoLegal::obtenerId($arbitroUnico);

			if (!is_null($request->input('designacionArbitroUnico')))
				$tipDesArbitroUnico = $request->input('designacionArbitroUnico');
		}


		$idPresidenteTribunal = null;
		$tipDesPresidenteTribunal = null;
		if (!is_null($request->input('presidenteTribunal'))){

			$idPresidenteTribunal = ExpedienteEquipoLegal::obtenerId($presidenteTribunal);

			if (!is_null($request->input('designacionPresidenteTribunal')))
				$tipDesPresidenteTribunal = $request->input('designacionPresidenteTribunal');
		}


		$idDemandante = null;
		$tipDesArbitroDemandante = null;
		if (!is_null($request->input('arbitroDemandante'))){

			$idDemandante = ExpedienteEquipoLegal::obtenerId($arbitroDemandado);

			if (!is_null($request->input('designacionDemandante')))
				$tipDesArbitroDemandante = $request->input('designacionDemandante');
		}


		$idDemandado = null;
		$tipDesArbitroDemandado = null;
		if (!is_null($request->input('arbitroDemandado'))){
			
			$idDemandado = ExpedienteEquipoLegal::obtenerId($arbitroDemandado);

			if (!is_null($request->input('designacionDemandado')))
				$tipDesArbitroDemandado = $request->input('designacionDemandado');
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

	public static function eliminarEquipo($idExpediente){
		DB::table('expediente_equipo_legal')->where('idExpediente',$idExpediente)->delete();
	}
}
