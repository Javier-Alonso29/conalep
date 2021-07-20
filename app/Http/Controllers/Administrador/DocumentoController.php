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
use App\Models\Proceso;
use App\Models\ProcesoPersonal;
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

        $procesos = Auth::user()->procesos;

        $subprocesos_array = array();

        foreach($procesos as $proceso){
            $subprocesos = $proceso->subprocesos;
            array_push($subprocesos_array, $subprocesos);
        }

        $procesos_personales_array = array();

        foreach($subprocesos_array as $collection){
            

            foreach($collection as $subproceso){

                $procesos_personales = $subproceso->procesospersonales;
                array_push($procesos_personales_array, $procesos_personales);

            }

        }

        $documentos_array = array();

        foreach($procesos_personales_array as $collection){

            foreach($collection as $proceso_personal){

                $documentos = $proceso_personal->documentos;

                array_push($documentos_array, $documentos);

            }
        }

        return view('administrador.documentos.index', compact('documentos_array', 'tipodocumentos', 'procesos_personales_array'));
    }

    public function indexByProcesoPersonal($id)
    {
        $proceso_personal = ProcesoPersonal::FindOrFail($id);
        $tipodocumentos = Tipodocumento::orderBy('codigo', 'ASC')->get();

        $documentos_array = $proceso_personal->documentos;

        // dd($documentos_array);

        return view('administrador.documentos.filtro.index', compact('documentos_array', 'tipodocumentos', 'proceso_personal'));
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
        $ext = $request->file('archivo')->extension();
        $name = $request->nombre.'.'.$ext;
        $documento->nombre = $name;

       
        $assces = $request->file('archivo')->storeAs($documento->procesopersonal->subproceso->proceso['codigo'] . '/' . $documento->procesopersonal->subproceso->codigo.'/'.$documento->procesopersonal->codigo, $name, 'public');

        if($assces){
            $documento->save();
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
            //'id_tipodocumento' => 'required',
            //'id_subproceso' => 'required',
        ], [
            'nombre.required' => 'Debes asignar un nombre al documento',
            //'id_tipodocumento.required' => 'Debes asignar un tipo de documento al documento',
            //'id_subproceso.required' => 'El documento debe estar asignado a un subproceso',
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

        if (($procper_doc_anterior['id'] != $procper_doc_nuevo['id']) || ($nombre_doc_anterior != $documento->nombre)) {
            Storage::move(
                '/public'.'/'.$proceso_doc_anterior['codigo'].'/'.$subproceso_doc_anterior['codigo'].'/'.$procper_doc_anterior['codigo'].'/'.$nombre_doc_anterior,
                '/public'.'/'.$proceso_doc_nuevo['codigo'].'/'.$subproceso_doc_nuevo['codigo'].'/'.$procper_doc_nuevo['codigo'].'/'.$request->nombre
            );
        }

        $documento->save();

        if ($documento->save()) {
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

        Storage::delete(
            '/public'.'/'.$proceso_doc['codigo'].'/'.$subproceso_doc['codigo'].'/'.$procper_doc['codigo'].'/'.$documento->nombre
        );

        return redirect()->route('documentos.index')->With('success', 'Se borro correctamente el documento.');
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
