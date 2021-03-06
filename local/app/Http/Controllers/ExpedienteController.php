<?php

namespace App\Http\Controllers;

use App\Http\Models\ArbitrajeMontoContrato;
use App\Http\Models\ArbitrajeOrigen;
use App\Http\Models\CuantiaEscalaPago;
use App\Http\Models\CuantiaTipo;
use App\Http\Models\DesignacionTipo;
use App\Http\Models\ExpedienteEstado;
use App\Http\Models\ExpedienteSubtipoCaso;
use App\Http\Models\ExpedienteTipoCaso;
use App\Http\Models\ExpedienteClienteLegal;
use App\Http\Models\Incidente;
use App\Http\Models\LaudoAFavor;
use App\Http\Models\LaudoEjecucion;
use App\Http\Models\LaudoResultado;
use App\Http\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Library\ExpedienteTemporal;
use App\Library\RecursoTemporal;
use App\Library\FiltroExpediente;
use App\Library\FiltroUsuarioLegal;
use App\Library\FiltroClienteLegal;
use App\Library\FiltroRegion;
use App\Http\Models\Expediente;
use App\Http\Models\RegionControversia;
use App\Http\Models\ExpedienteEquipoLegal;
use App\Http\Models\LaudoRecursoPresentado;
use App\Http\Models\UsuarioLegal;

class ExpedienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function lista(Request $request)
    {
		FiltroExpediente::guardarEnSesion($request);
		$filtroExpediente = new FiltroExpediente($request);

        list($estadosExpediente,$tipos,$subtipos) = $this->prepararVistaLista();

		$expedientes = Expediente::buscarExpediente($request);

		return view('expediente.lista', compact('estadosExpediente',
					'tipos', 'subtipos', 'expedientes', 'filtroExpediente' ));
    }

    public function nuevo(Request $request)
    {
		$request->session()->forget('accion');

		if (count($request->request) == 0)
			ExpedienteTemporal::quitarDeSesion($request);
        $expedienteTemporal = ExpedienteTemporal::withRequest($request);

		$expedienteTemporal = $this->ejecutarAccion($request, $expedienteTemporal);

		list($estadosExpediente,$tipos,$subtipos,$tiposCuantia,$escalasDePago,
			$origenesArbitraje,$montosContrato,$resultadosLaudo,
			$ejecucionesLaudo,$favorLaudo,$tiposDesignacion,$listaExpedientes) = $this->prepararVistaExpediente(); 

        return view('expediente.nuevo',
            compact('estadosExpediente', 'tipos', 'subtipos', 'tiposCuantia',
                    'escalasDePago', 'expedienteTemporal', 'origenesArbitraje',
					'montosContrato', 'resultadosLaudo', 'ejecucionesLaudo',
					'favorLaudo','tiposDesignacion','listaExpedientes'));
    }

	public function info(Request $request, $id)
	{
		$request->session()->forget('accion');

		if (count($request->request) == 0)
			$expedienteTemporal = ExpedienteTemporal::withId($id);
		else{
			$expedienteTemporal = ExpedienteTemporal::withRequest($request);
			$expedienteTemporal = $this->ejecutarAccion($request, $expedienteTemporal);
		}

        ExpedienteTemporal::quitarDeSesion($request);

		list($estadosExpediente,$tipos,$subtipos,$tiposCuantia,$escalasDePago,
			$origenesArbitraje,$montosContrato,$resultadosLaudo,
			$ejecucionesLaudo,$favorLaudo, $tiposDesignacion,$listaExpedientes) = $this->prepararVistaExpediente(); 
		$expediente = Expediente::where('idExpediente',$id)->first();
		$numeroId = $expediente->numero;

		return view('expediente.info',
			compact('expedienteTemporal',
					'estadosExpediente','tipos','subtipos','tiposCuantia',
					'escalasDePago','origenesArbitraje','montosContrato',
					'resultadosLaudo','ejecucionesLaudo','favorLaudo', 
					'tiposDesignacion', 'id', 'numeroId','listaExpedientes'));
	}

	public function ejecutarAccion(Request $request, $expedienteTemporal){
        if (!is_null($request->input('accion'))){
            $accion = explode(" ",$request->input('accion'));
            $tipoAccion = $accion[0];

			if (substr($tipoAccion,-2) != "Id"){
				if ($tipoAccion != "agregarRecurso")
					$resultadoAccion = $accion[1];
			} else{
				if ($tipoAccion != "agregarRecursoId")
					$resultadoAccion = $accion[2];
			}
            
            if ($tipoAccion == "buscarSecretario" || $tipoAccion == "buscarSecretarioId")
                $expedienteTemporal->agregarSecretario($resultadoAccion);
            else if ($tipoAccion == "buscarLider" || $tipoAccion == "buscarLiderId")
                $expedienteTemporal->agregarSecretarioLider($resultadoAccion);
			else if ($tipoAccion == "buscarDemandante" || $tipoAccion == "buscarDemandanteId")
				$expedienteTemporal->agregarDemandante($resultadoAccion);
			else if ($tipoAccion == "buscarDemandado" || $tipoAccion == "buscarDemandadoId")
				$expedienteTemporal->agregarDemandado($resultadoAccion);
			else if ($tipoAccion == "buscarRegion" || $tipoAccion == "buscarRegionId")
				$expedienteTemporal->agregarRegion($resultadoAccion);
			else if ($tipoAccion == "agregarRecurso" || $tipoAccion == "agregarRecursoId")
				$expedienteTemporal->agregarRecurso($request);
			else if ($tipoAccion == "editarRecurso" || $tipoAccion == "editarRecursoId")
				$expedienteTemporal->editarRecurso($resultadoAccion, $request);
			else if ($tipoAccion == "buscarUnico" || $tipoAccion == "buscarUnicoId")
				$expedienteTemporal->agregarArbitroUnico($resultadoAccion);
			else if ($tipoAccion == "buscarPresidente" || $tipoAccion == "buscarPresidenteId")
				$expedienteTemporal->agregarPresidenteTribunal($resultadoAccion);
			else if ($tipoAccion == "buscarArbitroDemandante" || $tipoAccion == "buscarArbitroDemandanteId")
				$expedienteTemporal->agregarArbitroDemandante($resultadoAccion);
			else if ($tipoAccion == "buscarArbitroDemandado" || $tipoAccion == "buscarArbitroDemandadoId")
				$expedienteTemporal->agregarArbitroDemandado($resultadoAccion);
        }

		return $expedienteTemporal;
	}

    public function editar(Request $request)
    {
        return view('expediente.editar');
    }

    public function guardar(Request $request)
    {
		if ($request->input('accionRegistrar') == 'nuevoExpediente'){
			$idExpediente = Expediente::insertarExpediente($request);
			RegionControversia::insertarRegiones($idExpediente, $request);
			ExpedienteEquipoLegal::insertarEquipo($idExpediente, $request);
			LaudoRecursoPresentado::insertarRecursos($idExpediente, $request);
		} else {
			$tempAccionRegistrar = explode(" ",$request->input('accionRegistrar'));
			$idExpediente = $tempAccionRegistrar[1];
			Expediente::actualizarExpediente($idExpediente, $request);
			RegionControversia::actualizarRegiones($idExpediente, $request);
			ExpedienteEquipoLegal::actualizarEquipo($idExpediente, $request);
			LaudoRecursoPresentado::actualizarRecursos($idExpediente, $request);
		}
			
		return redirect()->action('ExpedienteController@lista');
    }

	public function borrar(Request $request, $idExpediente){
		LaudoRecursoPresentado::eliminarRecursos($idExpediente);
		ExpedienteEquipoLegal::eliminarEquipo($idExpediente);
		RegionControversia::eliminarRegiones($idExpediente);
		Incidente::eliminarIncidentes($idExpediente);
		ExpedienteDesignacion::eliminarDesignacion($idExpediente);
		$designaciones = DB::table('expediente_designacion')->where('idExpediente',$idExpediente);
		foreach($designaciones->get()->all() as $designacion){
			DB::table('expediente_designacion_propuesta')->where('idExpedienteDesignacion',$designacion->idExpedienteDesignacion)->delete();
		}
		$designaciones->delete();
		Expediente::eliminarExpediente($idExpediente);
		
		return redirect()->action('ExpedienteController@lista');
	}

	public function prepararVistaExpediente(){
        $estadosExpediente = DB::table('expediente_estado')->get()->all();
        $tipos = DB::table('expediente_tipo_caso')->get()->all();
        $subtipos = DB::table('expediente_subtipo_caso')->get()->all();
        $tiposCuantia = DB::table('cuantia_tipo')->get()->all();
        $escalasDePago  = DB::table('cuantia_escala_pago')->get()->all();
		$origenesArbitraje = DB::table('arbitraje_origen')->get()->all();
		$montosContrato = DB::table('arbitraje_monto_contrato')->get()->all();
		$resultadosLaudo = DB::table('laudo_resultado')->get()->all();
		$ejecucionesLaudo = DB::table('laudo_ejecucion')->get()->all();
		$favorLaudo = DB::table('laudo_a_favor')->get()->all();
		$designacionTipo = DB::table('designacion_tipo')->get()->all();

		$numerosExpediente = DB::table('expediente')->select('numero')->get()->all();
		$listaNumeros = [];
		foreach($numerosExpediente as $numeroExpediente)
			array_push($listaNumeros,$numeroExpediente->numero);

		return array($estadosExpediente,$tipos,$subtipos,$tiposCuantia,$escalasDePago,
			$origenesArbitraje,$montosContrato,$resultadosLaudo,
			$ejecucionesLaudo,$favorLaudo,$designacionTipo,$listaNumeros);
	}

	public function prepararVistaLista(){
		$estadosExpediente = DB::table('expediente_estado')->get()->all();
        $tipos = DB::table('expediente_tipo_caso')->get()->all();
        $subtipos = DB::table('expediente_subtipo_caso')->get()->all();
		return array($estadosExpediente,$tipos,$subtipos);
	}

    public function buscarPersonal(Request $request)
    {
		if (count($request->request)!= 1)
			FiltroUsuarioLegal::guardarEnSesion($request);
		$filtroUsuarioLegal = new FiltroUsuarioLegal($request);

        $profesiones = DB::table('usuario_legal_profesion')->get()->all();
        $paises = DB::table('usuario_legal_pais')->get()->all();
        $perfiles = DB::table('usuario_legal_tipo')->get()->all();

		list($accion,$tipoAccion,$id) = 
			$this->separarAccion($request, ["buscarSecretarioId","buscarLiderId",
				"buscarUnicoId","buscarPresidenteId",
				"buscarArbitroDemandanteId","buscarArbitroDemandadoId"]);
		
        $secretarios = UsuarioLegal::buscarPersonal($request);
        ExpedienteTemporal::guardarEnSesion($request);

        return view('expediente.usuariolegal.directorio',
            compact('profesiones', 'paises', 'perfiles', 'secretarios',
					'accion', 'tipoAccion', 'id','filtroUsuarioLegal'));
    }


	public function buscarCliente(Request $request)
	{
		if (count($request->request)!= 1)
			FiltroClienteLegal::guardarEnSesion($request);
		$filtroClienteLegal = new FiltroClienteLegal($request);

		list($accion,$tipoAccion,$id) = 
			$this->separarAccion($request, ["buscarDemandanteId","buscarDemandadoId"]);

		$clientes = ExpedienteClienteLegal::buscarCliente($request); 
		ExpedienteTemporal::guardarEnSesion($request);

		return view('expediente.clientelegal.directorio',
			compact('clientes', 'accion', 'tipoAccion', 'id', 'filtroClienteLegal'));
	}

	public function buscarRegion(Request $request)
	{
		if (count($request->request)!= 1)
			FiltroRegion::guardarEnSesion($request);
		$filtroRegion = new FiltroRegion($request);

		list($accion,$tipoAccion,$id) =	$this->separarAccion($request, ["buscarRegionId"]);

        $regiones = Region::buscarRegion($request); 
        ExpedienteTemporal::guardarEnSesion($request);

		return view('expediente.region.directorio',
			compact('regiones', 'accion', 'tipoAccion', 'id', 'filtroRegion'));
	}

    public function nuevoRecurso(Request $request)
    {
		$recursosPresentados = DB::table('laudo_recurso')->get()->all();
		$resultadoRecursos = DB::table('laudo_recurso_resultado')->get()->all();
		$aFavor = DB::table('laudo_a_favor')->get()->all();

		list($accion,$tipoAccion,$id) =	$this->separarAccion($request, ["agregarRecursoId"]);

        ExpedienteTemporal::guardarEnSesion($request);

		return view('expediente.recurso.nuevo',
			compact('recursosPresentados', 'resultadoRecursos', 'aFavor',
			'accion','tipoAccion', 'id'));
    }

	public function separarAccion($request, $tiposValidos){
		if (is_null($request->session()->get('accion'))){
			$accion = $request->input('accion');
			$request->session()->put('accion',$accion);
		} else
			$accion = $request->session()->get('accion');

		$tempAccion = explode(" ",$accion);
		$tipoAccion = $tempAccion[0];
		$id = 0;

		foreach($tiposValidos as $tipo){
			if ($tipoAccion == $tipo)
				$id = $tempAccion[1];
		}

		return array($accion,$tipoAccion,$id);
	}

    public function editarRecurso(Request $request)
    {
		$recursosPresentados = DB::table('laudo_recurso')->get()->all();
		$resultadoRecursos = DB::table('laudo_recurso_resultado')->get()->all();
		$aFavor = DB::table('laudo_a_favor')->get()->all();

		$idRecursos = $request->input('idRecurso');
		$recursos = $request->input('recursoPresentado');
		$fechasPresentacion = $request->input('fechaPresentacion');
		$recursosAFavor = $request->input('recursoAFavor');
		$resultadosRecursosPresentado = $request->input('resultadoRecursoPresentado');
		$fechasResultado = $request->input('fechaResultado');

		$accion = explode(" ",$request->input('accion'));
		$tipoAccion = $accion[0];
		$id = 0;

		if ($tipoAccion == "editarRecursoId"){
			$id = $accion[1];
			$idRecurso = $accion[2]+1;
		} else
			$idRecurso = $accion[1]+1;

		$indice = 0;
		foreach($idRecursos as $indexRecurso){
			if ($indexRecurso == $idRecurso)
				break;
			$indice++;
		}

		$nuevoRecurso = RecursoTemporal::withData($recursos[$indice],$fechasPresentacion[$indice], $recursosAFavor[$indice] ,$resultadosRecursosPresentado[$indice],$fechasResultado[$indice]);

		$previaAccion = explode(" ",$request->input('accion'));
		if ($tipoAccion == "editarRecursoId"){
			$accion = $previaAccion[0].' '.$previaAccion[1].' '.$indice;
		} else {
			$accion = $previaAccion[0].' '.$indice;
		} 

        ExpedienteTemporal::guardarEnSesion($request);
		return view('expediente.recurso.editar',
			compact('recursosPresentados', 'resultadoRecursos', 'aFavor',
		   	'accion','nuevoRecurso', 'tipoAccion', 'id'));
    }

}
