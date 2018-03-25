<?php

namespace App\Http\Controllers;

use App\Http\Models\Perfil;
use App\Http\Models\Usuario;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class UsuarioController extends Controller
{

    public function validarCredenciales(Request $request)
    {
        $email = Input::get('email');
        $password = Input::get('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $idPerfil = Auth::user()->usuarios[0]->idPerfil;

            if($idPerfil=="ADM"){
                return "true";
            }
        }

        return "false";

    }


    public function nuevo()
    {   $perfiles = Perfil::all();
       return view('usuario.nuevo')
            ->with('perfiles', $perfiles);
    }

    public function registar(Request $request)
    {   $this->crearUsuarioLaravel($request->all());

        if (Auth::check()) {
            return redirect('/expediente/lista');
        }

        return redirect()->route('index');
    }

    protected function crearUsuarioLaravel(array $data)
    {   $user = User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        Usuario::crearUsuario($data['idPerfil'],$data['nombre'],$data['apPaterno'],$data['apMaterno'],$user->id);

        return $user;
    }


    // ==========
    //  EXTERNAL
    // ==========

    public function nuevoExternal()
    {   $perfiles = Perfil::all();
        return view('usuario.nuevoExternal')
            ->with('perfiles', $perfiles);
    }

}