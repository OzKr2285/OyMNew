<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\MtoVeh;
use App\DetMtoVeh;
use App\TecMtoVeh;

class MtoVehController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $mto = MtoVeh::join('fichaveh','mto_veh.placa','=','fichaveh.id')   
            ->join('lineas','fichaveh.id_linea','=','lineas.id')              
            ->select('lineas.nombre as nomModelo','fichaveh.id as placa','fichaveh.tipo','fichaveh.desc','mto_veh.edo','mto_veh.placa','mto_veh.fec_realiza','mto_veh.fec_finaliza','mto_veh.tp_mto','mto_veh.obs')
            ->distinct()                                   
            ->orderBy('fichaveh.id', 'asc')
            ->orderBy('mto_veh.edo', 'asc')->paginate(15);
        }
        else{
            $mto = MtoVeh::join('actividadese','det_act_equipo.id_act','=','actividadese.id')    
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
           
            $mto = new MtoVeh();
           
            $mto->placa = $request->placa;         
            $mto->fec_realiza = $request->fec_realiza;         
            $mto->fec_finaliza = $request->fec_finaliza;         
            $mto->tp_mto = $request->tp_mto;         
            $mto->obs = $request->obs;         
            // $equipo->tp_tren = $request->tp_tren;
            // $equipo->id_mpio = $request->id_mpio;
            $mto->save();
            $detalles = $request->data2;//Array de detalles
            $detalles2 = $request->data;//Array de detalles
            // //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetMtoVeh();
                $detalle->id_mto = $mto->id;
                $detalle->id_act =$det['id'];                                                                     
                $detalle->save();
            }          

            foreach($detalles2 as $ep=>$det)
            {
                $detalle = new TecMtoVeh();
                $detalle->id_mto_veh = $mto->id;
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
