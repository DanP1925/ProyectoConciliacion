<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PersonaNatural extends Model {

    /**
     * Generated
     */

    protected $table = 'persona_natural';
    protected $fillable = ['idPersonaNatural', 'nombre', 'apellidoPaterno', 'apellidoMaterno', 'dni', 'email', 'telefono'];


    public function consorcioPersonaDetalles() {
        return $this->hasMany(\App\Http\Models\ConsorcioPersonaDetalle::class, 'idPersonaNatural', 'idPersonaNatural');
    }

    public function expedienteClienteLegals() {
        return $this->hasMany(\App\Http\Models\ExpedienteClienteLegal::class, 'idPersonaNatural', 'idPersonaNatural');
    }

    public function facturas() {
        return $this->hasMany(\App\Http\Models\Factura::class, 'idClientePersonaNatural', 'idPersonaNatural');
    }

	public static function getListaIdUsandoNombre($nombre){
		$personasNombre = DB::table('persona_natural')->where('nombre','LIKE','%'.$nombre.'%')->get();
		$personasPaterno = DB::table('persona_natural')->where('apellidoPaterno','LIKE','%'.$nombre.'%')->get();
		$personasMaterno = DB::table('persona_natural')->where('apellidoMaterno','LIKE','%'.$nombre.'%')->get();

		$personas = $personasNombre->merge($personasPaterno);
		$personas = $personas->merge($personasMaterno);

		$lista = [];
		foreach($personas as $persona){
			array_push($lista, $persona->idPersonaNatural);
		}
		return $lista;
	}
}
