<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use\App\MtoET;
use\App\DetActMtoET;
use\App\DetMtoET;

class MtoETController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $mto = MtoET::join('ref_equipos','mto_et.id_refequipo','=','ref_equipos.id')           
            ->select('ref_equipos.id','ref_equipos.nombre','mto_et.id as idMto','mto_et.edo','mto_et.fec_realiza','mto_et.fec_finaliza','mto_et.tp_mto')
            ->distinct()                                   
            ->orderBy('ref_equipos.nombre', 'asc')
            ->orderBy('mto_et.edo', 'asc')->paginate(15);
        }
        else{
            $mto = MtoET::join('actividadese','det_act_equipo.id_act','=','actividadese.id')    
            ->join('ref_equipos','det_act_equipo.id_equipo','=','ref_equipos.id')
            ->select('actividadese.id','det_act_equipo.id_equipo as idRefE','actividadese.nombre','actividadese.desc')
            ->distinct()
            ->where('det_act_equipo.id_equipo',$buscar)            
            ->orderBy('actividades.nombre', 'asc')
            ->orderBy('actividades.nombre', 'asc')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $mto->total(),
                'current_page' => $mto->currentPage(),
                'per_page'     => $mto->perPage(),
                'last_page'    => $mto->lastPage(),
                'from'         => $mto->firstItem(),
                'to'           => $mto->lastItem(),
            ],
            'mto' => $mto
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
           
            $mto = new MtoET();
           
            $mto->fec_realiza = $request->fec_realiza;         
            $mto->fec_finaliza = $request->fec_finaliza;         
            $mto->tp_mto = $request->tp_mto;         
            $mto->frec = $request->frec;         
            $mto->id_prov = $request->idProv;         
            $mto->id_refequipo = $request->id_refequipo;         
            // $equipo->tp_tren = $request->tp_tren;
            // $equipo->id_mpio = $request->id_mpio;
            $mto->save();
            $detalles2 = $request->data2;//Array de detalles Equipo
            $detalles3 = $request->data3;//Array de detalles Actividad
            $detalles5 = $request->data5;//Array de detalles Proveedor
            // //Recorro todos los elementos

            foreach($detalles2 as $ep=>$det)
            {
                $detalle = new DetMtoET();
                $detalle->id_mto = $mto->id;
                $detalle->id_equipo =$det['id'];                                                                                                                                       
                $detalle->save();
            }          
            foreach($detalles3 as $ep=>$det)
            {
                $detalle = new DetActMtoET();
                $detalle->id_mto_et = $mto->id;
                $detalle->id_equipo =$det['ide'];                                                                                                                                       
                $detalle->id_actividad =$det['id'];                                                                                                                                       
                $detalle->save();
            }          
            // foreach($detalles5 as $ep=>$det)
            // {
            //     $detalle = new DetActMtoET();
            //     $detalle->id_mto = $mto->id;
            //     $detalle->id_actividad =$det['id_actividad'];                                                                                                                                       
            //     $detalle->save();
            // }          
            DB::commit();
            return ['idMto' => $mto->id];
        } catch (Exception $e){
            DB::rollBack();
        }      
    }
}
