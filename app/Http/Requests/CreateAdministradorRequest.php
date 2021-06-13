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
        return ($this->user()->roles->name === 'Super Usuario'|| $this->user()->roles->name === 'SuperUsuario Estatal');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users|regex:/(.*)@zac\.conalep.edu.mx$/i',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Este correo ya está registrado.',
            'email.required' => 'El administrador debe tener un correo valido.',
            'email.regex' => 'Correo electrónico con formato invalido.',
            'email.max' => 'Correo electrónico excede los 255 caracteres.',
            'password.min' => 'La contraseña debe tener mínimo 8 caracteres',
            'password.required' => 'Se requiere una contraseña.',
            'password.confirmed' => 'Las contraseñas no conciden',
            'name.required' => 'Se requiere un nombre.',
            'name.max' => 'El nombre no puede contener más de 255 caracteres'
        ];
    }
}
