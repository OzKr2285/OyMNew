<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetPasoE;

class DetPasoEController extends Controller
{
    //
    public function detalle(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
        $detPasoE = DetMercado::join('diametros','det_red.id_diametro','=','diametros.id')     
        ->select('det_red.id_mercado','mercados.nombre as nomM')
        ->distinct('det_mercados.id_mercado')
        ->orderBy('mercados.nombre','asc','ref_material.nombre')->paginate(15);
        }
        else{
            $detPasoE = DetPasoE::join('diametros','det_pasoe.id_diametro','=','diametros.id')  
            ->join('tp_material_red','det_pasoe.id_material','=','tp_material_red.id')        
            ->select('det_pasoe.id as idDet','tp_material_red.id','tp_material_red.id as idMat','tp_material_red.nombre as material','diametros.id as idTub','diametros.nombre as tuberia','det_pasoe.tp_pasoe','det_pasoe.longitud','det_pasoe.obs','det_pasoe.fec_opera')
            ->where('det_pasoe.id_paso',$buscar)
            ->orderBy('tp_material_red.nombre','asc')->get();
        }        
        return [

            'detpasoe' => $detPasoE
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $detPasoE = new DetPasoE();
        $detPasoE->id_paso = $request->id_paso;        
        $detPasoE->tp_pasoe = $request->tp_pasoe;        
        $detPasoE->id_diametro = $request->id_diametro;        
        $detPasoE->id_material = $request->id_material;        
        $detPasoE->fec_opera = $request->fec_opera;        
        $detPasoE->obs = $request->obs;        
        $detPasoE->longitud = $request->longitud;        
        $detPasoE->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $detPasoE = DetPasoE::findOrFail($request->id);
        $detPasoE->id_paso = $request->id_paso;        
        $detPasoE->tp_pasoe = $request->tp_pasoe;        
        $detPasoE->id_diametro = $request->id_diametro;        
        $detPasoE->id_material = $request->id_material;        
        $detPasoE->fec_opera = $request->fec_opera;        
        $detPasoE->obs = $request->obs;        
        $detPasoE->longitud = $request->longitud;        
        $detPasoE->save();
    }

    public function destroy(Request $request)
    {
        $detPasoE = DetPasoE::findOrFail($request->id);
        $detPasoE->delete();
    
    }
}
