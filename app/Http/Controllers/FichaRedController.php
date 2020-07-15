<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FichaRed;

class FichaRedController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $fichared = FichaRed::join('det_mercados','fichared.id_mpio','=','det_mercados.id')  
            ->join('mercados','det_mercados.id_mercado','=','mercados.id')               
            ->select('fichared.tp_red','fichared.clasi','fichared.id','fichared.nombre','fichared.codigo','fichared.desc','fichared.cant_p','fichared.id_mpio','total','mercados.id as idMer','mercados.nombre as nomMercado')
            ->orderBy('fichared.tp_red', 'fichared.id_red')->paginate(15);
        }
        else{
            $fichared = FichaRed::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'descripcion')->paginate(15);
        }
        

        return [
            'pagination' => [
                'total'        => $fichared->total(),
                'current_page' => $fichared->currentPage(),
                'per_page'     => $fichared->perPage(),
                'last_page'    => $fichared->lastPage(),
                'from'         => $fichared->firstItem(),
                'to'           => $fichared->lastItem(),
            ],
            'fichared' => $fichared
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $fichared = new FichaRed();
        $fichared->id_mpio = $request->id_mpio;
        $fichared->nombre = $request->nombre;
        $fichared->desc = $request->desc;
        $fichared->cant_p = $request->cantp;
        $fichared->tp_red = $request->tp_red;
        $fichared->clasi = $request->clasi;
        $fichared->plano_g = $request->plano_g;
        $fichared->plano_a = $request->plano_a;
        $fichared->plano_c = $request->plano_c;
        $fichared->plano_p = $request->plano_p;
        $fichared->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $fichared = FichaRed::findOrFail($request->id);
        // $fichared->id_red = $request->id_red;
        $fichared->id_mpio = $request->id_mpio;
        $fichared->nombre = $request->nombre;
        $fichared->cant_p = $request->cantp;
        $fichared->tp_red = $request->tp_red;
        $fichared->clasi = $request->clasi;
        $fichared->desc = $request->desc;
        $fichared->save();
    }
    public function destroy(Request $request)
    {
        $fichared = FichaRed::findOrFail($request->id);
        $fichared->delete();
    
    }
    public function selectRed(Request $request){
        if (!$request->ajax()) return redirect('/');

        $fichared = FichaRed::select('id','nombre')
        ->orderBy('nombre', 'asc')->get();
      return ['fichared' => $fichared];
  }
}
