<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\MtoRed;
use App\DetActMtoRed;
use App\DetEqhtaMtoRed;
use App\DetInsMtoRed;
use App\TecMtoRed;

class MtoRedController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $mto = MtoRed::join('fichared','mto_red.id_red','=','fichared.id')           
            ->select('fichared.id as idRed','fichared.nombre','fichared.codigo','mto_red.id as idMto','mto_red.edo','mto_red.fec_realiza','mto_red.fec_finaliza','mto_red.tp_mto','mto_red.frec')
            ->distinct()                                   
            ->orderBy('fichared.nombre', 'asc')
            ->orderBy('mto_red.edo', 'asc')->paginate(15);
        }
        else{
            $mto = MtoRed::join('actividadese','det_act_equipo.id_act','=','actividadese.id')    
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
           
            $mto = new MtoRed();
           
            $mto->fec_realiza = $request->fec_realiza;         
            $mto->fec_finaliza = $request->fec_finaliza;         
            $mto->tp_mto = $request->tp_mto;         
            $mto->frec = $request->frec;                 
            $mto->id_red = $request->id_red;         
            // $equipo->tp_tren = $request->tp_tren;
            // $equipo->id_mpio = $request->id_mpio;
            $mto->save();
            $detalles = $request->data;//Array de detalles Actividad
            $detalles2 = $request->data2;//Array de detalles Equipo
            $detalles3 = $request->data3;//Array de detalles Insumo
            $detalles4 = $request->data4;//Array de detalles Técnicos
            // //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetActMtoRed();
                $detalle->id_mto = $mto->id;
                $detalle->id_actividad =$det['id'];                                                                                                                                       
                $detalle->save();
            }          
            foreach($detalles2 as $ep=>$det)
            {
                $detalle = new DetEqhtaMtoRed();
                $detalle->id_mto = $mto->id;                                                                                                                                     
                $detalle->id_eq_hta =$det['id'];                                                                                                                                       
                $detalle->save();
            }          
            foreach($detalles3 as $ep=>$det)
            {
                $detalle = new DetInsMtoRed();
                $detalle->id_mto = $mto->id;
                $detalle->id_insumo =$det['id'];                                                                                                                                       
                $detalle->save();
            }   
            foreach($detalles4 as $ep=>$det)
            {
                $detalle = new TecMtoRed();
                $detalle->id_mto = $mto->id;
                $detalle->id_tecnico =$det['id'];                                                                     
                $detalle->is_respo =$det['Rol'];                                                                     
                $detalle->save();
            }    

            DB::commit();
            return ['idMto' => $mto->id];
        } catch (Exception $e){
            DB::rollBack();
        }      
    }
}
