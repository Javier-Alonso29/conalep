<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdministradorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /**
         * Para saber si el usuario que esta haciendo la peticion es un superusuario
         */
        return $this->user()->roles->name === 'Super Usuario';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|unique:procesos',
            'descripcion',
        ];
    }

    public function messages()
    {
        return [
            'nombre.unique' => 'Ya existe un proceso registrado con este nombre',
            'nombre.required' => 'Debes de darle un nombre al proceso',
        ];
    }
}
