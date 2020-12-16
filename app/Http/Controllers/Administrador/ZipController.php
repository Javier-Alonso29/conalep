<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ZipArchive;
use App\Models\Proceso;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Auth;
use File;

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
            ->withInput();
        }
        
        // Buscamos el proceso del cual queremos descargar el zip
        $proceso = Proceso::FindOrFail($request->id);

        // Creamos un zip y le asignamos el nombre del proceso que deseamos descargar
        $zip = new ZipArchive;
        $file_name = $proceso->codigo.'.zip';

        // Crear o sobrescribir el zip dentro de la carpeta zips
        if($zip->open(public_path('zips/'.$file_name), ZipArchive::CREATE|ZipArchive::OVERWRITE) === TRUE)
        {
            // Obtenemos los archivos de la carpeta del proceso seleccionado
            $files = File::files(public_path('storage/'.$proceso->codigo));

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

        }

        // Regresamos la vista con la descarga del zip
        return response()->download(public_path($file_name));
    }
}