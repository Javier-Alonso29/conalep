<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlantelRequest extends FormRequest
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
            'numero' => 'required|integer',
            'clave_trabajo' => 'required',
            'municipio' => 'required',
            'nombre_plantel' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'numero.unique' => 'Este numero de plantel ya está registrado.',
            'numero.required' => 'El plantel debe tener un numero de plantel.',
            'numero.integer' => 'Debes de ingresar un numero',
            'clave_trabajo.required' => 'El plantel debe de tener una clave de trabajo',
            'nombre_plantel.required' => 'El plantel debe de tener un nombre',
        ];
    }
}