<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TecMtoEs;

class TecMtoEsController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        
        if ($buscar==''){
            $tecmto = TecMtoEs::join('personas','det_act_ok.id_actividad','=','actividades.id')           
            ->select('det_act_ok.id as idDet','actividades.id','actividades.nombre','det_act_ok.id_actividad','det_act_ok.nombre','det_act_ok.orden')                                   
            ->orderBy('det_act_ok.orden', 'asc')->get();
        }
        else{
            $tecmto = TecMtoEs::join('personas','tec_mto_es.id_tecnico','=','personas.id')    
            ->join('mto_es','tec_mto_es.id_mto_es','=','mto_es.id')           
            ->join('cargos','personas.id_cargo','=','cargos.id')           
            ->select('personas.id','personas.nombreFull','cargos.nombre','mto_es.id')         
            ->where('mto_es.id',$buscar)            
            ->orderBy('personas.nombreFull', 'asc')->get();
        }
        
        return [         
            'tecmto' => $tecmto
        ];
    }
}
