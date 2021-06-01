<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePermisoRequest extends FormRequest
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
        return ($this->user()->roles->name === 'Super Usuario' || $this->user()->roles->name === 'SuperUsuario Estatal';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_plantel' => 'required',
            'id_user' => 'required',
            'id_proceso' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id_plantel' => 'El permiso debe de asignarse a un plantel',
            'id_user' => 'El permiso debe de asignarse a un usuario',
            'id_proceso' => 'El permiso debe de asignarse a un proceso',
        ];
    }
}