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
        $admin = User::where('rol_id',2)->get();
        $cantidad_admins = User::where('rol_id',2)->count();

        $planteles = Planteles::get();
        $cantidad_planteles = Planteles::count(); 

        $procesos = Auth::user()->procesos;
        
        $procesos_cantidad = Auth::user()->procesos->count();
        

        return view('SUEstatal.home', compact('admin','cantidad_admins','planteles','cantidad_planteles','procesos_cantidad'));
    }
}
