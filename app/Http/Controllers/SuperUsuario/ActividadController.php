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


    public function eliminar()
    {
        ActividadesAdministradores::truncate();

        $actividades = ActividadesAdministradores::paginate(1000);

        $planteles = Planteles::paginate(10);

        $procesos = Proceso::paginate(10);

        $administradores = User::where('rol_id',2)->get();

        return view('superusuario.actividades.index', compact('actividades','planteles','procesos','administradores'));
    }

    public function filtrar(Request $request){
        $opcion = $request->filtrar_id;

        $hoy = date("Y-m-d",strtotime("today"));
        $ayer = date("Y-m-d", strtotime("yesterday"));
        $tomorrow = date("Y-m-d", strtotime("tomorrow"));
        $medianoche = date("Y-m-d",strtotime("today 24:00:00"));
        $medianoche2 = date("Y-m-d",strtotime("yesterday 24:00:00"));

        if ($opcion == 1){

            
        
            $actividades = ActividadesAdministradores::paginate(1000)->whereBetween('created_at',[$hoy,$medianoche]);
            $planteles = Planteles::paginate(10);
            $procesos = Proceso::paginate(10);
            $administradores = User::where('rol_id',2)->get();

        }else if ($opcion == 2){

            $actividades = ActividadesAdministradores::paginate(1000)->whereBetween('created_at',[$ayer,$medianoche2]);
            $planteles = Planteles::paginate(10);
            $procesos = Proceso::paginate(10);
            $administradores = User::where('rol_id',2)->get();

        }else if ($opcion == 3){
            $FirstDay = date("Y-m-d", strtotime('monday this week'));  
            $LastDay = date("Y-m-d", strtotime('sunday this week'));  
            
            $actividades = ActividadesAdministradores::paginate(1000)->whereBetween('created_at',[$FirstDay,$LastDay]);
            $planteles = Planteles::paginate(10);
            $procesos = Proceso::paginate(10);
            $administradores = User::where('rol_id',2)->get();

        }else if ($opcion == 4){
            $primer = date('Y-m-d', strtotime('first day of this month'));
            $ultimo = date('Y-m-d', strtotime('last day of this month'));

            $actividades = ActividadesAdministradores::paginate(1000)->whereBetween('created_at',[$primer,$ultimo]);
            $planteles = Planteles::paginate(10);
            $procesos = Proceso::paginate(10);
            $administradores = User::where('rol_id',2)->get();

        }else if ($opcion == 5){
            $mes = date('Y-m-d', strtotime('last day of this month'));
            $mes_anterior = date('Y-m-d', strtotime('-2 months'));
            

            $actividades = ActividadesAdministradores::paginate(1000)->whereBetween('created_at',[$mes_anterior,$mes]);
            $planteles = Planteles::paginate(10);
            $procesos = Proceso::paginate(10);
            $administradores = User::where('rol_id',2)->get();

        }else{

            $actividades = ActividadesAdministradores::paginate(1000);
            $planteles = Planteles::paginate(10);
            $procesos = Proceso::paginate(10);
            $administradores = User::where('rol_id',2)->get();

        }
        return view('superusuario.actividades.index', compact('actividades','planteles','procesos','administradores'));
    }


}