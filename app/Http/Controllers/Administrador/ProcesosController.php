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
        $this->middleware('SuperUsuario');
    }

    /**
     *  Muestra los procesos que tiene el administrador
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $procesos = Proceso::paginate(10);
        
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
        if(Auth::user()->roles->id == 2){

            // Obtenemos el plantel del usuario logeado
            $plantel = Planteles::find(Auth::user()->plantel->id); 

            // Obtenemos los usuarios del plantel
            $usuarios_plantel = $plantel->usuarios;

            // Recorremos esos usuarios hasta encontrar al usuario con el rol de super usuario
            foreach($usuarios_plantel as $usuario){

                if($usuario->roles->id == 1){

                    // Validar que el usuario sea el super usuario del plantel
                    // Para asi asignar el nuevo proceso al super usuario
                    $usuario->procesos()->attach($proceso->id);

                }

            }

        }

        // Hacemos el registro de actividad
        if($access === true ){
            
            $actividad = new ActividadesAdministradores($request->all());
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Creó el proceso "'.$request->nombre.'" ('.$request->codigo.')';
            $actividad->save();
           
            return redirect()->route('procesos.index')->With('success', 'El proceso '.$proceso->codigo.' se creo con exito');

        }else{
        
            return redirect()->route('procesos.index')->With('error', 'No se creo el directorio de nuevo proceso');

        }
    }

    /**
     * Metodo que elimina un proceso selecccionado
     * Solo tiene permitido que el super usuario use este metodo
     */
    public function destroy(Request $request, $id)
    {
        /**
         * Valida que la contraseña sea la contraseña del usurio logeado
         */
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

        /**
         * En caso de que falle regresara al usuario con un mensaje de error
         */
        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'delete')
                ->withInput()
                ->With('error', 'Contraseña incorrecta, proceso no borrado.');
        }

        /**
         * Encuentra el proceso o da un 404
         */
        $proceso = Proceso::FindOrFail($request->id);

        /**
         * Hace un registro de actividad
         */
        $actividades = ActividadesAdministradores::orderBy('id','desc')->first();


        $actividad = new ActividadesAdministradores();
        $actividad->id_user = $request->id_user;
        $actividad->accion = 'Eliminó el proceso "'.$proceso->nombre.'" ('.$proceso->codigo.')';
        $actividad->save();
           
        /**
        * Se elimina el directorio con el codigo del nuevo proceso
        */
        $access = Storage::deleteDirectory('public/'.$proceso->codigo);
            
        $proceso->usuarios()->detach();

        // En caso de que solo se tenga que borrar de un admin pero queda pendiente
        // $proceso->usuarios()->detach(Auth::user()->id);

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

        // En caso de que falle el validador regresa a la vista con mensaje de error
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->With('error', 'El proceso no pudo ser actualizado.');
        }

        // Se encuentra el proceso o da 404
        $proceso = Proceso::FindOrFail($request->id);
        // obtenemos el codigo actual del proceso
        $codigo_anterior = $proceso->codigo;
        // Actualizamos los datos del proceso
        $proceso->fill($request->all());

        // Cambiar el nombre del codigo debe de cambiar el nombre de  la carpeta 
        if ($codigo_anterior != $proceso->codigo) {
            Storage::move('public/' . $codigo_anterior, 'public/' . $proceso->codigo);
        }

        // En caso de que el proceso sea guardado correctamente hace el registro de actividad
        if ($proceso->save()) {

            $actividad = new ActividadesAdministradores();
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Modificó el proceso "'.$proceso->nombre.'" ('.$proceso->codigo.')';
            $actividad->save();


            return redirect()->route('procesos.index')->with("success","Proceso actualizado correctamente!");

        }else{
            return redirect()->route('procesos.index')->with("error","Proceso no actualizada!");
        }
    }
}
