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
        $procesos = Auth::user()->procesos;
        $documentos = array();
        foreach($procesos as $proceso)
        {
            // Se obtienen todos los procesos registrados.
            $subproceso = $proceso->subprocesos;
            // Se obtienen los subprocesos que cada proceso tiene.
            array_push($subprocesos, $subproceso);
            // Se crea un ciclo para obtener los documentos registrados en cada subproceso.
            foreach($subproceso as $sb)
            {
                // Se obtiene el objeto de arreglo de documentos por subproceso.
                $documento = $sb->documentos;
                // Se almacena el arreglo dentro de otro arreglo de arreglos
                array_push($documentos, $documento);
            }
        } 

        return view('superusuario.VistaArbol', compact('procesos', 'subprocesos', 'documentos'));
    }
}