<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DetActMtoET;

class DetActMtoETController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        
        if ($buscar==''){
            $detact = DetActMtoET::join('actividades','det_act_mto_et.id_actividad','=','actividades.id')           
            ->select('det_act_mto_et.id as idDet','actividades.id','actividades.nombre','det_act_mto_et.id_actividad','det_act_mto_et.id_det_mto')                                   
            ->orderBy('actividades.nombre', 'asc')->paginate(15);
        }
        else{
            $detact = DetActMtoET::join('actividades','det_act_mto_et.id_actividad','=','actividades.id')           
            ->select('det_act_mto_et.id as idDet','actividades.id','actividades.nombre','det_act_mto_et.id_actividad','det_act_mto_et.id_mto_et')            
            ->where('det_act_mto_et.id_mto_et',$buscar)            
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
            $detact = DetActMtoET::join('det_mto_et','det_act_mto_et.id_mto_et','=','det_mto_et.id')   
            ->join('mto_et','det_mto_et.id_mto','=','mto_et.id')
            ->join('equipos','det_mto_et.id_equipo','=','equipos.id')                       
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')          
            ->join('modelos','equipos.id_modelo','=','modelos.id')                     
            ->join('actividades','det_act_mto_et.id_actividad','=','actividades.id')           
            ->select('mto_et.id as COD MTO','mto_et.fec_realiza as FECHA INICIO','mto_et.fec_finaliza as FECHA FIN','ref_equipos.nombre as TP EQUIPO','equipos.serial as SERIAL','modelos.nombre as MODELO','actividades.nombre AS ACTIVIDAD','mto_et.obs as OBSERVACION')                                   
            // ->distinct('mto_et.id')
            // ->whereDate('mto_et.fec_realiza','>=',$fecI)->whereDate('mto_et.fec_realiza','<=',$fecF)    
            ->orderBy('actividades.nombre', 'asc')->get();
        }
        else{
            $detact = DetActMtoET::join('det_mto_et','det_act_mto_et.id_mto_et','=','det_mto_et.id')   
            ->join('mto_et','det_mto_et.id_mto','=','mto_et.id')
            ->join('equipos','det_mto_et.id_equipo','=','equipos.id')                       
            ->join('ref_equipos','equipos.id_refequipo','=','ref_equipos.id')          
            ->join('modelos','equipos.id_modelo','=','modelos.id')           
            ->join('actividades','det_act_mto_et.id_actividad','=','actividades.id')           
            ->select('mto_et.id as COD MTO','mto_et.fec_realiza as FECHA INICIO','mto_et.fec_finaliza as FECHA FIN','ref_equipos.nombre as TP EQUIPO','equipos.serial as SERIAL','modelos.nombre as MODELO','actividades.nombre AS ACTIVIDAD','mto_et.obs as OBSERVACION')                                   
            // ->distinct('mto_et.id')
            ->whereDate('mto_et.fec_realiza','>=',$fecI)->whereDate('mto_et.fec_realiza','<=',$fecF)    
            ->orderBy('actividades.nombre', 'asc')->get();
        }
        
        return [
           
            'detact' => $detact
        ];
    }
    public function store(Request $request)
    {

        if (!$request->ajax()) return redirect('/');

        $detalle = new DetActMtoET();
        $detalle->id_mto_et  = $request->id_Det ;
        $detalle->id_actividad  = $request->id_Act;  
        $detalle->save();
   
    }
    public function destroy(Request $request)
    {      
        $detact = DetActMtoET::findOrFail($request->id);
        $detact->delete();
    
    }
}
