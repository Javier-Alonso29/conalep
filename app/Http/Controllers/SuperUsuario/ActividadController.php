<?php

namespace App\Http\Controllers\SuperUsuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Http\Requests\CreatePermisoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\PermisosProcesos;
use App\Models\Planteles;
use App\Models\Proceso;
use App\Models\ActividadesAdministradores;

class ActividadController extends Controller
{
    

    /**
     *  Muestra los administradores que el superusuario puede editar
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $actividades = ActividadesAdministradores::paginate(1000);
        $planteles = Planteles::paginate(10);
        $procesos = Proceso::paginate(10);
        $administradores = User::where('rol_id',2)->get();
        return view('superusuario.actividades.index', compact('actividades','planteles','procesos','administradores'));
    }


}