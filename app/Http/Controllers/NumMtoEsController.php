<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NumMtoEs;

class NumMtoEsController extends Controller
{
    //
    public function getNum(Request $request){
        //   if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;   
         $num = NumMtoEs::select('id','abrev','num')
         ->where('id_estacion',$buscar)->get();
        return ['num' =>  $num];
    }
}
