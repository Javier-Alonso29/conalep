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
            ->withErrors($validator,'donwloadFolder')
            ->withInput();
        }
        
        $proceso = Proceso::FindOrFail($request->id);

        //Creo que archivo zip con el nombre del proceso
        $zip = new ZipArchive;
        $fileName = $proceso->codigo.'.zip';
        Storage::put('public/'.$fileName, $zip);

        $creado = $zip->open(public_path($fileName), ZipArchive::CREATE);

        if($creado == TRUE)
        {
            $files = Storage::allFiles('public/'.$proceso->codigo);
            
            foreach($files as $key=>$value)
            {
                $relativeName = basename($value);

                $zip->addFiles($value, $relativeName);
            }

            $zip->close();

        }
        //dd(public_path($fileName));
        return response()->download(public_path($fileName));
    }
}