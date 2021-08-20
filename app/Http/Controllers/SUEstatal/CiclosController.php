<?php

namespace App\Http\Controllers\SUEstatal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ciclo;
use Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\ActividadesAdministradores;
use App\Http\Requests\CreateCicloRequest;

class CiclosController extends Controller
{

    /**
     *  Muestra los ciclos escolares del sistema
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ciclos = Ciclo::paginate(10);

        return view('SUEstatal.ciclos.index', compact('ciclos'));
    }


    /**
     * Metodo para crear un ciclo escolar
     */
    public function store(CreateCicloRequest $request)
    {
        $ciclos = new Ciclo($request->all());
        $ciclos->save();

        $actividades = ActividadesAdministradores::orderBy('id','desc')->first();
        if ($actividades == null){
            $actividad = new ActividadesAdministradores($request->all());
            $actividad->id=1;
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Registró el ciclo escolar "'.$ciclos->nombre;
            $actividad->save();
        }else{
            $actividad = new ActividadesAdministradores($request->all());
            $actividad->id = ($actividades->id)+1;
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Registró el ciclo escolar "'.$ciclos->nombre;
            $actividad->save();
        }

        return redirect()->route('ciclos.index')->With('success', 'El ciclo esoclar '.$ciclos->nombre.' se creo con éxito');
       
    }

    /**
     * Metodo que elimina un ciclo escolar selecccionado
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
                ->With('error', 'Contraseña incorrecta, ciclo escolar no borrado.');
        }

        $ciclos = Ciclo::FindOrFail($request->id);

        $actividades = ActividadesAdministradores::orderBy('id','desc')->first();
        if ($actividades == null){
            $actividad = new ActividadesAdministradores();
            $actividad->id=1;
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Eliminó el ciclo escolar "'.$ciclos->nombre;
            $actividad->save();
        }else{
            $actividad = new ActividadesAdministradores();
            $actividad->id = ($actividades->id)+1;
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Eliminó el ciclo escolar "'.$ciclos->nombre;
            $actividad->save();
        }

        $ciclos->delete();

        return redirect()->route('ciclos.index')->With('success', 'Se borro correctamente el ciclo escolar');
    }

    /**
     * Metodo para editar un ciclo escolar
     */
    public function update(Request $request)
    {
        // Valida los datos del plantel
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'inicio' => 'required|integer',
            'conclusion' => 'required|integer',
        ], [
            'nombre.required' => 'El ciclo escolar debe de tener un nombre',
            'inicio.required' => 'El ciclo escolar debe de tener un inicio',
            'conclusion.required' => 'El ciclo escolar debe de tener un final',
            'inicio.integer' => 'Debes de ingresar un numero',
            'conclusion.integer' => 'Debes de ingresar un numero',
        ]);


        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->With('error', '¡Ciclo escolar no actualizado!');
        }

        $ciclos = Ciclo::FindOrFail($request->id);
        $ciclos->fill($request->all());
        $ciclos->save();


        if ($ciclos->save()) {

            $actividades = ActividadesAdministradores::orderBy('id','desc')->first();
            if ($actividades == null){
                $actividad = new ActividadesAdministradores();
                $actividad->id=1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Modificó el ciclo escolar "'.$ciclos->nombre;
                $actividad->save();
            }else{
                $actividad = new ActividadesAdministradores();
                $actividad->id = ($actividades->id)+1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Modificó el ciclo escolar "'.$ciclos->nombre;
                $actividad->save();
        }

            return redirect()->route('ciclos.index')->with("success","¡Ciclo escolar actualizado correctamente!");
        }else{
            return redirect()->route('ciclos.index')->with("error","¡Ciclo escolar no actualizado!");
        }
    }
    
}
