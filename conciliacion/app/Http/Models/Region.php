<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Region extends Model {

    /**
     * Generated
     */

    protected $table = 'region';
    protected $fillable = ['idRegion', 'nombre'];


    public function arbitrajes() {
        return $this->belongsToMany(\App\Http\Models\Arbitraje::class, 'arbitraje_region', 'idRegion', 'idArbitraje');
    }

    public function arbitrajeRegions() {
        return $this->hasMany(\App\Http\Models\ArbitrajeRegion::class, 'idRegion', 'idRegion');
    }

	public static function buscarRegion(Request $request){
		$nombre = $request->input('nombre');

		$resultado = Region::where('nombre','LIKE', '%'.$nombre.'%');

		return $resultado->get();
	}

}
