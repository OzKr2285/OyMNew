<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\MtoEC;
use App\DetMtoEC;
use App\TecMtoEC;

class MtoECController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $mto = MtoEC::join('oficinas','mto_ec.id_oficina','=','oficinas.id')           
            ->select('oficinas.id as idOficina','oficinas.nombre','mto_ec.id as idMto','mto_ec.edo','mto_ec.fec_realiza','mto_ec.fec_finaliza','mto_ec.tp_mto')
            ->distinct()                                   
            ->orderBy('oficinas.nombre', 'asc')
            ->orderBy('mto_ec.edo', 'asc')->paginate(15);
        }
        else{
            $mto = MtoEC::join('actividadese','det_act_equipo.id_act','=','actividadese.id')    
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
           
            $mto = new MtoEC();
           
            $mto->fec_realiza = $request->fec_realiza;         
            $mto->fec_finaliza = $request->fec_finaliza;         
            $mto->tp_mto = $request->tp_mto;         
            $mto->obs = $request->obs;         
            $mto->id_oficina = $request->idOficina;         
            // $equipo->tp_tren = $request->tp_tren;
            // $equipo->id_mpio = $request->id_mpio;
            $mto->save();
            $detalles = $request->data2;//Array de detalles
            $detalles2 = $request->data;//Array de detalles
            // //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetMtoEC();
                $detalle->id_mto = $mto->id;
                $detalle->id_equipo =$det['idEquipo'];                                                                     
                $detalle->save();
            }          

            foreach($detalles2 as $ep=>$det)
            {
                $detalle = new TecMtoEC();
                $detalle->id_mtoec = $mto->id;
                $detalle->id_tecnico =$det['id'];                                                                     
                $detalle->is_respo =$det['Rol'];                                                                     
                $detalle->save();
            }          
       
            DB::commit();
    
        } catch (Exception $e){
            DB::rollBack();
        }      
    }

}
