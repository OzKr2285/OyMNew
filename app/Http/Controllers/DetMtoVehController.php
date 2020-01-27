<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetMtoVeh;

class DetMtoVehController extends Controller
{
    //
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $idOficina = $request->idOficina;
            $detalles = $request->data;            //Array de detalles
            //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetMtoVeh();
                $detalle->id_oficina = $idOficina;
                $detalle->id_equipo = $det['id'];        
                $detalle->save();
            }          

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function destroy(Request $request)
    {
        $equipo = DetMtoVeh::findOrFail($request->id);
        $equipo->delete();
    
    }
}
