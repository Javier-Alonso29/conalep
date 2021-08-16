<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Http\Requests\CreateAdministradorRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use SebastianBergmann\Environment\Console;
use App\Models\ActividadesAdministradores;
use App\Models\Planteles;

class PerfilController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    /**
     *  Muestra los datos del perfil del administrador
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $planteles = Planteles::all();
        return view('administrador.perfil.index',compact('planteles','user'));
    }

      /**
     * Metodo para editar perfil de un administrador.
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
            ->withInput()->With('error', 'Perfil no actualizado');
        }

        $usuario = User::FindOrFail($request->id);
        $usuario->fill($request->all());
        

        if ($usuario->save()) {
            
            $actividades = ActividadesAdministradores::orderBy('id','desc')->first();
        if ($actividades == null){
            $actividad = new ActividadesAdministradores();
            $actividad->id=1;
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Actualizó su perfil el usuario "'.$usuario->name.' '.$usuario->apellido_paterno.' '.$usuario->apellido_materno.'"';
            $actividad->save();
        }else{
            $actividad = new ActividadesAdministradores();
            $actividad->id = ($actividades->id)+1;
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Actualizó su perfil el usuario "'.$usuario->name.' '.$usuario->apellido_paterno.' '.$usuario->apellido_materno.'"';
            $actividad->save();
        }

            return redirect()->route('perfil.index')->with("success","Perfil actualizado correctamente!");
        }else{
            return redirect()->route('perfil.index')->with("error","Perfil no actualizado!!!! :(");
        }
    }


    /**
     * Metodo para cambiar contraseña de un admin
     */
    public function cambiarpass(Request $request)
    {


        //Valida que el admin tenga un nombre
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ],[
            'old_password.required'=>'Debes de ingresar la contraseña que tienes actualmente',
            'new_password.required'=>'Debes de ingresar la nueva contraseña que vas a utilizar',
            'confirm_password.required'=>'Debes de confirmar la nueva contraseña que vas a utilizar',
        ]);

        

        if ($validator->fails())
        {
            return back()->withErrors($validator)
            ->withInput()->With('error', 'Perfil no actualizado');
        }
        

        

        $usuario = User::FindOrFail($request->id);

        if(! Hash::check($request->old_password,$usuario->password)){
            return redirect()->route('perfil.index')->with('error', 'Perfil no actualizado, inserta tu contraseña que tienes actualmente');
        }

        if($request->new_password != $request->confirm_password){
            return redirect()->route('perfil.index')->with('error', 'Perfil no actualizado, contraseñas no coinciden');
        }

        if(Hash::check($request->new_password,$usuario->password)){
            return redirect()->route('perfil.index')->with('error', 'Perfil no actualizado, la nueva contraseña no debe ser igual a la anterior');
        }

        $usuario->password = Hash::make($request->new_password);
        

        if ($usuario->save()) {
            
            $actividades = ActividadesAdministradores::orderBy('id','desc')->first();
        if ($actividades == null){
            $actividad = new ActividadesAdministradores();
            $actividad->id=1;
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Cambio su contraseña el usuario "'.$usuario->name.' '.$usuario->apellido_paterno.' '.$usuario->apellido_materno.'"';
            $actividad->save();
        }else{
            $actividad = new ActividadesAdministradores();
            $actividad->id = ($actividades->id)+1;
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Cambio su contraseña el usuario "'.$usuario->name.' '.$usuario->apellido_paterno.' '.$usuario->apellido_materno.'"';
            $actividad->save();
        }

            return redirect()->route('perfil.index')->with("success","Contraseña actualizada correctamente!");
        }else{
            return redirect()->route('perfil.index')->with("error","Contrase{a no actualizada!!!! :(");
        }
    }


}