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
        return view('superusuario.permisos.index');
    }

    /**
     * Muestra un listado de los procesos que hay en el plantel y los procesos que tiene el administrador
     * Esta vista solo debe de estar disponible para el super usuario del plantel
     */
    public function indexasignarprocesos($id)
    {
        /**
         * Debo de mostrar todos los procesos que tiene el plantel
         * para poder asignarlos a los administradores del plantel
         * y el super usuario tiene todos los procesos del plantel 
         */
        $procesos_plantel = Proceso::all();
        
        $administrador = User::find($id);
        $procesos_administrador = $administrador->procesos;

        return view('superusuario.permisos.asignar', compact('procesos_plantel','procesos_administrador','administrador'));

    }

    /**
     * Asigna el proceso a un administrador
     */
    public function asignarproceso($id, $id_proceso)
    {
        // Validar que el administrador no tenga ese proceso ya asignado anteriormente
        $administrador = User::findOrFail($id);
        $proceso_n = Proceso::findOrFail($id_proceso);
        $procesos_administrador = $administrador->procesos;

        // Busca en los procesos del administrador el nuevo proceso que se quiere asignar 
        // En caso de que se encuentre quiere decir que el administrador ya tiene ese proceso
        // Por lo que no se puede volver a asignar 
        foreach($procesos_administrador as $proceso_a){
            
            if( $proceso_a->is($proceso_n) ){
                
                return back()->With('error', 'El proceso '.$proceso_n->nombre.' ya pertenece al administrador '.$administrador->name);

            }
        }

        // En caso de que el proceso no este asignado al usuario
        $administrador->procesos()->attach($proceso_n->id);

        return back()->With('success', 'El proceso '.$proceso_n->nombre.' se asigno correctamente al administrador '.$administrador->name);
        
    }

    public function quitarprocerso($id_admi, $id_proceso)
    {
        $administrador = User::findOrFail($id_admi);
        $proceso = Proceso::findOrFail($id_proceso);
        $procesos_administrador = $administrador->procesos;

        foreach($procesos_administrador as $proceso_a){

            if($proceso->is($proceso_a) ){
                
                $administrador->procesos()->detach($proceso_a->id);

                return back()->With('success', 'El proceso '.$proceso->nombre.' se desasigno correctamente del administrador '.$administrador->name);

            }

        }

        return back()->With('error', 'El proceso '.$proceso->nombre.' no está asignado al administrador '.$administrador->name);
        
    }

}