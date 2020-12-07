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
            'email' => 'required|unique:users',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Ya existe un administrador registrado con este E-Mail.',
            'email.required' => 'Debes de darle un E-Mail valido al administrador.',
        ];
    }
}
