<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProcesoPersonalRequest extends FormRequest
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
        return ($this->user()->roles->name === 'Administrador' || $this->user()->roles->name === 'Super Usuario');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'proceso' => 'required',
            'nombre' => 'required|unique:proceso_personal',
            'codigo' => 'required|unique:proceso_personal',
            'descripcion',
        ];
    }

    public function messages()
    {
        return [
            'proceso'=>'Debes de tener un proceso seleccionado',
            'subproceso'=>'Debes de tener un subproceso seleccionado',
            'nombre.unique' => 'Ya existe un proceso registrado con este nombre',
            'nombre.required' => 'Debes de darle un nombre al proceso',
            'codigo.required' => 'Debes de darle un codigo al proceso',
            'codigo.unique' => 'Ya existe un proceso con este codigo',
        ];
    }
}
