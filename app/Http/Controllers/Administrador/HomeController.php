<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

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

        foreach($subprocesos_array as $collection){
            foreach($collection as $subproceso){
                $proceso_personal = $subproceso->procesospersonales;
                array_push($procesos_personales_array, $proceso_personal);
            }
        }

        $documentos_array = array();
        
        foreach($procesos_personales_array as $collection){
            foreach($collection as $proceso_personal){
                $documentos = $proceso_personal->documentos;
                array_push($documentos_array, $documentos);
            }
        }

        

        return view('administrador.home', compact('procesos_cantidad', 'documentos_array'));
    }
}
