<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ValDetProtocolo;

class ValDetProtocoloController extends Controller
{
    //
    public function index(Request $request){
        $buscar = $request->buscar;
        // if (!$request->ajax()) return redirect('/');

        $prot = ValDetProtocolo::join('val_variables','val_det_protocolo.id_variable','=','val_variables.id')
        ->join('etapas','val_det_protocolo.id_etapa','=','etapas.id')
        ->select('val_variables.nombre','etapas.nombre as nomEtapa','val_det_protocolo.brazo_ppal','val_det_protocolo.brazo_bypass','val_det_protocolo.is_valida','val_det_protocolo.valor','val_det_protocolo.signo','val_det_protocolo.valor2','val_det_protocolo.obs')
        ->where('val_det_protocolo.id_protocolo',$buscar)
        ->get();
      return ['prot' => $prot];
  }
}
