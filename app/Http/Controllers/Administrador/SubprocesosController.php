<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proceso;
use App\Models\Subproceso;
use Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Http\Requests\CreateSubprocesoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SubprocesosController extends Controller
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
     *  Muestra los subprocesos que tiene el administrador
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $subprocesos = Subproceso::get();

        $procesos = Proceso::get();
            
        return view('administrador.subprocesos.index', compact('subprocesos', 'procesos'));
    }

    /**
     * Metodo para crear un subproceso
     */
    public function store(CreateSubprocesoRequest $request)
    {

        $subproceso = Subproceso::create($request->all());
        
        $access = Storage::makeDirectory('public/'.$subproceso->proceso['nombre'].'/'.$subproceso->codigo);

        Storage::setVisibility('public/'.$subproceso->proceso['nombre'].'/'.$subproceso->codigo,'public');

        if($access === true ){
            return redirect()->route('subprocesos.index')->With('success', 'El subproceso '.$subproceso->codigo.' se creo con exito');

        }else{
            return redirect()->route('subprocesos.index')->With('error', 'No se creo el directorio de nuevo subproceso');

        }
    }

    /**
     * Metodo que elimina un subproceso selecccionado
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
            ->With('error', 'Contraseña incorrecta, subproceso no borrado.');
        }

        $subproceso = Subproceso::FindOrFail($request->id);
        $access = Storage::deleteDirectory('public/'.$subproceso->proceso['nombre'].'/'.$subproceso->codigo);
        $subproceso->delete(); 
            
        return redirect()->route('subprocesos.index')->With('success', 'Se borro correctamente el subproceso.');

        
    }

    /**
     * Metodo para editar un subproceso
     */
    public function update(Request $request)
    {

        // Valida que el subproceso tenga un nombre o un codigo
        $validator = Validator::make($request->all(), [
            'nombre' => ['required',Rule::unique('subprocesos','nombre')->ignore($request->id)],
            'codigo' => ['required',Rule::unique('subprocesos','codigo')->ignore($request->id)]
        ],[
            'nombre.required'=>'Debes asignar un nombre al subproceso',
            'nombre.unique' => 'Ya existe un subproceso con este nombre',
            'codigo.required' => 'Debes de asegnar un codigo al subproceso',
            'codigo.unique' => 'Ya existe un subproceso con este codigo'
        ]);

        if ($validator->fails())
        {
            return back()
            ->withErrors($validator)
            ->withInput()
            ->With('error', 'El subproceso no pudo ser actualizado.');
        }

        $subproceso = Subproceso::FindOrFail($request->id);
        $codigo_anterior = $subproceso->codigo;
        $subproceso->fill($request->all());

        /**
         * Cambiar el nombre del codigo debe de cambiar el nombre de 
         * la carpeta 
         */
        if($codigo_anterior != $subproceso->codigo){
            Storage::move('public/'.$subproceso->proceso['nombre'].'/'.$codigo_anterior, 'public/'.$subproceso->proceso['nombre'].'/'.$subproceso->codigo);
        }
        

        if ($subproceso->save()) {

            return redirect()->route('subprocesos.index')->with("success","Subproceso actualizado correctamente!");

        }else{
            return redirect()->route('subprocesos.index')->with("error","Subproceso no actualizada!");
        }
    }
}