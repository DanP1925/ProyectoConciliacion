<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ConsorcioPersona extends Model {

    /**
     * Generated
     */

    protected $table = 'consorcio_persona';
    protected $fillable = ['idConsorcioPersona', 'nombre'];


    public function consorcioPersonaDetalles() {
        return $this->hasMany(\App\Http\Models\ConsorcioPersonaDetalle::class, 'idConsorcioPersona', 'idConsorcioPersona');
    }

	public static function getListaIdUsandoNombre($nombre) {
		$consorcios = DB::table('consorcio_persona')->where('nombre','LIKE','%'.$nombre.'%')->get()->all();
		$lista = [];
		foreach($consorcios as $consorcio){
			array_push($lista,$consorcio->idConsorcioPersona);
		}
		return $lista; 
	}

}
