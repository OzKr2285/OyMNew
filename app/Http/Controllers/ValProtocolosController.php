<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ValProtocolos;

class ValProtocolosController extends Controller
{
    //
    public function selectPro(Request $request){
        $buscar = $request->buscar;
        $id = 0;
        // if (!$request->ajax()) return redirect('/');
        $prot = ValProtocolos::select('id')
        ->where('id_estacion',$buscar)
        ->get();

        foreach($prot as $ep=>$det)
        {
            $id =$det['id'] ;
        } 
      return ['prot' => $id];
  }
}
