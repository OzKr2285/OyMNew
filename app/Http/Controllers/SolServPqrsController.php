<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\SolServPqrs;
use App\TicketServ;

class SolServPqrsController extends Controller
{
    //
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 


        try{
            DB::beginTransaction();
            $mytime= Carbon::now('America/Lima');

            $solucion = new SolServPqrs();
             // $solucion = SolServPqrs::findOrFail($request->id);
             $solucion->id_serv_pqrs = $request->id_servpqrs;        
             $solucion->solucion = $request->solucion;        
             $solucion->fecha = $mytime->toDateTimeString();      
             $solucion->id_tecnico = \Auth::user()->id;        
             $solucion->save();
         
             $ticket = TicketServ::findOrFail($request->id_servpqrs);
             $ticket->edo = $request->estado;  
             $ticket->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function getSol(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;

        $solserv = SolServPqrs::join('personas','sol_serv_pqrs.id_tecnico','=','personas.id')
        ->select('personas.nombreFull as nombre','sol_serv_pqrs.id_serv_pqrs','sol_serv_pqrs.solucion','sol_serv_pqrs.fecha')
        ->where('sol_serv_pqrs.id_serv_pqrs',$buscar)
        ->orderBy('sol_serv_pqrs.fecha', 'asc')->get();
        return ['solServ' =>$solserv];
    }
}
