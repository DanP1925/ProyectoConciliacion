<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ConsorcioPersonaDetalle extends Model {

    /**
     * Generated
     */

    protected $table = 'consorcio_persona_detalle';
    protected $fillable = ['idConsorcioPersonaDetalle', 'idConsorcioPersona', 'idPersonaJuridica', 'idPersonaNatural', 'flgTipoPersona'];


    public function personaJuridica() {
        return $this->belongsTo(\App\Http\Models\PersonaJuridica::class, 'idPersonaJuridica', 'idPersonaJuridica');
    }

    public function personaNatural() {
        return $this->belongsTo(\App\Http\Models\PersonaNatural::class, 'idPersonaNatural', 'idPersonaNatural');
    }

    public function consorcioPersona() {
        return $this->belongsTo(\App\Http\Models\ConsorcioPersona::class, 'idConsorcioPersona', 'idConsorcioPersona');
    }

	public function getConsorcioPersona() {
		return DB::table('consorcio_persona')->where('idConsorcioPersona',$this->idConsorcioPersona)->first();
	}

	public function getMiembros(){
		$resultado = [];
		if ($this->flgTipoPersona=='J'){
			$listaMiembros = DB::table('consorcio_persona_detalle')->select('idPersonaJuridica')->where('idConsorcioPersona',$this->idConsorcioPersona)->get();
			foreach ($listaMiembros as $miembro)
				array_push($resultado,$miembro->idPersonaJuridica);
		}
		else if ($this->flgTipoPersona=='N'){
			$listaMiembros = DB::table('consorcio_persona_detalle')->select('idPersonaNatural')->where('idConsorcioPersona',$this->idConsorcioPersona)->get();
			foreach ($listaMiembros as $miembro)
				array_push($resultado,$miembro->idPersonaNatural);
		}
		return $resultado;
	}	

	public static function getListaIdConsorcioUsandoPersonaJuridica($listaId){
		$consorcios = DB::table('consorcio_persona_detalle')->whereIn('idPersonaJuridica',$listaId);
		$lista = [];
		foreach($consorcios->get()->all() as $consorcio)
			array_push($lista,$consorcio->idConsorcioPersona);
		return $lista;
	}

	public static function getListaIdConsorcioUsandoConsorcioPersona($listaId){
		$consorcios = DB::table('consorcio_persona_detalle')->whereIn('idConsorcioPersona',$listaId);
		$lista = [];
		foreach($consorcios->get()->all() as $consorcio)
			array_push($lista,$consorcio->idPersonaJuridica);
		return $lista;
	}

	public static function getListaIdConsorcioUsandoPersonaNatural($listaId){
		$consorcios = DB::table('consorcio_persona_detalle')->whereIn('idPersonaNatural',$listaId);
		$lista = [];
		foreach($consorcios->get()->all() as $consorcio)
			array_push($lista,$consorcio->idConsorcioPersona);
		return $lista;
	}

}
