<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetMtoEC;

class DetMtoECController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
        $refe = DetMtoEC::join('oficinas','det_mto_ec.id_oficina','=','oficinas.id')   
        ->select('det_oficinae.id_oficina','oficinas.nombre as nomM')
        ->distinct('det_oficinae.id_oficina')
        ->orderBy('oficinas.nombre','asc')->paginate(15);
        }
        else{
            $refe = DetMtoEC::join('mto_ec','det_mto_ec.id_mto','=','mto_ec.id')  
            ->join('oficinas','mto_ec.id_oficina','=','oficinas.id')  
            ->join('equipos','det_mto_ec.id_equipo','=','equipos.id')         
            ->join('modelos','equipos.id_modelo','=','modelos.id')         
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')         
            ->join('tp_equipos','ref_equipos.id_tpequipo','=','tp_equipos.id')         
            ->join('personas','equipos.id_responsable','=','personas.id')         
            ->select('modelos.nombre as modelo','personas.nombreFull as respo','tp_equipos.nombre','det_mto_ec.id','det_mto_ec.id_mto','oficinas.nombre as nomM','ref_equipos.id as idRef','ref_equipos.nombre as tpEquipo','equipos.serial','equipos.desc','equipos.id as idEquipo')
            ->where('det_mto_ec.id_mto',$buscar)
            ->orderBy('oficinas.nombre','asc')->paginate(15);
        }        
        return [
            'pagination' => [
                'total'        => $refe->total(),
                'current_page' => $refe->currentPage(),
                'per_page'     => $refe->perPage(),
                'last_page'    => $refe->lastPage(),
                'from'         => $refe->firstItem(),
                'to'           => $refe->lastItem(),
            ],
            'refe' => $refe
        ];
    }

}
