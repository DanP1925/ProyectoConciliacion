<?php

namespace App\Http\Controllers;

use App\Http\Models\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function listarPerfiles(){
        return Perfil::all();
    }
}
