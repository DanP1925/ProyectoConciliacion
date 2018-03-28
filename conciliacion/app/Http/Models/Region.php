<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Region extends Model {

    /**
     * Generated
     */

    protected $table = 'region';
    protected $fillable = ['idRegion', 'nombre'];


    public function expedientes() {
        return $this->belongsToMany(\App\Http\Models\Expediente::class, 'region_controversia', 'idRegion', 'idExpediente');
    }

    public function regionControversia() {
        return $this->hasMany(\App\Http\Models\RegionControversium::class, 'idRegion', 'idRegion');
    }

	public static function buscarRegion(Request $request){
		$nombre = $request->input('nombre');

		$resultado = Region::where('nombre','LIKE', '%'.$nombre.'%');

		return $resultado->paginate(5);
	}

}
