<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DetMtoEs;


class DetMtoEsController extends Controller
{
    //
    public function equiposMto(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;        
        
        if ($buscar==''){
            $equipo = DetMtoEs::join('det_equipos_estacion','det_mto_es.id_equipo','=','det_equipos_estacion.id')
            ->join('etapas','det_equipos_estacion.id_etapa','=','etapas.id')
            ->join('equipos','det_equipos_estacion.id_equipo','=','equipos.id') 
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')  
            ->join('modelos','equipos.id_modelo','=','modelos.id')           
            ->select('det_mto_es.id as idDet','det_mto_es.id_mto','ref_equipos.nombre','det_equipos_estacion.tp_tren','det_equipos_estacion.id_etapa','etapas.nombre as nomEtapa','equipos.tag','equipos.serial','modelos.nombre as modelo','equipos.id as idEquipo')            
            ->orderBy('det_mto_es.id', 'asc')->get();
        }
        else{
            $equipo = DetMtoEs::join('equipos','det_mto_es.id_equipo','=','equipos.id') 
            ->join('etapas','det_mto_es.id_etapa','=','etapas.id')
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')    
            ->join('modelos','equipos.id_modelo','=','modelos.id')         
            ->select('det_mto_es.id as idDet','det_mto_es.id_mto','ref_equipos.nombre','ref_equipos.id as idRefE','det_mto_es.tp_tren','det_mto_es.id_etapa','etapas.nombre as nomEtapa','equipos.tag','equipos.serial','modelos.nombre as modelo','equipos.id as idEquipo')            
            ->where('det_mto_es.id_mto',$buscar)            
            ->orderBy('etapas.nombre', 'asc')
            ->orderBy('det_mto_es.tp_tren', 'asc')
            ->orderBy('det_mto_es.id', 'asc')->get();
            
        }
        
        return ['equipo' => $equipo];
    }
    public function indexExcel(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $fecI = $request->fecI;
        $fecF = $request->fecF;
        
        if ($buscar==''){
            $mto = DetMtoEs::join('mto_es','det_mto_es.id_mto','=','mto_es.id')
            ->join('equipos','det_mto_es.id_equipo','=','equipos.id')                       
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')             
            ->join('modelos','equipos.id_modelo','=','modelos.id')             
            ->join('estaciones','mto_es.id_estacion','=','estaciones.id')             
            ->select('estaciones.nombre as ESTACION','estaciones.codigo as CODIGO','mto_es.id as COD MTO','mto_es.fec_realiza as FECHA INICIO','mto_es.fec_finaliza as FECHA FIN','ref_equipos.nombre as TP EQUIPO','modelos.nombre as MODELO','equipos.serial as SERIAL','equipos.tag as TAG')
            ->whereDate('mto_es.fec_realiza','>=',$fecI)->whereDate('mto_es.fec_realiza','<=',$fecF)                             
            ->orderBy('estaciones.nombre', 'asc')
            ->orderBy('mto_es.fec_realiza', 'asc')
            ->orderBy('mto_es.id', 'asc')->get();
        }
        else{
            $mto = DetMtoEs::join('actividadese','det_act_equipo.id_act','=','actividadese.id')    
            ->join('ref_equipos','det_act_equipo.id_equipo','=','ref_equipos.id')
            ->select('actividadese.id','det_act_equipo.id_equipo as idRefE','actividadese.nombre','actividadese.desc')
            ->distinct()
            ->where('det_act_equipo.id_equipo',$buscar)            
            ->orderBy('actividades.nombre', 'asc')
            ->orderBy('actividades.nombre', 'asc')->paginate(15);
        }
        

        return [
         
            'mto' => $mto
        ];
    }
}
