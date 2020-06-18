<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EqTrabajoE;

class EqTrabajoEController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $equipo = EqTrabajoE::orderBy('desc', 'asc')->paginate(15);
        }
        else{
            $equipo = EqTrabajoE::where($criterio, 'like', '%'. $buscar . '%')->orderBy('desc', 'asc')->paginate(15);
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
