<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EqTrabHta;

class EqTrabHtaController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $equipo = EqTrabHta::orderBy('nombre', 'asc')->paginate(15);
        }
        else{
            $equipo = EqTrabHta::where('nombre', 'like', '%'. $buscar . '%')->orderBy('nombre', 'asc')->paginate(15);
        }

        return [
            'pagination' => [
                'total'        => $equipo->total(),
                'current_page' => $equipo->currentPage(),
                'per_page'     => $equipo->perPage(),
                'last_page'    => $equipo->lastPage(),
                'from'         => $equipo->firstItem(),
                'to'           => $equipo->lastItem(),
            ],
            'equipoe' => $equipo
        ];
    }

}
