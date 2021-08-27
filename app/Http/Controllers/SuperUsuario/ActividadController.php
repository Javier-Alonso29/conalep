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
use Carbon\Carbon;
use CreateActividadesAdministradoresTable;
use Illuminate\Notifications\Action;

class ActividadController extends Controller
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
     *  Muestra las actividades realizadas por los usuarios del sistema
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $plantel_su = Auth::user()->id_plantel;
        $administradores = User::get();
        $planteles = Planteles::all();
        $fecha_actual = date('Y');
        /* Elminación automática de historial por año*/
        ActividadesAdministradores::whereYear('created_at','<',$fecha_actual)->delete();
        $actividades = ActividadesAdministradores::paginate(1000);
        $planteles = Planteles::paginate(10);
        $procesos = Proceso::paginate(10);
        #$administradores = User::where('rol_id',2)->get();
        $post='';
        return view('superusuario.actividades.index', compact('actividades','planteles','procesos','administradores','post','plantel_su'));
    }


    /**
     *  Muestra las actividades realizadas por los usuarios del sistema segun el filtro de tiempo seleccionado
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function filtrar(Request $request){
        $opcion = $request->filtrar_id; 
        $post=$opcion;   
        
        switch($opcion){
            case 1:
                $actividades = ActividadesAdministradores::whereDate('created_at', today())->get();
                $planteles = Planteles::paginate(10);
                $procesos = Proceso::paginate(10);
                $administradores = User::get();
                break;
            case 2:
                $actividades = ActividadesAdministradores::whereDate('created_at', Carbon::yesterday())->get();
                $planteles = Planteles::paginate(10);
                $procesos = Proceso::paginate(10);
                $administradores = User::get();
                break;
            case 3:
                $actividades = ActividadesAdministradores::where('created_at', '>=', today()->subDays(7))->get();
                $planteles = Planteles::paginate(10);
                $procesos = Proceso::paginate(10);
                $administradores = User::get();
                break;
            case 4:
                $actividades = ActividadesAdministradores::whereMonth('created_at', date('m'))->get();
                $planteles = Planteles::paginate(10);
                $procesos = Proceso::paginate(10);
                $administradores = User::get();
                break;
            case 5:
                $actividades = ActividadesAdministradores::where('created_at', '>=', today()->subDays(30))->get();
                $planteles = Planteles::paginate(10);
                $procesos = Proceso::paginate(10);
                $administradores = User::get();
                break;
            default:
                $actividades = ActividadesAdministradores::paginate(1000);
                $planteles = Planteles::paginate(10);
                $procesos = Proceso::paginate(10);
                $administradores = User::get();
            }
        return view('superusuario.actividades.index', compact('actividades','planteles','procesos','administradores','post'));
    }


}