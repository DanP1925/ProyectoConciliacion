<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class OlvideClave extends Model {

    /**
     * Generated
     */

    protected $table = 'olvide_clave';
    protected $fillable = ['idOlvideClave', 'hash', 'idUser', 'email', 'fechaInicio', 'fechaFin', 'estado'];



}
