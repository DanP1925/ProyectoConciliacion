<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegionControversia extends Model
{

    protected $table = 'region_controversia';
    protected $fillable = ['idExpediente', 'idRegion'];

	public function expediente(){
        return $this->belongsTo(\App\Http\Models\Expediente::class, 'idExpediente', 'idExpediente');
	}

	public function region(){
        return $this->belongsTo(\App\Http\Models\Region::class, 'idRegion', 'idRegion');
	}

	public static function insertarRegiones($idExpediente,Request $request){
		foreach($request->regiones as $nombreRegion)
			$region = DB::table('region')->where('nombre',$nombreRegion)->first();
			DB::table('region_controversia')->insert(
				['idExpediente' => $idExpediente,
				'idRegion' => $region->idRegion
				]
			);
	}	
}
