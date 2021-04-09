<?php

namespace App\Http\Controllers\SuperUsuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Planteles;
use App\Models\Municipios;
use Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\ActividadesAdministradores;
use App\Http\Requests\CreatePlantelRequest;

class PlantelesController extends Controller
{

    /**
     *  Muestra los planteles que el superusuario puede editar
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $planteles = Planteles::paginate(10);
        $municipios = Municipios::orderBy('nombre', 'DESC')->get();

        return view('superusuario.planteles.index', compact('planteles', 'municipios'));
    }

    /**
     * Metodo para crear un plantel
     */
    public function store(CreatePlantelRequest $request)
    {
        $plantel = new Planteles($request->all());
        $plantel->municipio_id = $request->municipio;
        $plantel->save();

        $actividades = ActividadesAdministradores::orderBy('id','desc')->first();
        if ($actividades == null){
            $actividad = new ActividadesAdministradores($request->all());
            $actividad->id=1;
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Registró el plantel "'.$request->municipio->nombre.'" ('.$request->numero.')';
            $actividad->save();
        }else{
            $actividad = new ActividadesAdministradores($request->all());
            $actividad->id = ($actividades->id)+1;
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Registró el plantel "'.$request->municipio->nombre.'" ('.$request->numero.')';
            $actividad->save();
        }

        return redirect()->route('planteles.index')->With('success', 'El plantel '.$plantel->numero.' se creo con exito');
       
    }

    /**
     * Metodo que elimina un plantel selecccionado
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
                ->With('error', 'Contraseña incorrecta, plantel no borrado.');
        }

        $plantel = Planteles::FindOrFail($request->id_plantel);

        $actividades = ActividadesAdministradores::orderBy('id','desc')->first();
        if ($actividades == null){
            $actividad = new ActividadesAdministradores();
            $actividad->id=1;
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Eliminó el plantel "'.$plantel->municipio->nombre.'" ('.$plantel->numero.')';
            $actividad->save();
        }else{
            $actividad = new ActividadesAdministradores();
            $actividad->id = ($actividades->id)+1;
            $actividad->id_user = $request->id_user;
            $actividad->accion = 'Eliminó el plantel "'.$plantel->municipio->nombre.'" ('.$plantel->numero.')';
            $actividad->save();
        }

        $plantel->delete();

        return redirect()->route('planteles.index')->With('success', 'Se borro correctamente el plantel');
    }

    /**
     * Metodo para editar un plantel
     */
    public function update(Request $request)
    {
        // Valida los datos del plantel
        $validator = Validator::make($request->all(), [
            'numero' => 'required|integer|digits:10',
            'id_plantel' => 'required',
            'clave_trabajo' => 'required',
            'municipio' => 'required',
        ], [
            'numero.required' => 'El plantel debe de tener un numero de plantel',
            'numero.integer' => 'Debes de ingresar un numero',
            'numero.digits' => 'El numero de plantel debe de ser de 10 caracteres',
            'clave_trabajo.required' => 'El plantel debe de tener una clave de trabajo'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->With('error', '¡Plantel no actualizado!');
        }

        $plantel = Planteles::FindOrFail($request->id_plantel);
        $plantel->fill($request->all());
        $plantel->municipio_id = $request->municipio;
        $plantel->save();


        if ($plantel->save()) {

            $actividades = ActividadesAdministradores::orderBy('id','desc')->first();
            if ($actividades == null){
                $actividad = new ActividadesAdministradores();
                $actividad->id=1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Modificó el plantel "'.$plantel->municipio->nombre.'" ('.$plantel->numero.')';
                $actividad->save();
            }else{
                $actividad = new ActividadesAdministradores();
                $actividad->id = ($actividades->id)+1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Modificó el plantel "'.$plantel->municipio->nombre.'" ('.$plantel->numero.')';
                $actividad->save();
        }

            return redirect()->route('planteles.index')->with("success","¡Plantel actualizado correctamente!");
        }else{
            return redirect()->route('planteles.index')->with("error","¡Plantel no actualizado!");
        }
    }


    /**
     * Metodo que regresa una lista de municipios
     */
    public function api_municipios()
    {
        return Municipios::orderBy('nombre', 'DESC')->get();
    }
}
