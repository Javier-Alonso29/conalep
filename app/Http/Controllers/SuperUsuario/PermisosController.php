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

class PermisosController extends Controller
{
    

    /**
     *  Muestra los administradores que el superusuario puede editar
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $permisos = PermisosProcesos::paginate(10);
        $planteles = Planteles::paginate(10);
        $procesos = Proceso::paginate(10);
        $administradores = User::where('rol_id',2)->get();

        return view('superusuario.permisos.index', compact('permisos','planteles','procesos','administradores'));
    }

    /**
     * Metodo para crear un permiso
     */
    public function store(CreatePermisoRequest $request)
    {
        $permiso = new PermisosProcesos($request->all());
        $permiso->id_plantel = $request->id_plantel;
        $permiso->id_proceso = $request->id_proceso;
        $permiso->id_user = $request->id_user;
        $permiso->leer = $request->leer;
        $permiso->descargar = $request->descargar;
        $permiso->subir = $request->subir;
        $permiso->borrar = $request->borrar;

        
        
        $permiso->save();

        return redirect()->route('permisos.index')->With('success', 'Al administrador se le otorgaron permiso con exito');
       
    }

      /**
     * Metodo que elimina un permiso selecccionado
     */
    public function destroy(Request $request,$id)
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
            ->With('error', 'Contraseña incorrecta, permisos no borrados.');
        }

        $permiso = PermisosProcesos::where(['id_plantel' => $request->id_plantel,
                                            'id_user' => $request->id_user,
                                            'id_proceso' => $request->id_proceso]);

        
        $permiso->delete();

        
        return redirect()->route('permisos.index')->With('success', 'Se quitaron correctamente los permisos a el administrador');
        
    }
    
    /**
     * Metodo que elimina un permiso selecccionado
     */
    public function eliminar(Request $request,$id)
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
            ->withErrors($validator,'eliminar')
            ->withInput()
            ->With('error', 'Contraseña incorrecta, permisos no borrados.');
        }

        $permiso = PermisosProcesos::where(['id_plantel' => $request->id_plantel,
                                            'id_user' => $request->id_user,
                                            'id_proceso' => $request->id_proceso]);

        
        $permiso->delete();

        
        return redirect()->route('permisos.index')->With('success', 'Se quitaron correctamente los permisos a el administrador');
        
    }

    /**
     * Metodo para editar un admin
     */
    public function update(Request $request)
    {

        //Valida que el admin tenga un nombre
        $validator = Validator::make($request->all(), [
            'id_plantel' => 'required',
            'id_proceso' => 'required',
            'id_user'=>'required',
        ],[
            'id_plantel' => 'Debes de asignar un plantel al administrador',
            'id_proceso' => 'Debes de asignar un proceso al administrador',
            'id_user'=>'Debes de asignar un administrador al cual otorgarle los permisos',
        ]);

        if ($validator->fails())
        {
            return back()->withErrors($validator)
            ->withInput()->With('error', 'Permisos del administrador no actualizados');
        }

        $permiso = PermisosProcesos::where(['id_plantel' => $request->id_plantel,
                                            'id_user' => $request->id_user,
                                            'id_proceso' => $request->id_proceso],)->first();

        
        $permiso->id_plantel = $request->id_plantel;
        $permiso->id_proceso = $request->id_proceso;
        $permiso->id_user = $request->id_user;
        $permiso->leer = $request->leer;
        $permiso->descargar = $request->descargar;
        $permiso->subir = $request->subir;
        $permiso->borrar = $request->borrar;
        
        
        if ($permiso->save()) {
            
            return redirect()->route('permisos.index')->with("success","Permisos del administrador actualizados correctamente!");
        }else{
            return redirect()->route('permisos.index')->with("error","Permisos del administrador no actualizados correctamente!");
        }
    }


     /**
     * Metodo que regresa una lista de planteles
     */
    public function api_planteles()
    {
        return Planteles::get();
    }


     /**
     * Metodo que regresa una lista de procesos
     */
    public function api_procesos()
    {
        return Proceso::get();
    }

     /**
     * Metodo que regresa una lista de usuarios
     */
    public function api_usuarios()
    {
        return User::get();
    }

}