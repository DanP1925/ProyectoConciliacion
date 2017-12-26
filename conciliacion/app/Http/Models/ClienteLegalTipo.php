<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteLegalTipo extends Model {

    /**
     * Generated
     */

    protected $table = 'cliente_legal_tipo';
    protected $fillable = ['idClienteLegalTipo', 'nombre'];


    public function clienteLegals() {
        return $this->hasMany(\App\Http\Models\ClienteLegal::class, 'idClienteLegalTipo', 'idClienteLegalTipo');
    }


}
