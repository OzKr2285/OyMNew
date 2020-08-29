<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetActMtoEs;

class DetActMtoEsController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        
        if ($buscar==''){
            $detact = DetActMtoEs::join('actividades','det_act_mto_es.id_actividad','=','actividades.id')           
            ->select('det_act_mto_es.id as idDet','actividades.id','actividades.nombre','det_act_mto_es.id_actividad','det_act_mto_es.id_det_mto')                                   
            ->orderBy('actividades.nombre', 'asc')->paginate(15);
        }
        else{
            $detact = DetActMtoEs::join('actividades','det_act_mto_es.id_actividad','=','actividades.id')           
            ->select('det_act_mto_es.id as idDet','actividades.id','actividades.nombre','det_act_mto_es.id_actividad','det_act_mto_es.id_det_mto')            
            ->where('det_act_mto_es.id_det_mto',$buscar)            
            ->orderBy('actividades.nombre', 'asc')->paginate(15);
        }
        
        return [
            'pagination' => [
                'total'        => $detact->total(),
                'current_page' => $detact->currentPage(),
                'per_page'     => $detact->perPage(),
                'last_page'    => $detact->lastPage(),
                'from'         => $detact->firstItem(),
                'to'           => $detact->lastItem(),
            ],
            'detact' => $detact
        ];
    }
    public function indexExcel(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $fecI = $request->fecI;
        $fecF = $request->fecF;
        
        if ($buscar==''){
            $detact = DetActMtoEs::join('det_mto_es','det_act_mto_es.id_det_mto','=','det_mto_es.id')   
            ->join('mto_es','det_mto_es.id_mto','=','mto_es.id')
            ->join('equipos','det_mto_es.id_equipo','=','equipos.id')                       
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')          
            ->join('modelos','equipos.id_modelo','=','modelos.id')         
            ->join('estaciones','mto_es.id_estacion','=','estaciones.id')    
            ->join('actividades','det_act_mto_es.id_actividad','=','actividades.id')           
            ->select('estaciones.nombre as Estacion','mto_es.id as COD MTO','mto_es.fec_realiza as FECHA INICIO','mto_es.fec_finaliza as FECHA FIN','ref_equipos.nombre as TP EQUIPO','modelos.nombre as MODELO','actividades.nombre AS ACTIVIDAD','mto_es.obs as OBSERVACION')                                   
            // ->distinct('mto_es.id')
            ->whereDate('mto_es.fec_realiza','>=',$fecI)->whereDate('mto_es.fec_realiza','<=',$fecF)    
            ->orderBy('actividades.nombre', 'asc')->get();
        }
        else{
            $detact = DetActMtoEs::join('det_mto_es','det_act_mto_es.id_det_mto','=','det_mto_es.id')   
            ->join('mto_es','det_mto_es.id_mto','=','mto_es.id')
            ->join('equipos','det_mto_es.id_equipo','=','equipos.id')                       
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')          
            ->join('modelos','equipos.id_modelo','=','modelos.id')         
            ->join('estaciones','mto_es.id_estacion','=','estaciones.id')    
            ->join('actividades','det_act_mto_es.id_actividad','=','actividades.id')           
            ->select('estaciones.nombre as Estacion','mto_es.id as COD MTO','mto_es.fec_realiza as FECHA INICIO','mto_es.fec_finaliza as FECHA FIN','ref_equipos.nombre as TP EQUIPO','modelos.nombre as MODELO','actividades.nombre AS ACTIVIDAD','mto_es.obs as OBSERVACION')                                   
            // ->distinct('mto_es.id')
            ->whereDate('mto_es.fec_realiza','>=',$fecI)->whereDate('mto_es.fec_realiza','<=',$fecF)    
            ->orderBy('actividades.nombre', 'asc')->get();
        }
        
        return [
           
            'detact' => $detact
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        // $detact = new DetActMtoEs();
        // $detact->id_det_mto = $request->id_det_mto;        
        // $detact->id_actividad = $request->id_actividad;        
        // $detact->save();

        $detalles = $request->data;//Array de detalles
        //Recorro todos los elementos

        $detalle = new DetActMtoEs();
        $detalle->id_det_mto  = $request->id_Det ;
        $detalle->id_actividad  = $request->id_Act;  
        $detalle->save();
        // foreach($detalles as $ep=>$det)
        // {
                                         
        // } 
    }
}
