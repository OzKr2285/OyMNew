<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetMtoET;

class DetMtoETController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
        $equipo = DetMtoET::join('oficinas','det_mto_ec.id_oficina','=','oficinas.id')   
        ->select('det_oficinae.id_oficina','oficinas.nombre as nomM')
        ->distinct('det_oficinae.id_oficina')
        ->orderBy('oficinas.nombre','asc')->paginate(15);
        }
        else{
            $equipo = DetMtoET::join('mto_et','det_mto_et.id_mto','=','mto_et.id')  
            ->join('equipos','det_mto_et.id_equipo','=','equipos.id')         
            ->join('modelos','equipos.id_modelo','=','modelos.id')         
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')         
            ->join('tp_equipos','ref_equipos.id_tpequipo','=','tp_equipos.id')                
            ->select('modelos.nombre as modelo','tp_equipos.nombre','det_mto_et.id','det_mto_et.id_mto  as idDetMto','ref_equipos.id as idRef','ref_equipos.nombre as tpEquipo','equipos.serial','equipos.desc','equipos.id as idEquipo')
            ->where('det_mto_et.id_mto',$buscar)
            ->orderBy('modelos.nombre','asc')->get();
        }        
        return ['equipo' => $equipo];
    }
    public function index2(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $equipo = DetMtoET::join('mto_et','det_mto_et.id_mto','=','mto_et.id')  
            ->join('equipos','det_mto_et.id_equipo','=','equipos.id')         
            ->join('modelos','equipos.id_modelo','=','modelos.id')         
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')         
            ->join('tp_equipos','ref_equipos.id_tpequipo','=','tp_equipos.id')                
            ->select('det_mto_et.obs','mto_et.tp_mto','mto_et.fec_realiza','mto_et.edo','mto_et.fec_finaliza','modelos.nombre as modelo','tp_equipos.nombre','det_mto_et.id','det_mto_et.id_mto','ref_equipos.id as idRef','ref_equipos.nombre as tpEquipo','equipos.serial','equipos.desc','equipos.id as idEquipo','equipos.serial')
            // ->where('det_mto_et.id_mto',$buscar)
        ->orderBy('modelos.nombre','asc')->get();
        }
        else{
            $equipo = DetMtoET::join('mto_et','det_mto_et.id_mto','=','mto_et.id')  
            ->join('equipos','det_mto_et.id_equipo','=','equipos.id')         
            ->join('modelos','equipos.id_modelo','=','modelos.id')         
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')         
            ->join('tp_equipos','ref_equipos.id_tpequipo','=','tp_equipos.id')                
            ->select('mto_et.fec_realiza','mto_et.fec_finaliza','modelos.nombre as modelo','tp_equipos.nombre','det_mto_et.id','det_mto_et.id_mto','ref_equipos.id as idRef','ref_equipos.nombre as tpEquipo','equipos.serial','equipos.desc','equipos.id as idEquipo')
            ->where('det_mto_et.id_mto',$buscar)
            ->orderBy('modelos.nombre','asc')->get();
        }        
        return [
    
            'mto' => $equipo
        ];
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $detalle = DetMtoET::findOrFail($request->id);
        // $detalle->id_mto = $request->idMto;
        // $detalle->id_equipo = $request->id_equipo;                                                                                                                                       
        $detalle->obs = $request->obs;                                                                                                                                       
        $detalle->save();
    }
}
