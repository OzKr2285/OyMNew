<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActividadVeh;

class ActividadVehController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $actividad = ActividadVeh::orderBy('nombre', 'asc')->paginate(15);
        }
        else{
            $actividad = ActividadVeh::where('nombre', 'like', '%'. $buscar . '%')->orderBy('nombre', 'asc')->paginate(15);
        }

        return [
            'pagination' => [
                'total'        => $actividad->total(),
                'current_page' => $actividad->currentPage(),
                'per_page'     => $actividad->perPage(),
                'last_page'    => $actividad->lastPage(),
                'from'         => $actividad->firstItem(),
                'to'           => $actividad->lastItem(),
            ],
            'actividad' => $actividad
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
       $actividad = new ActividadVeh();
       $actividad->nombre = $request->nombre;
       $actividad->desc = $request->desc;
       $actividad->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
       $actividad = ActividadVeh::findOrFail($request->id);
       $actividad->nombre = $request->nombre;
       $actividad->desc = $request->desc;
       $actividad->save();
    }
    public function destroy(Request $request)
    {
       $actividad = ActividadVeh::findOrFail($request->id);
       $actividad->delete();
    
    }

}
