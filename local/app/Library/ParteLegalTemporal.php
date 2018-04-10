<?php 

namespace App\Library;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Models\ExpedienteClienteLegal;
use App\Http\Models\ConsorcioPersonaDetalle;

class ParteLegalTemporal {

	var $id;
	var $nombre;
	var $tipo;
	var $consorcio;
	var $miembrosConsorcio;

    function __construct()
    {
    }

	public static function withRequest($id, $nombre, $consorcio, $miembros, $tipo){
		$instance = new self();
		$instance->id = $id;
		$instance->nombre = $nombre;
		$instance->consorcio = $consorcio;
		$instance->miembrosConsorcio = $miembros;
		$instance->tipo = $tipo;
		return $instance;
	}

	public static function withId($id,$tipo){
		$instance = new self();

		$expediente = DB::table('expediente')->where('idExpediente',$id)->first();

		$idParte = ParteLegalTemporal::seleccionarIdParte($expediente,$tipo);

		$clienteLegal = DB::table('expediente_cliente_legal')->where('idExpedienteClienteLegal',$idParte)->first();
		$instance->id = $clienteLegal->idExpedienteClienteLegal;

		list($tablaPersona,$idObjetivo,$idPersona) = ParteLegalTemporal::seleccionarTipoPersona($clienteLegal);
		$persona = DB::table($tablaPersona)->where($idObjetivo, $idPersona)->first();

		if (!is_null($persona)){
			$instance->nombre = ParteLegalTemporal::seleccionarNombre($clienteLegal,$persona );
			$consorcioDetalle = DB::table('consorcio_persona_detalle')->where($idObjetivo, $idPersona)->first();
			$consorcioPersona = DB::table('consorcio_persona')->where('idConsorcioPersona',$consorcioDetalle->idConsorcioPersona)->first();
			$instance->consorcio = $consorcioPersona->nombre;
			$miembrosConsorcio = DB::table('consorcio_persona_detalle')->where('idConsorcioPersona',$consorcioDetalle->idConsorcioPersona)->get()->all();
			$listaNombreMiembros = [];
			foreach($miembrosConsorcio as $miembro){
				$miembroId = ParteLegalTemporal::seleccionarMiembroId($clienteLegal,$miembro);
				$personaMiembro = DB::table($tablaPersona)->where($idObjetivo,$miembroId)->first();
				$listaNombreMiembros = ParteLegalTemporal::agregarNombre($clienteLegal, $listaNombreMiembros, $personaMiembro);
			}
			$instance->miembrosConsorcio = $listaNombreMiembros;
		}
		$instance->tipo = $clienteLegal->flgSector;

		return $instance;
	}

	public static function seleccionarIdParte($expediente, $tipo){
		if ($tipo=="demandante")
			return $expediente->idDemandante;
		else if ($tipo== "demandado")
			return $expediente->idDemandado;
	}

	public static function seleccionarTipoPersona($clienteLegal){
		if ($clienteLegal->flgTipoPersona == 'J'){
			$tablaPersona = 'persona_juridica';
			$idObjetivo = 'idPersonaJuridica';
			$idPersona = $clienteLegal->idPersonaJuridica;
		} else if ($clienteLegal->flgTipoPersona == 'N'){
			$tablaPersona = 'persona_natural';
			$idObjetivo = 'idPersonaNatural';
			$idPersona = $clienteLegal->idPersonaNatural;
		}
		return array($tablaPersona, $idObjetivo, $idPersona);
	}

	public static function seleccionarMiembroId($clienteLegal, $miembro){
		if ($clienteLegal->flgTipoPersona == 'J')
			return $miembro->idPersonaJuridica;
		else if ($clienteLegal->flgTipoPersona == 'N')
			return $miembro->idPersonaNatural;
	}

	public static function seleccionarNombre($clienteLegal, $persona){
		if ($clienteLegal->flgTipoPersona == 'J')
			return $persona->razonSocial;
		else if ($clienteLegal->flgTipoPersona == 'N')
			return ($persona->apellidoPaterno).' '.($persona->apellidoMaterno).' '.($persona->nombre);
	}

	public static function agregarNombre($clienteLegal, $listaNombreMiembros, $personaMiembro){
		if ($clienteLegal->flgTipoPersona == 'J')
			array_push($listaNombreMiembros,$personaMiembro->razonSocial);
		else if ($clienteLegal->flgTipoPersona == 'N'){
			$nombre = ($personaMiembro->apellidoPaterno).' '.($personaMiembro->apellidoMaterno).' '.($personaMiembro->nombre);
			array_push($listaNombreMiembros,$nombre);
		}
		return $listaNombreMiembros;
	}

	public function actualizarId($idClienteLegal){
		$this->id = $idClienteLegal;
	}

	public function actualizarNombre(){

		$clienteLegal = ExpedienteClienteLegal::where('idExpedienteClienteLegal',$this->id)->first();

		if ($clienteLegal->flgTipoPersona == 'J'){
			$persona = $clienteLegal->getPersonaJuridica();
			$this->nombre = $persona->razonSocial;
		} else {
			$persona = $clienteLegal->getPersonaNatural();
			$this->nombre = $persona->apellidoPaterno.' '.$persona->apellidoMaterno.' '.$persona->nombre;
		}
	}

	public function actualizarConsorcio(){

		$clienteLegal = ExpedienteClienteLegal::where('idExpedienteClienteLegal',$this->id)->first();
		$consorcio = ConsorcioPersonaDetalle::where('idConsorcioPersona',$clienteLegal->idConsorcioPersona)->first();
		if (!is_null($consorcio))
			$this->consorcio = $consorcio->getConsorcioPersona()->nombre;
		else
			$this->consorcio = null;
	}

	public function actualizarMiembros(){

		$clienteLegal = ExpedienteClienteLegal::where('idExpedienteClienteLegal',$this->id)->first();
		$consorcio = ConsorcioPersonaDetalle::where('idConsorcioPersona',$clienteLegal->idConsorcioPersona)->first();
		if(!is_null($consorcio)){
			$listaIds = $consorcio->getMiembros();
			$listaMiembros = [];
			foreach ($listaIds as $id){
				if ($clienteLegal->flgTipoPersona == 'J'){
					$persona = DB::table('persona_juridica')->where('idPersonaJuridica',$id)->first();
					$nombre = $persona->razonSocial;
				} else{
					$persona = DB::table('persona_natural')->where('idPersonaNatural',$id)->first();
					$nombre = $persona->apellidoPaterno.' '.$persona->apellidoMaterno.' '.$persona->nombre;
				}
				array_push($listaMiembros,$nombre);
			}
			$this->miembrosConsorcio = $listaMiembros;
		} else {
			$this->miembrosConsorcio = null;
		}
	}
}
