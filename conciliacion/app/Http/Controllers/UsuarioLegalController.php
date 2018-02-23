<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Models\UsuarioLegal;

class UsuarioLegalController extends Controller
{
    public function lista()
    {
        //
    }

    public function nuevo()
    {
        //
    }

    public function guardar(Request $request)
    {
        //
    }

    public function detalle($id)
    {
        //
    }

    public function editar($id)
    {
        //
    }

    public function actualizar(Request $request, $id)
    {
        //
    }

    public function borrar($id)
    {
        //
    }

    public function buscarArbitro()
    {
        return view('usuariolegal.arbitros');
    }

    public function directorioPersonal()
    {
        $profesiones = DB::table('usuario_legal_profesion')->get()->all();
        $paises = DB::table('usuario_legal_pais')->get()->all();
        $perfiles = DB::table('usuario_legal_tipo')->get()->all();
        $secretarios = UsuarioLegal::all();

        return view('usuariolegal.directorio',
            compact('profesiones',
                    'paises',
                    'perfiles',
                    'secretarios'));
    }

    public function buscarPersonal(Request $request)
    {
        $profesiones = DB::table('usuario_legal_profesion')->get()->all();
        $paises = DB::table('usuario_legal_pais')->get()->all();
        $perfiles = DB::table('usuario_legal_tipo')->get()->all();

        $nombre = $request->input('nombre');
        $apellidoPaterno = $request->input('apellidoPaterno');
        $apellidoMaterno = $request->input('apellidoMaterno');
        $profesion = $request->input('profesion');
        $pais = $request->input('pais');
        $perfil = $request->input('perfil');
        $telefono = $request->input('telefono');
        $correo = $request->input('correo');

        $secretarios = UsuarioLegal::where('nombre','LIKE', '%'.$nombre.'%')
            ->where('apellidoPaterno','LIKE','%'.$apellidoPaterno.'%')
            ->where('apellidoMaterno','LIKE','%'.$apellidoMaterno.'%')
            ->where('idUsuarioLegalProfesion','=',$profesion)
            ->get();

        return view('usuariolegal.directorio',
            compact('profesiones',
                    'paises',
                    'perfiles',
                    'secretarios'));
    }
}
