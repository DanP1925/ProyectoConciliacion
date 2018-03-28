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
use App\Http\Models\LaudoAFavor;
use App\Http\Models\LaudoEjecucion;
use App\Http\Models\LaudoResultado;
use App\Http\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Library\ExpedienteTemporal;
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
        $estadosExpediente = DB::table('expediente_estado')->get()->all();
        $tipos = DB::table('expediente_tipo_caso')->get()->all();
        $subtipos = DB::table('expediente_subtipo_caso')->get()->all();

		$expedientes = Expediente::buscarExpediente($request);

		return view('expediente.lista', compact('estadosExpediente',
					'tipos', 'subtipos', 'expedientes' ));
    }

    public function nuevo(Request $request)
    {
        $expedienteTemporal = ExpedienteTemporal::withRequest($request);
        ExpedienteTemporal::quitarDeSesion($request);

        if (!is_null($request->input('accion'))){
            $accion = explode(" ",$request->input('accion'));
            $tipoAccion = $accion[0];
			if ($tipoAccion != "agregarRecurso")
				$resultadoAccion = $accion[1];
            
            if ($tipoAccion == "buscarSecretario")
                $expedienteTemporal->agregarSecretario($resultadoAccion);
            else if ($tipoAccion == "buscarLider")
                $expedienteTemporal->agregarSecretarioLider($resultadoAccion);
			else if ($tipoAccion == "buscarDemandante")
				$expedienteTemporal->agregarDemandante($resultadoAccion);
			else if ($tipoAccion == "buscarDemandado")
				$expedienteTemporal->agregarDemandado($resultadoAccion);
			else if ($tipoAccion == "buscarRegion")
				$expedienteTemporal->agregarRegion($resultadoAccion);
			else if ($tipoAccion == "agregarRecurso")
				$expedienteTemporal->agregarRecurso($request);
			else if ($tipoAccion == "editarRecurso")
				$expedienteTemporal->editarRecurso($resultadoAccion, $request);
        }

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

        return view('expediente.nuevo',
            compact('estadosExpediente',
                    'tipos',
                    'subtipos',
                    'tiposCuantia',
                    'escalasDePago',
					'expedienteTemporal',
					'origenesArbitraje',
					'montosContrato',
					'resultadosLaudo',
					'ejecucionesLaudo',
					'favorLaudo'));
    }

    public function info($id)
    {
        $estadosExpediente = DB::table('expediente_estado')->get()->all();
        $tipos = DB::table('expediente_tipo_caso')->get()->all();
        $subtipos = DB::table('expediente_subtipo_caso')->get()->all();
        $tiposCuantia = DB::table('cuantia_tipo')->get()->all();
        $escalasDePago  = DB::table('cuantia_escala_pago')->get()->all();
		$origenesArbitraje = DB::table('arbitraje_origen')->get()->all();
		$montosContrato = DB::table('arbitraje_monto_contrato')->get()->all();
		$resultadosLaudo = DB::table('laudo_resultado')->get()->all();
        $expedienteTemporal = ExpedienteTemporal::withId($id);
		$ejecucionesLaudo = DB::table('laudo_ejecucion')->get()->all();
		$favorLaudo = DB::table('laudo_a_favor')->get()->all();
		return view('expediente.info',
			compact('expedienteTemporal',
					'estadosExpediente','tipos','subtipos','tiposCuantia',
					'escalasDePago','origenesArbitraje','montosContrato',
					'resultadosLaudo','ejecucionesLaudo','favorLaudo', 'id'));
    }

	public function infoActualizado(Request $request, $id)
	{
        $expedienteTemporal = ExpedienteTemporal::withRequest($request);
        ExpedienteTemporal::quitarDeSesion($request);

        if (!is_null($request->input('accion'))){
            $accion = explode(" ",$request->input('accion'));
            $tipoAccion = $accion[0];

			if ($tipoAccion != "agregarRecursoId")
				$resultadoAccion = $accion[2];

            if ($tipoAccion == "buscarSecretarioId")
                $expedienteTemporal->agregarSecretario($resultadoAccion);
            else if ($tipoAccion == "buscarLiderId")
                $expedienteTemporal->agregarSecretarioLider($resultadoAccion);
			else if ($tipoAccion == "buscarDemandanteId")
				$expedienteTemporal->agregarDemandante($resultadoAccion);
			else if ($tipoAccion == "buscarDemandadoId")
				$expedienteTemporal->agregarDemandado($resultadoAccion);
			else if ($tipoAccion == "buscarRegionId")
				$expedienteTemporal->agregarRegion($resultadoAccion);
			else if ($tipoAccion == "agregarRecursoId")
				$expedienteTemporal->agregarRecurso($request);
			else if ($tipoAccion == "editarRecursoId")
				$expedienteTemporal->editarRecurso($resultadoAccion, $request);
			
		}

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
		return view('expediente.info',
			compact('expedienteTemporal',
					'estadosExpediente','tipos','subtipos','tiposCuantia',
					'escalasDePago','origenesArbitraje','montosContrato',
					'resultadosLaudo','ejecucionesLaudo','favorLaudo', 'id'));
	}

    public function editar(Request $request)
    {
        return view('expediente.editar');
    }

    public function guardar(Request $request)
    {
        $validatedData = $request->validate([
            'numero' => 'required',
            'fechaSolicitud' => 'required|date',
            'estadoExpediente' => 'required',
            'numeroAsociado' => 'nullable',
            'tipoCaso' => 'required',
            'subtipoCaso' => 'required',
            'cuantiaControversiaInicial' => 'required',
            'cuantiaControversiaFinal' => 'nullable',
            'tipoCuantia' => 'required',
            'escalaPago' => 'required',
			'idSecretarioResponsable' => 'nullable',
			'secretarioResponsable' => 'nullable',
			'idSecretarioLider' => 'nullable',
			'secretarioLider' => 'nullable',
			'idDemandante' => 'required',
			'demandante' => 'required',
			'idDemandado' => 'required',
			'demandado' => 'required',
			'tipoDemandante' => 'required',
			'tipoDemandado' => 'required',
			'origenArbitraje' => 'nullable',
			'montoContrato' => 'nullable',
			'anhoContrato' => 'nullable',
			'regiones' => 'nullable',
			'arbitroUnico' => 'nullable',
			'designacionArbitroUnico' => 'nullable',
			'presidenteTribunal' => 'nullable',
			'arbitroDemandante' => 'nullable',
			'arbitroDemandado' => 'nullable',
			'designacionPresidenteTribunal' => 'nullable',
			'designacionDemandante' => 'nullable',
			'designacionDemandado' => 'nullable',
			'fechaLaudo' => 'nullable',
			'resultadoLaudo' => 'nullable',
			'resultadoEnSoles' => 'nullable',
			'ejecucionLaudo' => 'nullable',
			'laudadoAFavor' => 'nullable',
			'recursoPresentado' => 'nullable',
			'fechaPresentacion' => 'nullable',
			'resultadoRecursoPresentado' => 'nullable',
			'fechaResultado' => 'nullable',
        ]);

		if ($request->input('accionRegistrar') == 'nuevoExpediente'){
			$idExpediente = Expediente::insertarExpediente($request);
			RegionControversia::insertarRegiones($idExpediente, $request);
			ExpedienteEquipoLegal::insertarEquipo($idExpediente, $request);
			LaudoRecursoPresentado::insertarRecursos($idExpediente, $request);
		} else {
			$idExpediente = explode(" ",$request->input('accionRegistrar'))[1];
			Expediente::actualizarExpediente($idExpediente, $request);
			RegionControversia::actualizarRegiones($idExpediente, $request);
			ExpedienteEquipoLegal::actualizarEquipo($idExpediente, $request);
			LaudoRecursoPresentado::actualizarRecursos($idExpediente, $request);
		}

        $estadosExpediente = DB::table('expediente_estado')->get()->all();
        $tipos = DB::table('expediente_tipo_caso')->get()->all();
        $subtipos = DB::table('expediente_subtipo_caso')->get()->all();
		$expedientes = Expediente::get()->all();

		return view('expediente.lista', compact('estadosExpediente',
					'tipos', 'subtipos', 'expedientes' ));
    }

	public function buscarCliente(Request $request)
	{
		$accion = $request->input('accion');
		$tipoAccion = (explode(" ",$accion))[0];
		$id = 0;
		if ($tipoAccion == "buscarDemandanteId" || $tipoAccion == "buscarDemandadoId")
			$id = (explode(" ",$accion))[1];

		$clientes = ExpedienteClienteLegal::buscarCliente($request); 
		ExpedienteTemporal::guardarEnSesion($request);

		return view('expediente.clientelegal.directorio',
			compact('clientes',
			'accion',
			'tipoAccion',
			'id'));
	}


    public function buscarPersonal(Request $request)
    {
        $profesiones = DB::table('usuario_legal_profesion')->get()->all();
        $paises = DB::table('usuario_legal_pais')->get()->all();
        $perfiles = DB::table('usuario_legal_tipo')->get()->all();

        $accion = $request->input('accion');
		$tipoAccion = (explode(" ",$accion))[0];
		$id = 0;
		if ($tipoAccion == "buscarSecretarioId" || $tipoAccion == "buscarLiderId")
			$id = (explode(" ",$accion))[1];
		
        $secretarios = UsuarioLegal::buscarPersonal($request);
        ExpedienteTemporal::guardarEnSesion($request);

        return view('expediente.usuariolegal.directorio',
            compact('profesiones',
                    'paises',
                    'perfiles',
                    'secretarios',
					'accion',
					'tipoAccion',
					'id'));
    }

	public function buscarRegion(Request $request)
	{
        $accion = $request->input('accion');
		$tipoAccion = (explode(" ",$accion))[0];
		$id = 0;
		if ($tipoAccion == "buscarRegionId")
			$id = (explode(" ",$accion))[1];

        $regiones = Region::buscarRegion($request); 
        ExpedienteTemporal::guardarEnSesion($request);

		return view('expediente.region.directorio',
			compact('regiones',
					'accion',
					'tipoAccion',
					'id'));
	}

    public function nuevoRecurso(Request $request)
    {
		$recursosPresentados = DB::table('laudo_recurso')->get()->all();
		$resultadoRecursos = DB::table('laudo_recurso_resultado')->get()->all();

        $accion = $request->input('accion');
		$tipoAccion = (explode(" ",$accion))[0];
		$id = 0;
		if ($tipoAccion == "agregarRecursoId")
			$id = (explode(" ",$accion))[1];

        ExpedienteTemporal::guardarEnSesion($request);

		return view('expediente.recurso.nuevo',
			compact('recursosPresentados',
					'resultadoRecursos',
					'accion',
					'tipoAccion',
					'id'));
    }

    public function editarRecurso(Request $request)
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
		return view('expediente.recurso.editar',
			compact('recursosPresentados',
					'resultadoRecursos',
					'accion',
					'nuevoRecurso',
					'tipoAccion',
					'id'));
    }
}
