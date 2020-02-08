<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetRed;

class DetRedController extends Controller
{
    //

    public function detalle(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
        $detRed = DetMercado::join('diametros','det_red.id_diametro','=','diametros.id')     
        ->select('det_red.id_mercado','mercados.nombre as nomM')
        ->distinct('det_mercados.id_mercado')
        ->orderBy('mercados.nombre','asc','ref_material.nombre')->paginate(15);
        }
        else{
            $detRed = DetRed::join('diametros','det_red.id_diametro','=','diametros.id')  
            ->join('tp_material_red','det_red.id_material','=','tp_material_red.id')        
            ->select('det_red.id','tp_material_red.id','tp_material_red.nombre as material','diametros.nombre as tuberia','det_red.longitud','det_red.obs')
            ->where('det_red.id_red',$buscar)
            ->orderBy('tp_material_red.nombre','asc')->get();
        }        
        return [

            'detred' => $detRed
        ];
    }


    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $detRed = new DetRed();
        $detRed->id_red = $request->id_red;        
        $detRed->id_material = $request->id_material;        
        $detRed->id_diametro = $request->id_diametro;        
        $detRed->fec_opera = $request->fec_opera;        
        $detRed->obs = $request->obs;        
        $detRed->longitud = $request->longitud;        
        $detRed->save();
    }
}
