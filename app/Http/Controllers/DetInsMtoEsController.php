<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetInsMtoEs;

class DetInsMtoEsController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        
        if ($buscar==''){
            $detact = DetInsMtoEs::join('eq_trab_hta','det_act_mto_es.id_actividad','=','eq_trab_hta.id')           
            ->select('det_act_mto_es.id as idDet','eq_trab_hta.id','eq_trab_hta.nombre','det_act_mto_es.id_actividad','det_act_mto_es.id_det_mto')                                   
            ->orderBy('eq_trab_hta.nombre', 'asc')->paginate(15);
        }
        else{
            $detact = DetInsMtoEs::join('ref_materiales','det_ins_mto_es.id_insumo','=','ref_materiales.id')           
            ->select('det_ins_mto_es.id as idDet','ref_materiales.id','ref_materiales.nombre','det_ins_mto_es.id_insumo','det_ins_mto_es.id_mto_es')            
            ->where('det_ins_mto_es.id_mto_es',$buscar)            
            ->orderBy('ref_materiales.nombre', 'asc')->paginate(15);
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
        // $detact = new DetInsMtoEs();
        // $detact->id_det_mto = $request->id_det_mto;        
        // $detact->id_actividad = $request->id_actividad;        
        // $detact->save();

        $detalles = $request->data;//Array de detalles
        //Recorro todos los elementos

        $detalle = new DetInsMtoEs();
        $detalle->id_mto_es  = $request->id_Det ;
        $detalle->id_insumo  = $request->id_Act;  
        $detalle->save();
        // foreach($detalles as $ep=>$det)
        // {
                                         
        // } 
    }
}
