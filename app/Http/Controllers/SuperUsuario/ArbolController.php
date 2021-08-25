<?php

namespace App\Http\Controllers\SuperUsuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Auth;
use App\Models\Subproceso;
use App\Models\ProcesoPersonal;
use App\Models\Documento;
use App\Models\Proceso;

class ArbolController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('SuperUsuario');
    }

    /**
     *  Muestra los administradores que el superusuario puede editar
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function arbol()
    {
        // Se obtienen todos los procesos, subprocesos, procesos personales y documentos que se ha guardado y se 
        // se filtran de acuerdo al usuario que los esté revisando.
        if(Auth::user()->rol_id == 3){
            $subprocesos = Subproceso::all();
            $process = Proceso::all();
            $documentos = Documento::all();
            $procesosPersonales = ProcesoPersonal::all();
        }else{
            $subprocesos = Subproceso::all();
            $process = Proceso::all();
            $procesosPersonales = ProcesoPersonal::where('id_plantel', Auth::user()->id_plantel)->get();
            $procesos_id = array();
            foreach($procesosPersonales as $proceso){
                $ids = $proceso->id;
                array_push($procesos_id, $ids);
            }
            
            $documentos = Documento::whereIn('id_proceso_personal', $procesos_id)->get();
        }
        return view('superusuario.VistaArbol', compact('process', 'subprocesos', 'documentos', 'procesosPersonales'));
    }
}