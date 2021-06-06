<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tipodocumento;
use Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Http\Requests\CreateProcesoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\ActividadesAdministradores;
use App\Models\ProcesoPersonal;

class TipodocumentoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('Administrador');
    }

    /**
     *  Muestra los procesos que tiene el administrador
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tipodocumento = Tipodocumento::get();

        return view('administrador.tipodocumento.index', compact('tipodocumento'));
    }

    /**
     * Metodo para crear un proceso
     */
    public function store(CreateProcesoRequest $request)
    {

        $tipodocumento = Tipodocumento::create($request->all());
        $access = Storage::makeDirectory('public/'.$tipodocumento->codigo);
        Storage::setVisibility('public/'.$tipodocumento->codigo,'public');
        if($access === true ){

            $actividades = ActividadesAdministradores::orderBy('id','desc')->first();
            if ($actividades == null){
                $actividad = new ActividadesAdministradores($request->all());
                $actividad->id=1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Creó el tipo de documento "'.$request->nombre.'" ('.$request->codigo.')';
                $actividad->save();
            }else{
                $actividad = new ActividadesAdministradores($request->all());
                $actividad->id = ($actividades->id)+1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Creó el tipo de documento "'.$request->nombre.'" ('.$request->codigo.')';
                $actividad->save();
            }

            return redirect()->route('tipodocumento.index')->With('success', 'El tipo de documento '.$tipodocumento->codigo.' se creo con exito');
        }else{
            return redirect()->route('tipodocumento.index')->With('error', 'No se creo el directorio del nuevo tipo de documento');
        }
    }

    /**
     * Metodo que elimina un proceso selecccionado
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
            ->With('error', 'Contraseña incorrecta, tipo de documento no borrado.');
        }

        $tipodocumento = Tipodocumento::FindOrFail($request->id);
        $access = Storage::deleteDirectory('public/'.$tipodocumento->codigo);
        $actividades = ActividadesAdministradores::orderBy('id','desc')->first();
            if ($actividades == null){
                $actividad = new ActividadesAdministradores();
                $actividad->id=1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Eliminó el tipo de documento "'.$tipodocumento->nombre.'" ('.$tipodocumento->codigo.')';
                $actividad->save();
            }else{
                $actividad = new ActividadesAdministradores();
                $actividad->id = ($actividades->id)+1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Eliminó el tipo de documento "'.$tipodocumento->nombre.'" ('.$tipodocumento->codigo.')';
                $actividad->save();
            }
        $tipodocumento->delete(); 
            
        return redirect()->route('tipodocumento.index')->With('success', 'Se borro correctamente el tipo de documento.');

        
    }

    /**
     * Metodo para editar un proceso
     */
    public function update(Request $request)
    {

        // Valida que el proceso tenga un nombre o un codigo
        $validator = Validator::make($request->all(), [
            'nombre' => ['required',Rule::unique('tipodocumento','nombre')->ignore($request->id)],
            'codigo' => ['required',Rule::unique('tipodocumento','codigo')->ignore($request->id)]
        ],[
            'nombre.required'=>'Debes asignar un tipo de documento al proceso',
            'nombre.unique' => 'Ya existe un tipo de documento con este nombre',
            'codigo.required' => 'Debes de asignar un codigo al tipo de documento',
            'codigo.unique' => 'Ya existe un tipo de documento con este codigo'
        ]);

        if ($validator->fails())
        {
            return back()
            ->withErrors($validator)
            ->withInput()
            ->With('error', 'El tipo de documento no pudo ser actualizado.');
        }

        $tipodocumento = Tipodocumento::FindOrFail($request->id);
        $codigo_anterior = $tipodocumento->codigo;
        $tipodocumento->fill($request->all());

        /**
         * Cambiar el nombre del codigo debe de cambiar el nombre de 
         * la carpeta 
         */
        if($codigo_anterior != $tipodocumento->codigo){
            Storage::move('public/'.$codigo_anterior, 'public/'.$tipodocumento->codigo);
        }
        

        if ($tipodocumento->save()) {

            $actividades = ActividadesAdministradores::orderBy('id','desc')->first();
            if ($actividades == null){
                $actividad = new ActividadesAdministradores();
                $actividad->id=1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Modificó el tipo de documento "'.$tipodocumento->nombre.'" ('.$tipodocumento->codigo.')';
                $actividad->save();
            }else{
                $actividad = new ActividadesAdministradores();
                $actividad->id = ($actividades->id)+1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Modificó el tipo de documento "'.$tipodocumento->nombre.'" ('.$tipodocumento->codigo.')';
                $actividad->save();
            }

            return redirect()->route('tipodocumento.index')->with("success","Tipo de documento actualizado correctamente!");
        }else{
            return redirect()->route('tipodocumento.index')->with("error","Tipo de documento no actualizado!");
        }
    }
}