<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;

class ActividadController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $actividad = Actividad::orderBy('nombre', 'asc')->paginate(15);
        }
        else{
            $actividad = Actividad::where($criterio, 'like', '%'. $buscar . '%')->orderBy('nombre', 'asc')->paginate(15);
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
       $actividad = new Actividad();
       $actividad->nombre = $request->nombre;
       $actividad->duracion = $request->duracion;
       $actividad->equivale = $request->equivale;
       $actividad->is_equipo = $request->is_equipo;
       $actividad->desc = $request->desc;
       $actividad->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
       $actividad = Actividad::findOrFail($request->id);
       $actividad->nombre = $request->nombre;
       $actividad->duracion = $request->duracion;
       $actividad->equivale = $request->equivale;
       $actividad->is_equipo = $request->is_equipo;
       $actividad->desc = $request->desc;
       $actividad->save();
    }
    public function destroy(Request $request)
    {
       $actividad = Actividad::findOrFail($request->id);
       $actividad->delete();
    
    }
    public function selectAct(Request $request){
        // if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        if ($buscar==''){
            $actividad = Actividad::orderBy('nombre', 'asc')->get();
        }
        else{
            $actividad = Actividad::where('nombre', 'like', '%'. $buscar . '%')
            ->orderBy('nombre', 'asc')->get();
        }   

        return ['act' => $actividad];
  }
    public function selectActRed(Request $request){
        // if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        if ($buscar==''){
            $actividad = Actividad::where('is_equipo',3)
            ->orderBy('nombre', 'asc')->get();
        }
        else{
            $actividad = Actividad::where('is_equipo',3)
            ->where('nombre', 'like', '%'. $buscar . '%')
            ->orderBy('nombre', 'asc')->get();
        }   

        return ['act' => $actividad];
  }
}
