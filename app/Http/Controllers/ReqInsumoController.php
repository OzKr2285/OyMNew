<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ReqInsumo;
use App\DetReqInsumo;

class ReqInsumoController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        
        if ($buscar==''){
            $req = ReqInsumo::join('personas','req_insumos.id_tecnico','=','personas.id')           
            ->select('personas.nombreFull','req_insumos.id','req_insumos.fec_solicitud','req_insumos.edo','req_insumos.obs','req_insumos.cod_estacion','req_insumos.id_mto')                                   
            // ->where('req_insumos.edo',0)
            ->orderBy('req_insumos.id', 'asc')->paginate(15);
        }
        else{
            $req = ReqInsumo::join('actividades','det_act_mto_et.id_actividad','=','actividades.id')           
            ->select('det_act_mto_et.id as idDet','actividades.id','actividades.nombre','det_act_mto_et.id_actividad','det_act_mto_et.id_mto_et')            
            ->where('det_act_mto_et.id_mto_et',$buscar)            
            ->orderBy('actividades.nombre', 'asc')->paginate(15);
        }
        
        return [
            'pagination' => [
                'total'        => $req->total(),
                'current_page' => $req->currentPage(),
                'per_page'     => $req->perPage(),
                'last_page'    => $req->lastPage(),
                'from'         => $req->firstItem(),
                'to'           => $req->lastItem(),
            ],
            'req' => $req
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
           
            $req = new ReqInsumo();
           
            $req->id_tecnico = \Auth::user()->id;         
            $req->obs = $request->obs;                
            $req->fec_solicitud = $request->fec_solicitud;         
            $req->edo = $request->edo;         
            $req->cod_estacion = $request->cod_estacion;         
            $req->id_mto = $request->id_mto;         
            $req->edo = 0;
            // $equipo->id_mpio = $request->id_mpio;
            $req->save();
            $detalles = $request->data;//Array de detalles
            // //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetReqInsumo  ();
                $detalle->id_req_insumo = $req->id;
                $detalle->id_insumo =$det['id'];                                                                     
                $detalle->cant =$det['cant'];                                                                                                                                                    
                $detalle->save();
            }          
            DB::commit();
            return ['idMto' => $req->id];
        } catch (Exception $e){
            DB::rollBack();
        }      
    }

}
