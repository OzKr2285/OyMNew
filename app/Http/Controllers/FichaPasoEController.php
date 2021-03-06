<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FichaPasoE;

class FichaPasoEController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $fichapasoe =FichaPasoE::join('fichared','ficha_pasoe.id_red','=','fichared.id')                
            ->select('ficha_pasoe.id','fichared.nombre as nomRed','ficha_pasoe.id_red','ficha_pasoe.nombre','ficha_pasoe.desc')
            ->orderBy('ficha_pasoe.id', 'asc')->paginate(15);
        }
        else{
            $fichapasoe = FichaPasoE::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $fichapasoe->total(),
                'current_page' => $fichapasoe->currentPage(),
                'per_page'     => $fichapasoe->perPage(),
                'last_page'    => $fichapasoe->lastPage(),
                'from'         => $fichapasoe->firstItem(),
                'to'           => $fichapasoe->lastItem(),
            ],
            'fichapasoe' => $fichapasoe
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $fichapasoe = new FichaPasoE();
        $fichapasoe->id_red = $request->id_red;
        $fichapasoe->codigo = $request->codigo;
        $fichapasoe->nombre = $request->nombre;
        $fichapasoe->desc = $request->desc;
        $fichapasoe->nivel = $request->nivel;
        $fichapasoe->id_tp_estru = $request->id_tp_estru;
        $fichapasoe->id_tp_tub = $request->id_tp_tub;
        $fichapasoe->fec_opera = $request->fec_opera;
        $fichapasoe->total = $request->total;
        $fichapasoe->plano = $request->plano;

        $fichapasoe->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $fichapasoe = FichaPasoE::findOrFail($request->id);
        $fichapasoe->id_red = $request->id_red;
        $fichapasoe->codigo = $request->codigo;
        $fichapasoe->nombre = $request->nombre;
        $fichapasoe->desc = $request->desc;
        $fichapasoe->nivel = $request->nivel;
        $fichapasoe->id_tp_estru = $request->id_tp_estru;
        $fichapasoe->id_tp_tub = $request->id_tp_tub;
        $fichapasoe->fec_opera = $request->fec_opera;
        $fichapasoe->total = $request->total;
        $fichapasoe->plano = $request->plano;
        
        $fichapasoe->save();
    }
    public function destroy(Request $request)
    {
        $fichapasoe = FichaPasoE::findOrFail($request->id);
        $fichapasoe->delete();
    
    }
    public function selectPaso(Request $request){
        // if (!$request->ajax()) return redirect('/');

        $fichapasoe = FichaPasoE::select('id','nombre')
        ->orderBy('nombre', 'asc')->get();
      return ['fichapasoe' => $fichapasoe];
  }
}
