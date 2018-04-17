<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PersonaJuridica extends Model {

    /**
     * Generated
     */

    protected $table = 'persona_juridica';
    protected $fillable = ['idPersonaJuridica', 'nombreComercial', 'razonSocial', 'ruc', 'direccion', 'email', 'telefono', 'sitioWeb'];


    public function consorcioPersonaDetalles() {
        return $this->hasMany(\App\Http\Models\ConsorcioPersonaDetalle::class, 'idPersonaJuridica', 'idPersonaJuridica');
    }

    public function expedienteClienteLegals() {
        return $this->hasMany(\App\Http\Models\ExpedienteClienteLegal::class, 'idPersonaJuridica', 'idPersonaJuridica');
    }

    public function facturas() {
        return $this->hasMany(\App\Http\Models\Factura::class, 'idClientePersonaJuridica', 'idPersonaJuridica');
    }

	public static function getListaIdUsandoNombre($nombre){
		$personasJuridicas = DB::table('persona_juridica')->where('razonSocial','LIKE','%'.$nombre.'%')->get();
		$lista = [];
		foreach($personasJuridicas as $personaJuridica)
			array_push($lista, $personaJuridica->idPersonaJuridica);
		return $lista;
	}

	public static function getListaIdUsandoRUC($ruc){
		$personasJuridicas = DB::table('persona_juridica')->where('ruc','LIKE','%'.$ruc.'%');
		$lista = [];
		foreach($personasJuridicas->get() as $personaJuridica)
			array_push($lista, $personaJuridica->idPersonaJuridica);
		return $lista;
	}

}
