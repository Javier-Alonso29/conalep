<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDocumentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /**
         * Para saber si el usuario que esta haciendo la peticion es un administrador
         */
        return ($this->user()->roles->name === 'Administrador' || $this->user()->roles->name === 'Super Usuario' || $this->user()->roles->name === 'SuperUsuario Estatal');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required',
            'id_tipodocumento' => 'required',
            'id_subproceso' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El documento debe tener un nombre',
            'id_tipodocumento.required' => 'El documento debe tener un tipo de documento asignado',
            'id_subproceso.required' => 'El documento debe estar asignado a un subproceso',
        ];
    }
}
