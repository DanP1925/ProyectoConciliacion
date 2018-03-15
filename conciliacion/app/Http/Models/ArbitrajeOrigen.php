<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ArbitrajeOrigen extends Model {

    protected $table = 'arbitraje_origen';
    protected $fillable = ['idArbitrajeOrigen', 'nombre'];
}
