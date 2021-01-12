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
        $usuarios = User::where('rol_id',2)->get();

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
            
            return redirect()->route('administradores.index')->with("success","Administrador actualizado correctamente!");
        }else{
            return redirect()->route('administradores.index')->with("error","Administrador no actualizado!");
        }
    }
}