<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Subproceso;
use App\Models\ProcesoPersonal;
use App\Models\Tipodocumento;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $procesos = Auth::user()->procesos;
        $procesos_cantidad = Auth::user()->procesos->count();

        $subprocesos_array = array();

        foreach($procesos as $proceso){
            $subprocesos = $proceso->subprocesos;
            array_push($subprocesos_array, $subprocesos);
        }
        
        $procesos_personales_array = array();
        $cantidad_procesos = 0;

        foreach($subprocesos_array as $collection){
            foreach($collection as $subproceso){
                $proceso_personal = $subproceso->procesospersonales;
                array_push($procesos_personales_array, $proceso_personal);
            }
        }

        // Se obtienen la cantidad de subprocesos dentro de los registros.
        $subprocesos_cantidad = Subproceso::all()->count();
        // Se obtienen la cantidad de tipos de documentos dentro de los registros.
        $cantidad_tipos_documentos = Tipodocumento::all()->count();


        $documentos_array = array();
        
        $cantidad_procesos = ProcesoPersonal::where('id_usuario', '=', Auth::user()->id)->get()->count();

        return view('administrador.home', compact('procesos_cantidad', 'documentos_array', 'subprocesos_cantidad',
                                                    'cantidad_procesos', 'cantidad_tipos_documentos'));
    }
}
