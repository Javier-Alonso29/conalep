<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProcesoPersonalRequest;
use App\Models\Proceso;
use App\Models\Subproceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use App\Models\ProcesoPersonal;
use App\Models\ActividadesAdministradores;
use Illuminate\Validation\Rule;

class ProcesosPersonalesController extends Controller
{

    /**
     *  Muestra los procesos personales que tiene el administrador
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->rol_id == 3){
            $procesos_p = Proceso::all();
            $procesos_personales = ProcesoPersonal::all();
        }elseif (Auth::user()->rol_id == 1) {
            $procesos_p = Proceso::all();
            $procesos_personales = ProcesoPersonal::where('id_plantel', Auth::user()->id_plantel)->get();
        }else{
            $procesos_p = Auth::user()->procesos;
            $arreglo_subprocesos = array();
            foreach($procesos_p as $proceso)
            {
                $subproceso = $proceso->subprocesos;
                array_push($arreglo_subprocesos, $subproceso);
            }
            
            $procesos_personales = ProcesoPersonal::where('id_usuario', '=', Auth::user()->id)->get();
        }
            return view('administrador.personales.index', compact('procesos_personales','procesos_p'));
        }

    public function indexbySubproceso($id){

        $proceso = Proceso::FindOrFail($id);
        $subprocesos = Subproceso::where('id_proceso',$proceso->id)->get();

        if (Auth::user()->rol_id == 3) {

            $procesos_personales = ProcesoPersonal::where('id_proceso', $proceso->id)->get();

        }elseif (Auth::user()->rol_id == 1) {

            $procesos_personales = ProcesoPersonal::where('id_proceso', $proceso->id)->
                where('id_plantel', Auth::user()->id_plantel)->get();

        }else{

            $procesos_personales = ProcesoPersonal::where('id_proceso', $proceso->id)->
                where('id_usuario', Auth::user()->id)->get();
                
        }
        return view('administrador.personales.filtro.index', compact('procesos_personales','proceso','subprocesos'));

    }

    /**
     * Api para regresar los procesos personales del administrador
     */
    public function api_sub_procesos($id_proceso){
        
        $proceso = Proceso::find($id_proceso);
        
        $subproceso = $proceso->subprocesos;

        return $subproceso;
    }


    /**
     * Metodo para crear un proceso
     */
    public function store(CreateProcesoPersonalRequest $request)
    {
        // Validar que no envien los valores incorrectos en los selects
        $proceso_id = $request->proceso;
        $subproceso_id = $request->subproceso;


        if($proceso_id === "-0000"){
            return back()
                ->withErrors('proceso')
                ->withInput()
                ->With('error', 'Seleccionaste un proceso incorrecto');
        }

        /* if($subproceso_id === "-0000"){
            return back()
                ->withErrors('subproceso')
                ->With('error', 'Seleccionaste un sub proceso incorrecto');
        } */

        // Crear el proceso personal
        $proceso_personal = new ProcesoPersonal($request->all());
        $proceso_personal->id_subproceso = $subproceso_id;
        $proceso_personal->id_proceso = $proceso_id;
        $proceso_personal->id_plantel = Auth::user()->plantel->id;
        $proceso_personal->id_usuario = Auth::user()->id;
        $proceso_personal->save();
        $actividad = new ActividadesAdministradores($request->all());
        $actividad->id_user = $request->id_user;
        $actividad->accion = 'Creó el proceso personal "'.$request->nombre.'" ('.$request->codigo.')';
        $actividad->save();

        // Hacemos la carpeta
        $subproceso = Subproceso::find($subproceso_id);
        $proceso = Proceso::find($proceso_id);

        if($subproceso_id === null){
            $access = Storage::makeDirectory('public/' . $proceso['codigo'] . '/' . $proceso_personal->codigo);
            Storage::setVisibility('public/' . $proceso['codigo'] . '/' . $proceso_personal->codigo, 'public');
        }else{
            $access = Storage::makeDirectory('public/' . $subproceso->proceso['codigo'] . '/' . $subproceso->codigo . '/' . $proceso_personal->codigo);
            Storage::setVisibility('public/' . $subproceso->proceso['codigo'] . '/' . $subproceso->codigo . '/' . $proceso_personal->codigo, 'public');
        }
        

        if($access === true){
            
            return redirect()->route('misCarpetas.index')->With('success', 'Se creo correctamente el proceso personal.');
        }else{
            return redirect()->route('misCarpetas.index')->With('error', 'No se pudo crear el proceso personal.');
        }

    }

    /**
     * Metodo que elimina un proceso personal selecccionado
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
                ->With('error', 'Contraseña incorrecta, proceso personal no borrado.');
        }

        // Encontrar el proceso personal
        $proceso_personal = ProcesoPersonal::FindOrFail($request->id);

        // Encontramos el sub proceso origen
        $subproceso = Subproceso::FindOrFail($request->id_subproceso);

        // Encontramos el proceso origen
        $proceso = Proceso::FindOrFail($request->id_proceso);

        /**
        * Se elimina el directorio con el codigo del nuevo proceso
        */
        $access = Storage::deleteDirectory('public/'.$proceso->codigo.'/'.$subproceso->codigo.'/'.$proceso_personal->codigo);

        if($access){

            $proceso_personal->delete();
            $actividad = new ActividadesAdministradores();
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Eliminó el proceso personal "'.$proceso->nombre.'" ('.$proceso->codigo.')';
            $actividad->save();
            return redirect()->route('misCarpetas.index')->With('success', 'Se borro correctamente el proceso.');

        }else{
            return redirect()->route('misCarpetas.index')->With('error', 'No se pudo borrar el proceso.');
        }

    }

    /**
     * Metodo para editar un proceso
     */
    public function update(Request $request)
    {
        // Valida que el proceso tenga un nombre o un codigo
        $validator = Validator::make($request->all(), [
            'nombre' => ['required', Rule::unique('procesos', 'nombre')->ignore($request->proceso)],
            'codigo' => ['required', Rule::unique('procesos', 'codigo')->ignore($request->proceso)]
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
        $proceso_personal = ProcesoPersonal::FindOrFail($request->proceso);
        // obtenemos el codigo actual del proceso
        $codigo_anterior = $proceso_personal->codigo;
        // Actualizamos los datos del proceso
        $proceso_personal->fill($request->all());

        // Encontramos el sub proceso origen
        $subproceso = Subproceso::FindOrFail($request->proceso_o);

        // Encontramos el proceso origen
        $proceso = Proceso::FindOrFail($request->subproceso_o);

        // Cambiar el nombre del codigo debe de cambiar el nombre de  la carpeta 
        if ($codigo_anterior != $proceso_personal->codigo) {
            $access = Storage::move('public/'.$proceso->codigo.'/'.$subproceso->codigo.'/'.$codigo_anterior, 'public/'.$proceso->codigo.'/'.$subproceso->codigo.'/'.$proceso_personal->codigo);
        }

        if($proceso_personal->save()){
            $actividad = new ActividadesAdministradores();
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Modificó el proceso personal "'.$proceso->nombre.'" ('.$proceso->codigo.')';
            $actividad->save();
            return redirect()->route('misCarpetas.index')->With("success","Proceso actualizado correctamente!");
        }else{
            return redirect()->route('misCarpetas.index')->With("error","No se pudo actualizar el proceso");
        }
    }
}
