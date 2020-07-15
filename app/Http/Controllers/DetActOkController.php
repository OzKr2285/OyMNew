<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetActOk;

class DetActOkController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        
        if ($buscar==''){
            $detact = DetActOk::join('actividades','det_act_ok.id_actividad','=','actividades.id')           
            ->select('det_act_ok.id as idDet','actividades.id','actividades.nombre','det_act_ok.id_actividad','det_act_ok.nombre','det_act_ok.orden')                                   
            ->orderBy('det_act_ok.orden', 'asc')->paginate(10);
        }
        else{
            $detact = DetActOk::join('actividades','det_act_ok.id_actividad','=','actividades.id')           
            ->select('det_act_ok.id as idDet','actividades.id','actividades.nombre','det_act_ok.id_actividad','det_act_ok.nombre','det_act_ok.orden')         
            ->where('det_act_ok.id_actividad',$buscar)            
            ->orderBy('det_act_ok.orden', 'asc')->paginate(10);
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
         $detcausal = new DetActOk();
         $detcausal->id = $request->id;
         $detcausal->id_tp_tramite = $request->idTpTramite;         
         $detcausal->nombre = $request->nombre;
         $detcausal->save();
    }
}
