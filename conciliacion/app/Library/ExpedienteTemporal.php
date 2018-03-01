<?php 

namespace App\Library;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpedienteTemporal {

    var $numeroExpediente;
    var $fechaSolicitud;
    var $estadoExpediente;
    var $numeroExpedienteAsociado;
    var $tipoCaso;
    var $subtipoCaso;
    var $subtipoCaso2;
    var $subtipoCaso3;
    var $cuantiaControversiaInicial;
    var $cuantiaControversiaFinal;
    var $tipoCuantia;
    var $escalaPago;
    var $secretarioArbitral;
    var $secretarioArbitralLider;

    function __construct(Request $request)
    {
        $this->numeroExpediente = $request->session()->get('numeroExpediente');
        $this->fechaSolicitud = $request->session()->get('fechaSolicitud');
        $this->estadoExpediente = $request->session()->get('estadoExpediente');
        $this->numeroExpedienteAsociado = $request->session()->get('numeroExpedienteAsociado');
        $this->tipoCaso = $request->session()->get('tipoCaso');
        $this->subtipoCaso = $request->session()->get('subtipoCaso');
        $this->subtipoCaso2 = $request->session()->get('subtipoCaso2');
        $this->subtipoCaso3 = $request->session()->get('subtipoCaso3');
        $this->cuantiaControversiaInicial = $request->session()->get('cuantiaControversiaInicial');
        $this->cuantiaControversiaFinal = $request->session()->get('cuantiaControversiaFinal');
        $this->tipoCuantia = $request->session()->get('tipoCuantia');
        $this->escalaPago = $request->session()->get('escalaPago');

        if (!is_null($request->session()->get('secretarioArbitral')))
            $this->secretarioArbitral = $request->session()->get('secretarioArbitral');

        if (!is_null($request->session()->get('secretarioArbitralLider')))
            $this->secretarioArbitralLider = $request->session()->get('secretarioArbitralLider');
    }

    function agregarSecretario($idUsuarioLegal){
        $secretario = DB::table('usuario_legal')->where('idUsuario_legal',$idUsuarioLegal)->first();
        $this->secretarioArbitral = $secretario->nombre;
        $this->secretarioArbitral .= ' '.$secretario->apellidoPaterno;
        $this->secretarioArbitral .= ' '.$secretario->apellidoMaterno;
    }

    function agregarSecretarioLider($idUsuarioLegal){
        $secretario = DB::table('usuario_legal')->where('idUsuario_legal',$idUsuarioLegal)->first();
        $this->secretarioArbitralLider = $secretario->nombre;
        $this->secretarioArbitralLider .= ' '.$secretario->apellidoPaterno;
        $this->secretarioArbitralLider .= ' '.$secretario->apellidoMaterno;
    }

    public static function guardarEnSesion(Request $request){

        if (!is_null($request->input('numeroExpediente')))
            $request->session()->put('numeroExpediente',$request->input('numeroExpediente'));

        if (!is_null($request->input('fechaSolicitud')))
            $request->session()->put('fechaSolicitud',$request->input('fechaSolicitud'));
        
        if (!is_null($request->input('estadoExpediente')))
            $request->session()->put('estadoExpediente',$request->input('estadoExpediente'));

        if (!is_null($request->input('numeroExpedienteAsociado')))
            $request->session()->put('numeroExpedienteAsociado',$request->input('numeroExpedienteAsociado'));

        if (!is_null($request->input('tipoCaso')))
            $request->session()->put('tipoCaso',$request->input('tipoCaso'));

        if (!is_null($request->input('subtipoCaso')))
            $request->session()->put('subtipoCaso',$request->input('subtipoCaso'));

        if (!is_null($request->input('subtipoCaso2')))
            $request->session()->put('subtipoCaso2',$request->input('subtipoCaso2'));

        if (!is_null($request->input('subtipoCaso3')))
            $request->session()->put('subtipoCaso3',$request->input('subtipoCaso3'));

        if (!is_null($request->input('cuantiaControversiaInicial')))
            $request->session()->put('cuantiaControversiaInicial',$request->input('cuantiaControversiaInicial'));

        if (!is_null($request->input('cuantiaControversiaFinal')))
            $request->session()->put('cuantiaControversiaFinal',$request->input('cuantiaControversiaFinal'));

        if (!is_null($request->input('tipoCuantia')))
            $request->session()->put('tipoCuantia',$request->input('tipoCuantia'));

        if (!is_null($request->input('escalaPago')))
            $request->session()->put('escalaPago',$request->input('escalaPago'));

        if (!is_null($request->input('secretarioResponsable')))
            $request->session()->put('secretarioArbitral',$request->input('secretarioResponsable'));

        if (!is_null($request->input('secretarioLider')))
            $request->session()->put('secretarioArbitralLider',$request->input('secretarioLider'));
    }

    public static function quitarDeSesion(Request $request){

        $request->session()->forget('numeroExpediente');
        $request->session()->forget('fechaSolicitud');
        $request->session()->forget('estadoExpediente');
        $request->session()->forget('numeroExpedienteAsociado');
        $request->session()->forget('tipoCaso');
        $request->session()->forget('subtipoCaso');
        $request->session()->forget('subtipoCaso2');
        $request->session()->forget('subtipoCaso3');
        $request->session()->forget('cuantiaControversiaInicial');
        $request->session()->forget('cuantiaControversiaFinal');
        $request->session()->forget('tipoCuantia');
        $request->session()->forget('escalaPago');
        $request->session()->forget('secretarioArbitral');
        $request->session()->forget('secretarioArbitralLider');

    }
}
