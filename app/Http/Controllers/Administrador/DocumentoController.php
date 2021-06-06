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
        $subproceso = Subproceso::FindOrFail($request->subproceso);

        $nombre_anterior = $documento->nombre;
        $subproceso_anterior = $documento->subproceso;

        $documento->id_tipodocumento = $request->tipo_documento;
        $documento->id_subproceso = $subproceso['id'];
        $documento->fill($request->all());

        if (($subproceso_anterior->id_proceso != $subproceso['id']) || ($nombre_anterior != $documento->nombre)) {
            Storage::move(
                '/public'.'/'.$subproceso_anterior->proceso['codigo'].'/'.$subproceso_anterior->codigo.'/'.$nombre_anterior,
                '/public'.'/'.$subproceso->proceso['codigo'].'/'.$subproceso->codigo.'/'.$request->nombre
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
        $subproceso = Subproceso::FindOrFail($documento->id_subproceso);
        $documento->delete();

        Storage::delete(
            '/public'.'/'.$subproceso->proceso['codigo'].'/'.$subproceso->codigo.'/'.$documento->nombre
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
     * Metodo que regresa una lista de subprocesos
     */
    public function api_subprocesos()
    {
        return Subproceso::orderBy('nombre', 'DESC')->get();
    }
}
