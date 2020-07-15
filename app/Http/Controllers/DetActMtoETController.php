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
