<?php

namespace App\Http\Models\StoreProcedure;

use Illuminate\Support\Facades\DB;

class DesignacionSP{

    public static function designacionBuscarDesignaciones($numeroExpediente,$idTipoDesignacion,$fechaInicio,$fechaFin){
        $results = DB::select("call designacion_buscar_designaciones (?,?,?,?)",array($numeroExpediente,$idTipoDesignacion,$fechaInicio,$fechaFin));
        return $results;
    }

}
