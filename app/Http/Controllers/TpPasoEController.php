<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TpPasoE;

class TpPasoEController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $tppasoe = TpPasoE::orderBy('nombre')->paginate(15);
        }
        else{
            $tppasoe = TpPasoE::where($criterio, 'like', '%'. $buscar . '%')->orderBy('nombre')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $tppasoe->total(),
                'current_page' => $tppasoe->currentPage(),
                'per_page'     => $tppasoe->perPage(),
                'last_page'    => $tppasoe->lastPage(),
                'from'         => $tppasoe->firstItem(),
                'to'           => $tppasoe->lastItem(),
            ],
            'tpmaterial' => $tppasoe
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tpmaterial = new TpPasoE();
        $tpmaterial->nombre = $request->nombre;        
        $tpmaterial->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tpmaterial = TpPasoE::findOrFail($request->id);
        $tpmaterial->nombre = $request->nombre;        
        $tpmaterial->save();
    }
    public function destroy(Request $request)
    {
        $tpmaterial = TpPasoE::findOrFail($request->id);
        $tpmaterial->delete();
    
    }

    public function selectTpMaterial(Request $request){
          if (!$request->ajax()) return redirect('/');
        $tpmaterial = TpMaterial::select('id','nombre')->orderBy('nombre', 'asc')->get();
        return ['tpmaterial' =>  $tpmaterial];
    }
}
