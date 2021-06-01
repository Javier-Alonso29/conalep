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

        $subprocesos = array();
        $procesos = Auth::user()->procesos;
        $documentos = array();
        foreach($procesos as $proceso)
        {
            $subproceso = $proceso->subprocesos;
            
            array_push($subprocesos, $subproceso);

            foreach($subproceso as $sb)
            {
                $documento = $sb->documentos;
                array_push($documentos, $documento);
            }
        } 

        return view('superusuario.VistaArbol', compact('procesos', 'subprocesos', 'documentos'));
    }
}