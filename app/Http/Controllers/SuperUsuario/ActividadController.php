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
        $opcion = $request->filtro_id;
        $hoy = date("Y-m-d H:i:s");
        $ayer = date("Y-m-d H:i:s", strtotime("yesterday"));
        echo $opcion;

        if ($opcion == 1){

            $actividades = ActividadesAdministradores::paginate(1000)->where('created_at',$hoy);
            $planteles = Planteles::paginate(10);
            $procesos = Proceso::paginate(10);
            $administradores = User::where('rol_id',2)->get();

        }else if ($opcion == 2){

            $actividades = ActividadesAdministradores::paginate(1000)->where('created_at',$ayer);
            $planteles = Planteles::paginate(10);
            $procesos = Proceso::paginate(10);
            $administradores = User::where('rol_id',2)->get();

        }else if ($opcion == 3){

            $actividades = ActividadesAdministradores::paginate(1000);
            $planteles = Planteles::paginate(10);
            $procesos = Proceso::paginate(10);
            $administradores = User::where('rol_id',2)->get();

        }else if ($opcion == 4){

            $actividades = ActividadesAdministradores::paginate(1000);
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