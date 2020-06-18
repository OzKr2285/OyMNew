<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\EqTrabajoE;
use App\DetEqTrabajoE;

class DetEqTrabajoEController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        
        if ($buscar==''){
            $deteqtrabajo = DetEqTrabajoE::join('eq_trab_hta','det_eqtrabajoe.id_eq_equipo','=','eq_trab_hta.id')               
            ->select('det_eqtrabajoe.id as idDet','eq_trab_hta.nombre as nomHta','det_eqtrabajoe.id_refequipo')                                       
            ->orderBy('eq_trab_hta.nombre', 'asc')->paginate(15);
        }
        else{
            $deteqtrabajo = DetEqTrabajoE::join('eq_trab_hta','det_eqtrabajoe.id_eq_equipo','=','eq_trab_hta.id')               
            ->select('det_eqtrabajoe.id as idDet','eq_trab_hta.nombre','det_eqtrabajoe.id_refequipo','eq_trab_hta.id')                                       
            ->where('det_eqtrabajoe.id_refequipo',$buscar)               
            ->orderBy('eq_trab_hta.nombre', 'asc')->paginate(15);
                                 

        }
        
        return [
            'pagination' => [
                'total'        => $deteqtrabajo->total(),
                'current_page' => $deteqtrabajo->currentPage(),
                'per_page'     => $deteqtrabajo->perPage(),
                'last_page'    => $deteqtrabajo->lastPage(),
                'from'         => $deteqtrabajo->firstItem(),
                'to'           => $deteqtrabajo->lastItem(),
            ],
            'deteqtrabajo' => $deteqtrabajo
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
           
            $insumo = new EqTrabajoE();
           
            $insumo->desc = $request->desc;         
            // $equipo->tp_tren = $request->tp_tren;
            // $equipo->id_mpio = $request->id_mpio;
            $insumo->save();
            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetEqTrabajoE();
                $detalle->id_eq_trabajoe = $insumo->id;
                $detalle->observacion = $det['observacion'];                        
                $detalle->id_refequipo = $request->id_refequipo;
                $detalle->id_eq_equipo =$det['id'];                                     
                $detalle->save();
            }          

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}
