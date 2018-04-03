<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ExpedienteTipoCaso extends Model {

    /**
     * Generated
     */

    protected $table = 'expediente_tipo_caso';
    protected $fillable = ['idExpedienteTipoCaso', 'nombre'];


    public function expedientes() {
        return $this->hasMany(\App\Http\Models\Expediente::class, 'idExpedienteTipoCaso', 'idExpedienteTipoCaso');
    }


}
