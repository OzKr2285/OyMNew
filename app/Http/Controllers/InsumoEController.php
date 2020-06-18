<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InsumoE;

class InsumoEController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            // $insumo = InsumoE::orderBy('desc', 'asc')->paginate(15);
            $insumo = InsumoE::join('ref_equipos','insumose.id_refequipo','=','ref_equipos.id')     
            ->join('tp_equipos','ref_equipos.id_tpequipo','=','tp_equipos.id')          
            ->select('insumose.id','insumose.desc','tp_equipos.id as idTpE','ref_equipos.id as idRefE')                                               
            ->orderBy('insumose.desc', 'asc')->paginate(15);
        }
        else{
            $insumo = InsumoE::where($criterio, 'like', '%'. $buscar . '%')->orderBy('desc', 'asc')->paginate(15);
        }

        return [
            'pagination' => [
                'total'        => $insumo->total(),
                'current_page' => $insumo->currentPage(),
                'per_page'     => $insumo->perPage(),
                'last_page'    => $insumo->lastPage(),
                'from'         => $insumo->firstItem(),
                'to'           => $insumo->lastItem(),
            ],
            'insumoe' => $insumo
        ];
    }
}
