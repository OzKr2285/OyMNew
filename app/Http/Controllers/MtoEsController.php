<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\MtoEs;
use App\DetMtoEs;
use App\TecMtoEs;
use App\DetActMtoEs;

class MtoEsController extends Controller
{
    //     
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $mto = MtoEs::join('estaciones','mto_es.id_estacion','=','estaciones.id')           
            ->select('estaciones.id as idEstacion','estaciones.nombre','mto_es.id as idMto','mto_es.estado','mto_es.fec_realiza','mto_es.fec_finaliza','mto_es.tp_mto','mto_es.frec','mto_es.cod_mto','mto_es.obs')
            ->distinct()                                   
            ->orderBy('estaciones.nombre', 'asc')
            ->orderBy('mto_es.id', 'asc')->paginate(15);
        }
        else{
            $mto = MtoEs::join('actividadese','det_act_equipo.id_act','=','actividadese.id')    
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
    public function indexFecha(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $fecI = $request->fecI;
        $fecF = $request->fecF;
        
        if ($buscar==''){
            $mto = MtoEs::join('estaciones','mto_es.id_estacion','=','estaciones.id')           
            ->select('estaciones.id as idEstacion','estaciones.nombre','estaciones.codigo','mto_es.id as idMto','mto_es.estado','mto_es.fec_realiza','mto_es.fec_finaliza','mto_es.tp_mto','mto_es.frec','mto_es.cod_mto','mto_es.obs')
            ->distinct()  
            ->whereDate('mto_es.fec_realiza','>=',$fecI)->whereDate('mto_es.fec_realiza','<=',$fecF)                                  
            ->orderBy('mto_es.id', 'asc')
            ->orderBy('estaciones.nombre', 'asc')->paginate(15);
        }
        else{
            $mto = MtoEs::join('estaciones','mto_es.id_estacion','=','estaciones.id')           
            ->select('estaciones.id as idEstacion','estaciones.nombre','estaciones.codigo','mto_es.id as idMto','mto_es.estado','mto_es.fec_realiza','mto_es.fec_finaliza','mto_es.tp_mto','mto_es.frec')
            ->distinct()  
            ->whereDate('mto_es.fec_realiza','>=',$fecI)->whereDate('mto_es.fec_realiza','<=',$fecF)                                  
            ->where('mto_es.id_estacion','=',$buscar)                                  
            ->orderBy('mto_es.id', 'asc')
            ->orderBy('estaciones.nombre', 'asc')->paginate(15);
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
 
    public function store2(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();      
            $detalles = $request->data;//Array de detalles
            // //Recorro todos los elementos
            foreach($detalles as $ep=>$det)
            {
                $detalle = new TecMtoEs();
                $detalle->id_mto_es = $request->id_mto;
                $detalle->id_tecnico =$det['id'];                                                                                                                                      
                $detalle->is_respo =$det['Rol'];                                                                                                                                      
                $detalle->save();
            }          
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }      
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
           
            $mto = new MtoEs();
            $detalles2 = $request->data2;//Array de detalles
            $mto->fec_realiza = $request->fec_realiza;         
            $mto->fec_finaliza = $request->fec_finaliza;         
            $mto->tp_mto = $request->tp_mto;         
            $mto->frec = $request->frec;         
                   
            $mto->id_estacion = $request->id_estacion;         
            
            foreach($detalles2 as $ep=>$det)
            {                
                if($det['num']<10){
                    $mto->cod_mto = $det['abrev']."00".$det['num'];  
                }else{
                    $mto->cod_mto = $det['abrev'].'0'.$det['num'];  
                }                    
            }       
            // $equipo->tp_tren = $request->tp_tren;
            // $equipo->id_mpio = $request->id_mpio;
            $mto->save();
            $detalles = $request->data;//Array de detalles
            // //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetMtoEs();
                $detalle->id_mto = $mto->id;
                $detalle->id_equipo =$det['id_equipo'];                                                                     
                $detalle->tp_tren =$det['tp_tren'];                                                                     
                $detalle->id_etapa =$det['id_etapa'];                                                                     
                $detalle->save();
            }   
            $mto = MtoEs::findOrFail($mto->id);
            $mto->obs = $request->obs;  
            $mto->save();

            DB::commit();
            return ['idMto' => $mto->id];
        } catch (Exception $e){
            DB::rollBack();
        }      
    }

    public function destroy(Request $request)
    {        
        // $registros=DetActMtoEs::where('id','tal')->get()->toArray();
        $servicio = MtoEs::findOrFail($request->id);
        $servicio->delete();    
    }
}
