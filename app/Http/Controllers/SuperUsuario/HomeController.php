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
        $admin = User::where('rol_id',2)->get();
        $cantidad_admins = User::where('rol_id',2)->count();

        $planteles = Planteles::get();
        $cantidad_planteles = Planteles::count(); 

        $procesos = Proceso::all();
        // Se obtiene el conteo de los procesos del usuario, en este caso, al ser el estatal cuenta con todos.
        $procesos_cantidad = $procesos->count();
        // Se obtienen la cantidad de subprocesos dentro de los registros.
        $subprocesos_cantidad = Subproceso::all()->count();
        // Se obtienen la cantidad de tipos de documentos dentro de los registros.
        $cantidad_tipos_documentos = Tipodocumento::all()->count();
        // Se obtienen la cantidad de documentos dentro de los registros.
        $cantidad_documentos = Documento::all()->count();
        

        return view('superusuario.home', compact('admin','cantidad_admins','procesos_cantidad',
                                        'subprocesos_cantidad', 'cantidad_tipos_documentos', 'cantidad_documentos'));
    }
}
