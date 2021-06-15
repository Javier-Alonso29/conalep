<?php

namespace App\Http\Controllers\SUEstatal;

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
    public function index()
    {
        // Se obtiene la lista de administradores que se observan dentro de la página principal.
        $admin = User::where('rol_id',2)->get();
        // Se obtiene el conteo de la lista de administradores.
        $cantidad_admins = User::where('rol_id',2)->count();
        // Se obtiene la lista de planteles que se pueden observar dentro de la página principal.
        $planteles = Planteles::get();
        // Se obtiene el conteo de la lista de planteles.
        $cantidad_planteles = Planteles::count(); 
        // Se obtienen los procesos del usuario registrado.
        $procesos = Proceso::all();
        // Se obtiene el conteo de los procesos del usuario, en este caso, al ser el estatal cuenta con todos.
        $procesos_cantidad = $procesos->count();
        // Se obtienen la cantidad de subprocesos dentro de los registros.
        $subprocesos_cantidad = Subproceso::all()->count();
        // Se obtienen la cantidad de tipos de documentos dentro de los registros.
        $cantidad_tipos_documentos = Tipodocumento::all()->count();
        // Se obtienen la cantidad de documentos dentro de los registros.
        $cantidad_documentos = Documento::all()->count();
        

        return view('SUEstatal.home', compact('admin','cantidad_admins','planteles','cantidad_planteles','procesos_cantidad',
                                                'subprocesos_cantidad', 'cantidad_tipos_documentos', 'cantidad_documentos'));
    }
}
