<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tipodocumento;
use App\Models\Documento;
use App\Models\Subproceso;
use Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Http\Requests\CreateDocumentoRequest;
use App\Models\Ciclo;
use App\Models\Planteles;
use App\Models\Proceso;
use App\Models\ProcesoPersonal;
use App\Models\ActividadesAdministradores;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DocumentoController extends Controller
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
     *  Muestra los documentos disponibles
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $documentos = Documento::get();
        $tipodocumentos = Tipodocumento::orderBy('codigo', 'ASC')->get();
        $ciclos = Ciclo::orderBy('nombre', 'ASC')->get();
        if(Auth::user()->rol_id == 2){
            
            $procesos_personales_array = ProcesoPersonal::where('id_usuario','=',Auth::user()->id)->get();
            $procesos_id = array();
            foreach($procesos_personales_array as $proceso){
                $ids = $proceso->id;
                array_push($procesos_id, $ids);
            }
            
            $documentos_array = Documento::whereIn('id_proceso_personal', $procesos_id)->get();
        }elseif (Auth::user()->rol_id == 1) {

            $procesos_personales_array = ProcesoPersonal::where('id_plantel', '=', Auth::user()->id_plantel)->get();
            $procesos_id = array();
            foreach($procesos_personales_array as $proceso){
                $ids = $proceso->id;
                array_push($procesos_id, $ids);
            }
            
            $documentos_array = Documento::whereIn('id_proceso_personal', $procesos_id)->get();
        }else{
            $procesos_personales_array = ProcesoPersonal::all();
            $documentos_array = Documento::all();
        }
        return view('administrador.documentos.index', 
        compact('documentos_array', 'tipodocumentos', 'procesos_personales_array','ciclos'));
    }

    public function indexByProcesoPersonal($id)
    {
        $proceso_personal = ProcesoPersonal::FindOrFail($id);
        $tipodocumentos = Tipodocumento::orderBy('codigo', 'ASC')->get();
        $ciclos = Ciclo::orderBy('nombre', 'ASC')->get();
        $documentos_array = $proceso_personal->documentos;
        $procesos_personales = ProcesoPersonal::where('id_usuario', '=', Auth::user()->id)->get();
        return view('administrador.documentos.filtro.index', 
        compact('documentos_array', 'tipodocumentos', 'procesos_personales','ciclos','proceso_personal'));
    }

    /**
     * Metodo para crear un documento
     */
    public function store(Request $request)
    {
        if (!$request->hasFile('archivo')) {
            return redirect()->route('documentos.index')->With('error', 'El documento no se creo');
        }

        $documento = new Documento($request->all());

        $documento->id_proceso_personal = $request->proceso_personal;

        if ($request->nombre == null) {
            $name = $request->file('archivo')->getClientOriginalName();
        } else {
            $ext = $request->file('archivo')->extension();
            $name = $request->nombre . '.' . $ext;
        }

        $documento->nombre = $name;
        $documento->id_ciclo = $request->ciclo;

        if($documento->procesopersonal->id_subproceso != null){
            $assces = $request->file('archivo')->storeAs(
                $documento->procesopersonal->subproceso->proceso['codigo'] . '/' . 
                $documento->procesopersonal->subproceso->codigo . '/' . 
                $documento->procesopersonal->codigo, $name, 'public');
                
            if ($assces) {
                $documento->save();
                $actividad = new ActividadesAdministradores();
                $actividad->id_user = Auth::user()->id;
                $actividad->accion = 'Guardó el documento "'.$documento->nombre.'" en el proceso personal: '.$documento->procesopersonal->nombre.'';
                $actividad->save();
            }
        }else{
            $assces = $request->file('archivo')->storeAs(
                $documento->procesopersonal->proceso['codigo'] . '/' .
                $documento->procesopersonal->codigo, $name, 'public');
                
            if ($assces) {
                
                $documento->save();
            }
        }

        return redirect()->route('documentos.index')->With('success', 'El documento se creo con exito');
    }

    /**
     * Metodo para editar un documento
     */
    public function update(Request $request)
    {
        // Valida que el documento tenga un nombre o un codigo
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
        ], [
            'nombre.required' => 'Debes asignar un nombre al documento',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->With('error', 'El documento no pudo ser actualizado.');
        }

        $documento = Documento::FindOrFail($request->id);

        $nombre_doc_anterior = $documento->nombre;
        $procper_doc_anterior = ProcesoPersonal::FindOrFail($documento->id_proceso_personal);
        $subproceso_doc_anterior = Subproceso::FindOrFail($procper_doc_anterior->id_subproceso);
        $proceso_doc_anterior = Proceso::FindOrFail($subproceso_doc_anterior->id_proceso);

        $documento->id_tipodocumento = $request->tipo_documento;
        $documento->id_proceso_personal = $request->proceso_personal;
        $documento->fill($request->all());

        $procper_doc_nuevo = ProcesoPersonal::FindOrFail($request->proceso_personal);
        $subproceso_doc_nuevo = Subproceso::FindOrFail($procper_doc_nuevo->id_subproceso);
        $proceso_doc_nuevo = Proceso::FindOrFail($subproceso_doc_nuevo->id_proceso);
        
        $documento->id_ciclo = $request->ciclo;

        if (($procper_doc_anterior['id'] != $procper_doc_nuevo['id']) || ($nombre_doc_anterior != $documento->nombre)) {
            Storage::move(
                '/public' . '/' . 
                $proceso_doc_anterior['codigo'] . '/' . 
                $subproceso_doc_anterior['codigo'] . '/' . 
                $procper_doc_anterior['codigo'] . '/' . 
                $nombre_doc_anterior,

                '/public' . '/' . 
                $proceso_doc_nuevo['codigo'] . '/' . 
                $subproceso_doc_nuevo['codigo'] . '/' . 
                $procper_doc_nuevo['codigo'] . '/' . 
                $request->nombre
            );
        }

        $documento->save();

        if ($documento->save()) {
            $actividad = new ActividadesAdministradores();
            $actividad->id_user = Auth::user()->id;
            $actividad->accion = 'Modificó el documento "'.$documento->nombre.'" en el proceso personal: '.$documento->procesopersonal->nombre.'';
            $actividad->save();
            return redirect()->route('documentos.index')->with("success", "Documento actualizado correctamente!");
        } else {
            return redirect()->route('documentos.index')->with("error", "Documento no actualizado!");
        }
    }

    /**
     * Metodo que elimina un documento selecccionado
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
                ->With('error', 'Contraseña incorrecta, documento no borrado.');
        }

        $documento = Documento::FindOrFail($request->id);
        $procper_doc = ProcesoPersonal::FindOrFail($documento->id_proceso_personal);
        $subproceso_doc = Subproceso::FindOrFail($procper_doc->id_subproceso);
        $proceso_doc = Proceso::FindOrFail($subproceso_doc->id_proceso);

        $documento->delete();
        $actividad = new ActividadesAdministradores();
        $actividad->id_user = Auth::user()->id;
        $actividad->accion = 'Eliminó el documento "'.$documento->nombre.'" en el proceso personal: '.$documento->procesopersonal->nombre.'';
        $actividad->save();

        Storage::delete(
            '/public' . '/' . $proceso_doc['codigo'] . '/' . $subproceso_doc['codigo'] . '/' . $procper_doc['codigo'] . '/' . $documento->nombre
        );

        return redirect()->route('documentos.index')->With('success', 'Se borro correctamente el documento.');
    }

    /**
     * Metodo que descarga el archivo
     */
    public function downloadFile(Request $request)
    {
        /**
         * Validar la contraseña del usuario
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
         * En caso de que sea una contraseña incorrecta 
         * fallara la validacion y regresamos al index
         * Con el mensaje de contraseña incorrecta
         */
        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'downloadFile')
                ->withInput()
                ->With('error', 'La contraseña ingresada es incorrecta.');
        }

        $documento = Documento::FindOrFail($request->id);
        $documentoFisico = storage_path(
            'app/public/'.
            $documento->procesopersonal->subproceso->proceso['codigo'].'/'.
            $documento->procesopersonal->subproceso->codigo.'/'.
            $documento->procesopersonal->codigo.'/'.
            $documento->nombre
        );

        $info = pathinfo($documentoFisico);
        $ext = $info['extension'];

        #--------------
        $plant = Planteles::FindOrFail(Auth::user()->id_plantel);
        $clave_unidad = $plant->numero;

        $procper = ProcesoPersonal::FindOrFail($documento->id_proceso_personal);
        $subproc = Subproceso::FindOrFail($procper->id_subproceso);
        $proc = Proceso::FindOrFail($subproc->id_proceso);
        $abv_proceso = $proc->codigo;

        $tipo_documento = Tipodocumento::FindOrFail($documento->id_tipodocumento)->codigo;

        $docs = Documento::get();
        $sorteddocs = $docs->sortBy('created_at');
        $doctype = $documento->id_tipodocumento;
        $docsoftype = [];

        foreach ($sorteddocs as $docfor) {
            if ($docfor->id_tipodocumento == $doctype) {
                $docsoftype[] = $docfor;
            }
        }

        $num_consecutivo = 1;
        foreach ($docsoftype as $docfor) {
            if ($docfor->id == $documento->id) {
                break;
            }
            $num_consecutivo = $num_consecutivo + 1;
        }

        $full_name = 
        '16-'.
        $clave_unidad.'-'.
        $abv_proceso.'-'.
        $tipo_documento.'-'.
        $num_consecutivo.'-'.
        $documento->nombre;
        #--------------

        return response()->download($documentoFisico, $full_name);
    }


    /**
     * Metodo que regresa una lista de tipos de documentos
     */
    public function api_tipos_documentos()
    {
        return Tipodocumento::orderBy('nombre', 'DESC')->get();
    }


    /**
     * Metodo que regresa una lista de procesos personales
     */
    public function api_procesos_personal()
    {
        return ProcesoPersonal::orderBy('nombre', 'DESC')->get();
    }
}
