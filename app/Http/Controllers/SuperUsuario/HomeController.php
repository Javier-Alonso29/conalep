<?php

namespace App\Http\Controllers\SuperUsuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Models\Planteles;

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

        $procesos = Auth::user()->procesos;
        
        $procesos_cantidad = Auth::user()->procesos->count();
        

        return view('superusuario.home', compact('admin','cantidad_admins','procesos_cantidad'));
    }
}
