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
        $detRed = DetMercado::select('det_red.id_tp_material','mercados.nombre as nomM')
        ->distinct('det_mercados.id_mercado')
        ->orderBy('mercados.nombre','asc','ref_material.nombre')->paginate(15);
        }
        else{
            $detRed = DetRed::join('det_tp_material','det_red.id_material','=','det_tp_material.id')  
            ->join('tp_material_red','det_tp_material.id_tp_material','=','tp_material_red.id')        
            ->select('det_red.id as idDet','det_tp_material.id as idMat','det_tp_material.nombre as material','det_red.tp_red','det_red.longitud','det_red.obs','det_red.fec_opera','tp_material_red.nombre as nommat','tp_material_red.id as nom idtpmat')
            ->where('det_red.id_red',$buscar)
            ->orderBy('det_tp_material.nombre','asc')->get();
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
        $detRed->tp_red = $request->tp_red;            
        $detRed->fec_opera = $request->fec_opera;        
        $detRed->obs = $request->obs;        
        $detRed->longitud = $request->longitud;        
        $detRed->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $detRed = DetRed::findOrFail($request->id);
        $detRed->id_red = $request->id_red;        
        $detRed->id_material = $request->id_material;        
        $detRed->tp_red = $request->tp_red;            
        $detRed->fec_opera = $request->fec_opera;        
        $detRed->obs = $request->obs;        
        $detRed->longitud = $request->longitud;        
        $detRed->save();
    }

    public function destroy(Request $request)
    {
        $fichared = DetRed::findOrFail($request->id);
        $fichared->delete();
    
    }
}
