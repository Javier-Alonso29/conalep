<?php

namespace App\Http\Controllers\SuperUsuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Http\Requests\CreateAdministradorRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\PermisosProcesos;
use SebastianBergmann\Environment\Console;
use App\Models\ActividadesAdministradores;

class AdministradoresController extends Controller
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
        $usuarios = User::where('rol_id',2)->paginate(10);

        return view('superusuario.administradores.index', compact('usuarios'));
    }

    /**
     * Metodo para crear un admin
     */
    public function store(CreateAdministradorRequest $request)
    {
        $usuario = new User($request->all());
        $usuario->password = bcrypt($request->password);
        $usuario->rol_id = 2;
        $usuario->save();

        $permisos = new PermisosProcesos($request->all());
        $permisos->id_user = $usuario->id;
        $permisos->id_plantel = 1;
        $permisos->id_proceso = 1;
        $permisos->leer = 0;
        $permisos->subir = 0;
        $permisos->descargar = 0;
        $permisos->borrar = 0;
        $permisos->save();

        $actividades = ActividadesAdministradores::orderBy('id','desc')->first();
        if ($actividades == null){
            $actividad = new ActividadesAdministradores($request->all());
            $actividad->id=1;
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Registró al usuario "'.$request->name.' '.$request->apellido_paterno.' '.$request->apellido_materno.'"';
            $actividad->save();
        }else{
            $actividad = new ActividadesAdministradores($request->all());
            $actividad->id = ($actividades->id)+1;
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Registró al usuario "'.$request->name.' '.$request->apellido_paterno.' '.$request->apellido_materno.'"';
            $actividad->save();
        }


        return redirect()->route('administradores.index')->With('success', 'El administrador '.$usuario->name.' '.$usuario->ap_paterno.' se creo con exito');
       
    }
    
    /**
     * Metodo que elimina un admin selecccionado
     */
    public function destroy(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'contraseña' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (Hash::check($value, Auth::user()->password)) {
                    }
                    else{
                        $fail('Contraseña Incorrecta');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator,'delete')
            ->withInput()
            ->With('error', 'Contraseña incorrecta, proceso no borrado.');
        }

        $usuario = User::FindOrFail($request->id);

        $actividades = ActividadesAdministradores::orderBy('id','desc')->first();
        if ($actividades == null){
            $actividad = new ActividadesAdministradores();
            $actividad->id=1;
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Dio de baja al usuario "'.$usuario->name.' '.$usuario->apellido_paterno.' '.$usuario->apellido_materno.'"';
            $actividad->save();
        }else{
            $actividad = new ActividadesAdministradores();
            $actividad->id = ($actividades->id)+1;
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Dio de baja al usuario "'.$usuario->name.' '.$usuario->apellido_paterno.' '.$usuario->apellido_materno.'"';
            $actividad->save();
        }

        $usuario->delete();

        
        return redirect()->route('administradores.index')->With('success', 'Se borro correctamente el administrador');
        
    }

    /**
     * Metodo para editar un admin
     */
    public function update(Request $request)
    {

        //Valida que el admin tenga un nombre
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'email' => 'required',
        ],[
            'name.required'=>'Debes asignar un nombre al administrador',
            'apellido_paterno.required'=>'Debes asignar un apellido paterno al administrador',
            'apellido_materno.required'=>'Debes asignar un apellido materno al administrador',
            'email.required' => 'Debes de asignar un correo al administrador',
        ]);

        if ($validator->fails())
        {
            return back()->withErrors($validator)
            ->withInput()->With('error', 'Administrador no actualizado');
        }

        $usuario = User::FindOrFail($request->id);
        $usuario->fill($request->all());
        

        if ($usuario->save()) {
            
            $actividades = ActividadesAdministradores::orderBy('id','desc')->first();
        if ($actividades == null){
            $actividad = new ActividadesAdministradores();
            $actividad->id=1;
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Actualizó al usuario "'.$usuario->name.' '.$usuario->apellido_paterno.' '.$usuario->apellido_materno.'"';
            $actividad->save();
        }else{
            $actividad = new ActividadesAdministradores();
            $actividad->id = ($actividades->id)+1;
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Actualizó al usuario "'.$usuario->name.' '.$usuario->apellido_paterno.' '.$usuario->apellido_materno.'"';
            $actividad->save();
        }

            return redirect()->route('administradores.index')->with("success","Administrador actualizado correctamente!");
        }else{
            return redirect()->route('administradores.index')->with("error","Administrador no actualizado!!!! :(");
        }
    }



}