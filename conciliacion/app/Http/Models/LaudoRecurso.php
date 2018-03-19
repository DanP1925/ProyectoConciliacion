<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LaudoRecurso extends Model {

    protected $table = 'laudo_recurso';
    protected $fillable = ['idLaudoRecurso', 'nombre'];

}
