<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TpMaterialRed;

class TpMaterialRedCOntroller extends Controller
{
    //


    public function selectTpMaterial(Request $request){
        if (!$request->ajax()) return redirect('/');
      $tpmaterial = TpMaterialRed::select('id','nombre')->orderBy('nombre', 'asc')->get();
      return ['tpmaterial' =>  $tpmaterial];
  }
}
