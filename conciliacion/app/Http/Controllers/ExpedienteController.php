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
use App\Http\Models\LaudoAFavor;
use App\Http\Models\LaudoEjecucion;
use App\Http\Models\LaudoResultado;
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

		if ($request->input('accion') == 'nuevoExpediente'){
			$idExpediente = Expediente::insertarExpediente($request);
			RegionControversia::insertarRegiones($idExpediente, $request);
			ExpedienteEquipoLegal::insertarEquipo($idExpediente, $request);
			LaudoRecursoPresentado::insertarRecursos($idExpediente, $request);
		} else {
			$idExpediente = explode(" ",$request->input('accion'))[1];
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
}
