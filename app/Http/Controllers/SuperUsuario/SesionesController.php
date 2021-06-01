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
use Carbon\Carbon;

class SesionesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('SuperUsuario');
    }

    /**
     *  Muestra los administradores que el superusuario puede editar
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sesiones = Sesiones::paginate(1000);
        $administradores = User::where('rol_id',2)->get();
        return view('superusuario.sesiones.index', compact('administradores','sesiones'));
    }

    public function filtrar(Request $request){

        $opcion = $request->filtrar_id;
        
        switch($opcion){
            case 1:
                $sesiones = Sesiones::whereDate('date_time', today())->get();
                $administradores = User::where('rol_id',2)->get();
                break;
            case 2:
                $sesiones = Sesiones::whereDate('date_time', Carbon::yesterday())->get();
                $administradores = User::where('rol_id',2)->get();
                break;
            case 3:
                $sesiones = Sesiones::where('date_time', '>=', today()->subDays(7))->get();
                $administradores = User::where('rol_id',2)->get();
                break;
            case 4:
                $sesiones = Sesiones::whereMonth('date_time', date('m'))->get();
                $administradores = User::where('rol_id',2)->get();
                break;
            case 5:
                $sesiones = Sesiones::where('date_time', '>=', today()->subDays(30))->get();
                $administradores = User::where('rol_id',2)->get();
                break;
            default:
                $sesiones = Sesiones::paginate(1000);
                $administradores = User::where('rol_id',2)->get();
        }
        return view('superusuario.sesiones.index', compact('administradores','sesiones'));
    }

}
