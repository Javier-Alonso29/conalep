<?php

namespace App\Http\Controllers\SUEstatal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Models\Planteles;

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
        $procesos = Auth::user()->procesos;
        // Se obtiene el conteo de los procesos del usuario.
        $procesos_cantidad = Auth::user()->procesos->count();
        

        return view('SUEstatal.home', compact('admin','cantidad_admins','planteles','cantidad_planteles','procesos_cantidad'));
    }
}
