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

    // PIXELLAR: Override Auth Method
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

        $this->crearUsuario($data['idPerfil'],$data['nombre'],$data['apPaterno'],$data['apMaterno'],$user->id);

        return $user;
    }

    public function crearUsuario($idPerfil,$nombre,$apPaterno,$apMaterno,$idUser){
        Usuario::crearUsuario($idPerfil,$nombre,$apPaterno,$apMaterno,$idUser);
    }

    /*public function validarUsuario(Request $request){
        $data = $request->json()->all();
        $email = $data['usuario'];
        $clave = $data['clave'];

        $authUser =  array();

        $response = array(
            'response' => 'ERR',
            'authUser' => $authUser
        );

        if (Auth::attempt(['email' => $email, 'password' => $clave])) {
            $resIdUser = Auth::user()->id;
            $resIdUsuario = "";
            $resEmail = Auth::user()->email;
            $resNombre = "";
            $resApPaterno = "";
            $resApMaterno = "";
            $resIdPerfil = "";


            foreach(Auth::user()->usuarios as $usuario){
                $resIdUsuario = $usuario->idUsuario;
                $resNombre = $usuario->nombre;
                $resApPaterno = $usuario->apellidoPaterno;
                $resApMaterno = $usuario->apellidoMaterno;
                $resIdPerfil = $usuario->idPerfil;
            }

            $authUser = array(
                'idUser' => $resIdUser,
                'idUsuario' => $resIdUsuario,
                'email' => $resEmail,
                'nombre' => $resNombre,
                'apPaterno' => $resApPaterno,
                'apMaterno' => $resApMaterno,
                'idPerfil' => $resIdPerfil
            );

            $response = array(
                'response' => 'OK',
                'authUser' => $authUser
            );

        }

        $encodedResponse = json_encode($response);

        return $encodedResponse;
    }*/

}