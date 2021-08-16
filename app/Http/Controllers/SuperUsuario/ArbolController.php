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
        $this->middleware('SUEstatal');
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

        }
        return view('superusuario.VistaArbol', compact('process', 'subprocesos', 'documentos', 'procesosPersonales'));
    }
}