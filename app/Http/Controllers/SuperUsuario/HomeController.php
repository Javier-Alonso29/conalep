<?php

namespace App\Http\Controllers\SuperUsuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Models\Planteles;
use App\Models\Proceso;
use App\Models\Subproceso;
use App\Models\Tipodocumento;
use App\Models\ProcesoPersonal;
use App\Models\Documento;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $admin = User::where('rol_id',2)->where('id_plantel', Auth::user()->id_plantel)->get();
        $cantidad_admins = $admin->count();

        $planteles = Planteles::get();
        $cantidad_planteles = Planteles::count(); 

        $procesos = Proceso::all();
        // Se obtiene el conteo de los procesos del usuario, en este caso, al ser el estatal cuenta con todos.
        $procesos_cantidad = $procesos->count();
        // Se obtienen la cantidad de subprocesos dentro de los registros.
        $subprocesos_cantidad = Subproceso::all()->count();
        // Se obtienen la cantidad de tipos de documentos dentro de los registros.
        $cantidad_tipos_documentos = Tipodocumento::all()->count();
        // Se obtienen todos los procesos personales que han sido registrados dentro del sistema por el plantel especifico.
        $procesos_personales_array = ProcesoPersonal::where('id_plantel', '=', Auth::user()->id_plantel)->get();
        // Se hace un conteo a todos los procesos personales que han sido creados en el plantel.
        $cantidad_procesos = $procesos_personales_array->count();
        // Se crea un arreglo en el que se van a almacenar todos los ids de los procesos que contienen un documento.
        $procesos_id = array();
        foreach($procesos_personales_array as $proceso){
            $ids = $proceso->id;
            array_push($procesos_id, $ids);
        }
        
        // Se obtienen la cantidad de documentos dentro de los registros que coinciden con los procesos personales del plantel.
        $cantidad_documentos = Documento::whereIn('id_proceso_personal', $procesos_id)->count();

        return view('superusuario.home', compact('admin','cantidad_admins','procesos_cantidad',
                                        'subprocesos_cantidad', 'cantidad_tipos_documentos', 'cantidad_documentos', 'cantidad_procesos'));
    }
}
