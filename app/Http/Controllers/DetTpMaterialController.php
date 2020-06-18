<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetTpMaterial;

class DetTpMaterialController extends Controller
{
    //

    public function detTpMaterial(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        
            $dettpm = DetTpMaterial::join('tp_material_red','det_tp_material.id_tp_material','=','tp_material_red.id')    
            ->select('det_tp_material.id','det_tp_material.id_tp_material','det_tp_material.nombre')
            ->where('det_tp_material.id_tp_material',$buscar)
            ->orderBy('det_tp_material.nombre','asc')->get();
               
        return [

            'dettpm' => $dettpm
        ];
    }
}
