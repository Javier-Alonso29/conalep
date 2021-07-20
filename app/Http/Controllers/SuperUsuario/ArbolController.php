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
use App\Models\Sesiones;
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
        // Se crea un arreglo de subprocesos.
        $subprocesos = array();
        // Se obtienen
        $process = Proceso::all();
        //dd($process);
        $documentos = array();
        $procesosPersonales = array();
        foreach($process as $proceso)
        {
            // Se obtienen todos los procesos registrados.
            $subproceso = $proceso->subprocesos;
            //dd($subproceso);
            // Se obtienen los subprocesos que cada proceso tiene.
            array_push($subprocesos, $subproceso);
            // Se crea un ciclo para obtener los documentos registrados en cada subproceso.
            foreach($subproceso as $subprocess)
            {
                // Se obtiene el objeto de arreglo de documentos por subproceso.
                $procesoPer = $subprocess->procesospersonales;
                //dd($procesoPer);
                // Se almacena el arreglo dentro de otro arreglo de arreglos
                array_push($procesosPersonales, $procesoPer);

                foreach($procesoPer as $ProcesoP)
                {
                    $documento = $ProcesoP->documentos;
                    array_push($documentos, $documento);
                }
            }
        } 

        return view('superusuario.VistaArbol', compact('process', 'subprocesos', 'documentos', 'procesosPersonales'));
    }
}