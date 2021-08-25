<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ZipArchive;
use App\Models\Proceso;
use App\Models\Subproceso;
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
            ->withErrors($validator,'donwloadFolder')
            ->withInput()
            ->With('error', 'La contraseña ingresada es incorrecta.');
        }
        
        // Buscamos el proceso del cual queremos descargar el zip
        $proceso = Proceso::FindOrFail($request->id);

        // Creamos un zip y le asignamos el nombre del proceso que deseamos descargar
        $zip = new ZipArchive;
        $file_name = $proceso->codigo.'.zip';

        // Obtenemos los archivos de la carpeta del proceso seleccionado
        $files = File::files(public_path('storage/'.$proceso->codigo));

        if(empty($files)){
            return redirect()
            ->route('procesos.index')->With('error', 'El proceso no cuenta con archivos internos.');
        }

        // Crear o sobrescribir el zip dentro de la carpeta zips
        if($zip->open(public_path('zips/'.$file_name), ZipArchive::CREATE|ZipArchive::OVERWRITE) === TRUE)
        {
            

            foreach($files as $key => $value)
            {   
                // home/vagrant/code/conalep/storage/app/public/PRC/PruebaArchivo.txt

                //PruebaArchivo.txt
                $relativeNameInZipFile = basename($value);

                //Guardamos el archivo dentro del zip
                $guardado = $zip->addFile($value , $relativeNameInZipFile);
            }

            // Cerramos el zip
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
        
        // Buscamos el proceso del cual queremos descargar el zip
        $subproceso = Subproceso::FindOrFail($request->id);

        // Creamos un zip y le asignamos el nombre del proceso que deseamos descargar
        $zip = new ZipArchive;
        $file_name = $subproceso->codigo.'.zip';

        // Obtenemos los archivos de la carpeta del proceso seleccionado
        $files = File::files(public_path('storage/'.$subproceso->proceso->codigo.'/'.$subproceso->codigo));

        if(empty($files)){
            return redirect()
            ->route('subprocesos.index')->With('error', 'El proceso no cuenta con archivos internos.');
        }

        // Crear o sobrescribir el zip dentro de la carpeta zips
        if($zip->open(public_path('zips/'.$file_name), ZipArchive::CREATE|ZipArchive::OVERWRITE) === TRUE)
        {
            

            foreach($files as $key => $value)
            {   
                // home/vagrant/code/conalep/storage/app/public/PRC/PruebaArchivo.txt

                //PruebaArchivo.txt
                $relativeNameInZipFile = basename($value);

                //Guardamos el archivo dentro del zip
                $guardado = $zip->addFile($value , $relativeNameInZipFile);
            }

            // Cerramos el zip
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
}