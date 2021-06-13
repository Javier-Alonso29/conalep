<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubprocesoRequest extends FormRequest
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
        return ($this->user()->roles->name === 'SuperUsuario Estatal');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|unique:subprocesos',
            'codigo' => 'required|unique:subprocesos',
            'descripcion',
        ];
    }

    public function messages()
    {
        return [
            'nombre.unique' => 'Ya existe un subproceso registrado con este nombre',
            'nombre.required' => 'Debes de darle un nombre al subproceso',
            'codigo.required' => 'Debes de darle un codigo al subproceso',
            'codigo.unique' => 'Ya existe un subproceso con este codigo',
        ];
    }
}
