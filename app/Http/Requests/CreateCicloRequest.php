<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCicloRequest extends FormRequest
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
            'nombre' => 'required',
            'inicio' => 'required|integer',
            'conclusion' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El ciclo escolar debe tener un nombre.',
            'inicio.required' => 'El ciclo escolar debe tener un inicio.',
            'conclusion.required' => 'El ciclo escolar debe tener un final.',
            'inicio.integer' => 'Debes de ingresar un numero',
            'conclusion.integer' => 'Debes de ingresar un numero',
        ];
    }
}