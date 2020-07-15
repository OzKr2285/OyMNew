<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetReqInsumo;

class DetReqInsumoController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        
        if ($buscar==''){
            $req = DetReqInsumo::join('personas','req_insumos.id_tecnico','=','personas.id')           
            ->select('personas.nombreFull','req_insumos.id','req_insumos.fec_solicitud','req_insumos.edo','req_insumos.obs','req_insumos.cod_estacion','req_insumos.id_mto')                                   
            ->orderBy('req_insumos.id', 'asc')->get();
        }
        else{
            $req = DetReqInsumo::join('req_insumos','det_req_insumos.id_req_insumo','=','req_insumos.id')  
            ->join('ref_materiales','det_req_insumos.id_insumo','=','ref_materiales.id')          
            ->select('det_req_insumos.fec_entrega','det_req_insumos.id','det_req_insumos.edo','ref_materiales.codigo','ref_materiales.nombre','det_req_insumos.cant','ref_materiales.und_med')                                   
            ->where('det_req_insumos.id_req_insumo',$buscar)            
            ->orderBy('det_req_insumos.id', 'asc')->get();
        }
        
        return [

            'req' => $req
        ];
    }
    public function update(Request $request)
    {      
        if (!$request->ajax()) return redirect('/');
        $req = DetReqInsumo::findOrFail($request->id);
        $req->edo=1;
        $req->fec_entrega=$request->fecE;
        $req->save();    
    }
}
