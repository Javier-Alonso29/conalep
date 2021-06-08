<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proceso;
use Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Http\Requests\CreateProcesoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\ActividadesAdministradores;
use App\Models\Planteles;

class ProcesosController extends Controller
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
     *  Muestra los procesos que tiene el administrador
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $procesos = Auth::user()->procesos;
        
        return view('administrador.procesos.index', compact('procesos'));
    }


    /**
     * Metodo para crear un proceso
     */
    public function store(CreateProcesoRequest $request)
    {
        $proceso = Proceso::create($request->all());
        $access = Storage::makeDirectory('public/' . $proceso->codigo);
        Storage::setVisibility('public/' . $proceso->codigo,'public');

        // Asigamos el proceso al usuario logeado
        Auth::user()->procesos()->attach($proceso->id);

        // En caso de que el usuario logeado no sea el super usuario
        // Es un administrador por lo que necesisitamos buscar al super usuario y asignarlo
        if(Auth::user()->roles->id != 1){

            $plantel = Planteles::find(Auth::user()->plantel->id); 
            $usuarios_plantel = $plantel->usuarios;

            foreach($usuarios_plantel as $usuario){

                if($usuario->roles->id == 1){

                    // Validar que el usuario sea el super usuario del plantel
                    // Para asi asignar el nuevo proceso al super usuario
                    $usuario->procesos()->attach($proceso->id);

                }

            }

        }

        if($access === true ){

            $actividades = ActividadesAdministradores::orderBy('id','desc')->first();
            if ($actividades == null){
                $actividad = new ActividadesAdministradores($request->all());
                $actividad->id=1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Creó el proceso "'.$request->nombre.'" ('.$request->codigo.')';
                $actividad->save();
            }else{
                $actividad = new ActividadesAdministradores($request->all());
                $actividad->id = ($actividades->id)+1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Creó el proceso "'.$request->nombre.'" ('.$request->codigo.')';
                $actividad->save();
            }

            return redirect()->route('procesos.index')->With('success', 'El proceso '.$proceso->codigo.' se creo con exito');

        }else{
        

            if ($access === true) {
                return redirect()->route('procesos.index')->With('success', 'El prceso ' . $proceso->codigo . ' se creo con exito');
            } else {
                return redirect()->route('procesos.index')->With('error', 'No se creo el directorio de nuevo proceso');
            }
        }
    }

    /**
     * Metodo que elimina un proceso selecccionado
     * Solo tiene permitido que el super usuario use este metodo
     */
    public function destroy(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'contraseña' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (Hash::check($value, Auth::user()->password)) {
                    } else {
                        $fail('Contraseña Incorrecta');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'delete')
                ->withInput()
                ->With('error', 'Contraseña incorrecta, proceso no borrado.');
        }

        $proceso = Proceso::FindOrFail($request->id);
        $actividades = ActividadesAdministradores::orderBy('id','desc')->first();
            if ($actividades == null){
                $actividad = new ActividadesAdministradores();
                $actividad->id=1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Eliminó el proceso "'.$proceso->nombre.'" ('.$proceso->codigo.')';
                $actividad->save();
            }else{
                $actividad = new ActividadesAdministradores();
                $actividad->id = ($actividades->id)+1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Eliminó el proceso "'.$proceso->nombre.'" ('.$proceso->codigo.')';
                $actividad->save();
            }
        $access = Storage::deleteDirectory('public/'.$proceso->codigo);
        


        /**
         * Borramos la relacion del administrador con el proceso
         * y la relacion del super usuario con el proceso
        */
        $proceso->usuarios()->detach();
        
        // Eliminamos el proceso
        $proceso->delete(); 

        $access = Storage::deleteDirectory('public/' . $proceso->codigo);
        $proceso->delete();

        return redirect()->route('procesos.index')->With('success', 'Se borro correctamente el proceso.');
    }

    /**
     * Metodo para editar un proceso
     */
    public function update(Request $request)
    {
        // Valida que el proceso tenga un nombre o un codigo
        $validator = Validator::make($request->all(), [
            'nombre' => ['required', Rule::unique('procesos', 'nombre')->ignore($request->id)],
            'codigo' => ['required', Rule::unique('procesos', 'codigo')->ignore($request->id)]
        ], [
            'nombre.required' => 'Debes asignar un nombre al proceso',
            'nombre.unique' => 'Ya existe un proceso con este nombre',
            'codigo.required' => 'Debes de asegnar un codigo al proceso',
            'codigo.unique' => 'Ya existe un proceso con este codigo'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->With('error', 'El proceso no pudo ser actualizado.');
        }

        $proceso = Proceso::FindOrFail($request->id);
        $codigo_anterior = $proceso->codigo;
        $proceso->fill($request->all());

        // Cambiar el nombre del codigo debe de cambiar el nombre de  la carpeta 

        if ($codigo_anterior != $proceso->codigo) {
            Storage::move('public/' . $codigo_anterior, 'public/' . $proceso->codigo);
        }
        if ($proceso->save()) {

            $actividades = ActividadesAdministradores::orderBy('id','desc')->first();
            if ($actividades == null){
                $actividad = new ActividadesAdministradores();
                $actividad->id=1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Modificó el proceso "'.$proceso->nombre.'" ('.$proceso->codigo.')';
                $actividad->save();
            }else{
                $actividad = new ActividadesAdministradores();
                $actividad->id = ($actividades->id)+1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Modificó el proceso "'.$proceso->nombre.'" ('.$proceso->codigo.')';
                $actividad->save();
            }

            return redirect()->route('procesos.index')->with("success","Proceso actualizado correctamente!");

        }else{
            return redirect()->route('procesos.index')->with("error","Proceso no actualizada!");
        }
    }
}
