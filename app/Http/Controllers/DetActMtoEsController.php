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
