<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CierrePqrsServ;
use App\TicketServ;
use Illuminate\Support\Facades\DB;

class CierrePqrsServController extends Controller
{
    //
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 


        try{
            DB::beginTransaction();            

            $solucion = new CierrePqrsServ();
             // $solucion = SolServPqrs::findOrFail($request->id);
             $solucion->id_serv_pqrs = $request->id_servpqrs;        
             $solucion->desc = $request->desc;        
             $solucion->fecha = $request->fecha;      
             $solucion->id_auxiliar = \Auth::user()->id;        
             $solucion->tp_rta = $request->tpRta;        
             $solucion->tp_notifica = $request->tpNotifica;        
             $solucion->save();
         
             $ticket = TicketServ::findOrFail($request->id_servpqrs);
             $ticket->edo = $request->estado;  
             $ticket->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }


    }
}
