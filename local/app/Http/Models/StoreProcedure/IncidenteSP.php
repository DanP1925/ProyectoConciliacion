<?php

namespace App\Http\Models\StoreProcedure;

use Illuminate\Support\Facades\DB;

class IncidenteSP{

    public static function incidenteBuscarIncidentes($numeroExpediente,$fechaInicio,$fechaFin,$nombreSecretario,$tipo,$estado){
        $results = DB::select("call incidente_buscar_incidentes (?,?,?,?,?,?)",array($numeroExpediente,$fechaInicio,$fechaFin,$nombreSecretario,$tipo,$estado));
        return $results;
    }

    public static function incidenteBuscarPersonal($nombrePersonal,$apPaternoPersonal,$apMaternoPersonal,$idPersonalProfesion,$idPersonalPais){
        $results = DB::select("call incidente_buscar_personal (?,?,?,?,?)",array($nombrePersonal,$apPaternoPersonal,$apMaternoPersonal,$idPersonalProfesion,$idPersonalPais));
        return $results;
    }

}
