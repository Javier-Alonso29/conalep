<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ZipArchive;
use App\Models\ProcesoPersonal;
use App\Models\Proceso;
use App\Models\Subproceso;
use App\Models\Planteles;
use App\Models\Documento;
use App\Models\Tipodocumento;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Auth;
use File;
use App\Models\ActividadesAdministradores;

class ZipController extends Controller
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
     * Descarga el folder que se le indica en el url
     */
    public function downloadFolder(Request $request)
    {
        /**
         * Validar la contraseña del usuario
         */
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

        /**
         * En caso de que sea una contraseña incorrecta 
         * fallara la validacion y regresamos al index
         * Con el mensaje de contraseña incorrecta
         */
        if ($validator->fails()) {
            return back()
            ->withErrors($validator,'downloadFolder')
            ->withInput()
            ->With('error', 'La contraseña ingresada es incorrecta.');
        }
        
        // Buscamos el proceso del cual queremos descargar el zip
        $proceso = Proceso::FindOrFail($request->id);

        // Creamos un zip y le asignamos el nombre del proceso que deseamos descargar
        $zip = new ZipArchive;
        $file_name = $proceso->codigo.'.zip';

        // Obtenemos los archivos de la carpeta del proceso seleccionado
        $files = glob(storage_path('app/public/'.$proceso->codigo.'/*/*/*.*'));

        if(empty($files)){
            return redirect()
            ->route('procesos.index')->With('error', 'El proceso no cuenta con archivos internos.');
        }

        // Crear o sobrescribir el zip dentro de la carpeta zips
        if($zip->open(public_path('zips/'.$file_name), ZipArchive::CREATE|ZipArchive::OVERWRITE) === TRUE)
        {
            $docNomen = '';
            foreach ($files as $key => $value) {
                $docname = basename($value);
                $documentos = Documento::get();
                foreach ($documentos as $doc) {
                    if ($doc->nombre === $docname) {
                        $docNomen = $this->getDocNomenclaturado($doc);
                    }
                }
                $zip->addFile($value, $docNomen);
            }

            $zip->close();

            $actividades = ActividadesAdministradores::orderBy('id','desc')->first();
            if ($actividades == null){
                $actividad = new ActividadesAdministradores($request->all());
                $actividad->id=1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Descargó el proceso "'.$request->nombre.'" ('.$request->codigo.')';
                $actividad->save();
            }else{
                $actividad = new ActividadesAdministradores($request->all());
                $actividad->id = ($actividades->id)+1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Descargó el proceso "'.$request->nombre.'" ('.$request->codigo.')';
                $actividad->save();
            }

        }

        // Regresamos la vista con la descarga del zip
        return response()->download(public_path('zips/'.$file_name));
    }

    /**
     * Descarga el folder que se le indica en el url
     */
    public function downloadFolderSubproceso(Request $request)
    {
        /**
         * Validar la contraseña del usuario
         */
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

        /**
         * En caso de que sea una contraseña incorrecta 
         * fallara la validacion y regresamos al index
         * Con el mensaje de contraseña incorrecta
         */
        if ($validator->fails()) {
            return back()
            ->withErrors($validator,'downloadFolder')
            ->withInput()
            ->With('error', 'La contraseña ingresada es incorrecta.');
        }
        
        // Buscamos el subproceso del cual queremos descargar el zip
        $subproceso = Subproceso::FindOrFail($request->id);

        // Creamos un zip y le asignamos el nombre del proceso que deseamos descargar
        $zip = new ZipArchive;
        $file_name = $subproceso->codigo.'.zip';

        // Obtenemos los archivos de la carpeta del subproceso seleccionado
        $files = glob(storage_path('app/public/'.$subproceso->proceso->codigo.'/'.$subproceso->codigo.'/*/*.*'));

        if(empty($files)){
            return redirect()
            ->route('subprocesos.index')->With('error', 'El subproceso no cuenta con archivos internos.');
        }

        // Crear o sobrescribir el zip dentro de la carpeta zips
        if($zip->open(public_path('zips/'.$file_name), ZipArchive::CREATE|ZipArchive::OVERWRITE) === TRUE)
        {
            $docNomen = '';
            foreach ($files as $key => $value) {
                $docname = basename($value);
                $documentos = Documento::get();
                foreach ($documentos as $doc) {
                    if ($doc->nombre === $docname) {
                        $docNomen = $this->getDocNomenclaturado($doc);
                    }
                }
                $zip->addFile($value, $docNomen);
            }

            $zip->close();

            $actividades = ActividadesAdministradores::orderBy('id','desc')->first();
            if ($actividades == null){
                $actividad = new ActividadesAdministradores($request->all());
                $actividad->id=1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Descargó el subproceso "'.$request->nombre.'" ('.$request->codigo.')';
                $actividad->save();
            }else{
                $actividad = new ActividadesAdministradores($request->all());
                $actividad->id = ($actividades->id)+1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Descargó el subproceso "'.$request->nombre.'" ('.$request->codigo.')';
                $actividad->save();
            }

        }

        // Regresamos la vista con la descarga del zip
        return response()->download(public_path('zips/'.$file_name));
    }

    
    /**
     * Descarga el folder que se le indica en el url
     */
    public function downloadFolderProcesoPersonal(Request $request)
    {
        /**
         * Validar la contraseña del usuario
         */
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

        /**
         * En caso de que sea una contraseña incorrecta 
         * fallara la validacion y regresamos al index
         * Con el mensaje de contraseña incorrecta
         */
        if ($validator->fails()) {
            return back()
            ->withErrors($validator,'downloadFolder')
            ->withInput()
            ->With('error', 'La contraseña ingresada es incorrecta.');
        }
        
        // Buscamos el proceso personal del cual queremos descargar el zip
        $procPers = ProcesoPersonal::FindOrFail($request->id);

        // Creamos un zip y le asignamos el nombre del proceso que deseamos descargar
        $zip = new ZipArchive;
        $file_name = $procPers->codigo.'.zip';

        // Obtenemos los archivos de la carpeta del subproceso seleccionado
        $files = glob(storage_path('app/public/'.$procPers->subproceso->proceso->codigo.'/'.$procPers->subproceso->codigo.'/'.$procPers->codigo.'/*.*'));

        if(empty($files)){
            return redirect()
            ->route('subprocesos.index')->With('error', 'El subproceso no cuenta con archivos internos.');
        }

        // Crear o sobrescribir el zip dentro de la carpeta zips
        if($zip->open(public_path('zips/'.$file_name), ZipArchive::CREATE|ZipArchive::OVERWRITE) === TRUE)
        {
            $docNomen = '';
            foreach ($files as $key => $value) {
                $docname = basename($value);
                $documentos = Documento::get();
                foreach ($documentos as $doc) {
                    if ($doc->nombre === $docname) {
                        $docNomen = $this->getDocNomenclaturado($doc);
                    }
                }
                $zip->addFile($value, $docNomen);
            }

            $zip->close();

            $actividades = ActividadesAdministradores::orderBy('id','desc')->first();
            if ($actividades == null){
                $actividad = new ActividadesAdministradores($request->all());
                $actividad->id=1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Descargó el proceso personal "'.$request->nombre.'" ('.$request->codigo.')';
                $actividad->save();
            }else{
                $actividad = new ActividadesAdministradores($request->all());
                $actividad->id = ($actividades->id)+1;
                $actividad->id_user = $request->id_user;
                $actividad->accion = 'Descargó el proceso personal "'.$request->nombre.'" ('.$request->codigo.')';
                $actividad->save();
            }

        }

        // Regresamos la vista con la descarga del zip
        return response()->download(public_path('zips/'.$file_name));
    }


    /**
     * Metodo que consigue el nombre con nomenclatura de un documento
     */
    public function getDocNomenclaturado(Documento $documento)
    {
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

        return $full_name;
    }
}