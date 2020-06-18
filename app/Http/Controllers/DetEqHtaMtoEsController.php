<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetEqHtaMtoEs;

class DetEqHtaMtoEsController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        
        if ($buscar==''){
            $detact = DetEqHtaMtoEs::join('eq_trab_hta','det_act_mto_es.id_actividad','=','eq_trab_hta.id')           
            ->select('det_act_mto_es.id as idDet','eq_trab_hta.id','eq_trab_hta.nombre','det_act_mto_es.id_actividad','det_act_mto_es.id_det_mto')                                   
            ->orderBy('eq_trab_hta.nombre', 'asc')->paginate(15);
        }
        else{
            $detact = DetEqHtaMtoEs::join('eq_trab_hta','det_eqhta_mto_es.id_eq_hta','=','eq_trab_hta.id')           
            ->select('det_eqhta_mto_es.id as idDet','eq_trab_hta.id','eq_trab_hta.nombre','eq_trab_hta.is_equipo','det_eqhta_mto_es.id_eq_hta','det_eqhta_mto_es.id_det_mto')            
            ->where('det_eqhta_mto_es.id_det_mto',$buscar)            
            ->orderBy('eq_trab_hta.nombre', 'asc')->paginate(15);
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
        // $detact = new DetEqHtaMtoEs();
        // $detact->id_det_mto = $request->id_det_mto;        
        // $detact->id_actividad = $request->id_actividad;        
        // $detact->save();

        $detalles = $request->data;//Array de detalles
        //Recorro todos los elementos

        $detalle = new DetEqHtaMtoEs();
        $detalle->id_det_mto  = $request->id_Det ;
        $detalle->id_eq_hta  = $request->id_Act;  
        $detalle->save();
        // foreach($detalles as $ep=>$det)
        // {
                                         
        // } 
    }
}
