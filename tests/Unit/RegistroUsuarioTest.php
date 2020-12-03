<?php

namespace Tests\Unit;
use Tests\TestCase;

//use PHPUnit\Framework\TestCase;

class RegistroUsuarioTest extends TestCase
{


    public function test_campos_vacios()
    {
        $this->json('POST', '/register', ['Accept' => 'application/json'])
            ->assertJson([
                "errors" => [
                    "name" => ["Se requiere insertar un nombre para registrarse"],
                    "email" => ["Se requiere insertar un correo electrónico para registrarse"],
                    "password" => ["Se requiere una contraseña para registrarse"],
                ]
            ]);
    }



    public function test_email_ya_registrado()
    {
        $userData = [
            "name" => "Eduardo Aguilar Yáñez",
            "email" => "ed120@zac.conalep.edu.mx",
            "password" => "demo12345"
        ];

        $this->json('POST', '/register', $userData, ['Accept' => 'application/json'])
            ->assertJson([
                "errors" => [
                    "email" => ["Este correo ya está registrado"]
                ]
            ]);
    }



    public function test_email_maximo_caracteres()
    {
        $userData = [
            "name" => "Eduardo Aguilar Yáñez",
            "email" => "ed118SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS@zac.conalep.edu.mx",
            "password" => "demo12345",
            "password_confirmation" => "demo12345"
        ];

        $this->json('POST', '/register', $userData, ['Accept' => 'application/json'])
            ->assertJson([
                "errors" => [
                    "email" => ["Tu correo no puede exceder los 255 caracteres"]
                ]
            ]);
    }



    public function test_email_formato_invalido()
    {
        $userData = [
            "name" => "Eduardo Aguilar Yáñez",
            "email" => "ed118@gmail.com",
            "password" => "demo12345"
        ];

        $this->json('POST', '/register', $userData, ['Accept' => 'application/json'])
            ->assertJson([
                "errors" => [
                    "email" => ["Correo electrónico con formato invalido"]
                ]
            ]);
    }



    public function test_pass_no_coincide()
    {
        $userData = [
            "name" => "Eduardo Aguilar Yáñez",
            "email" => "ed118@zac.conalep.edu.mx",
            "password" => "demo12345"
        ];

        $this->json('POST', '/register', $userData, ['Accept' => 'application/json'])
            ->assertJson([
                "errors" => [
                    "password" => ["Las contraseñas no coinciden"]
                ]
            ]);
    }

    public function test_pass_minimo()
    {
        $userData = [
            "name" => "Eduardo Aguilar Yáñez",
            "email" => "ed118@zac.conalep.edu.mx",
            "password" => "d",
            "password_confirmation" => "d"
        ];

        $this->json('POST', '/register', $userData, ['Accept' => 'application/json'])
            ->assertJson([
                "errors" => [
                    "password" => ["La contraseña debe tener mínimo 8 caracteres"]
                ]
            ]);
    }


    public function test_nombre_maximo()
    {
        $userData = [
            "name" => "Eduardo Aguilar Yáñez SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS",
            "email" => "ed118@zac.conalep.edu.mx",
            "password" => "demo12345"
        ];

        $this->json('POST', '/register', $userData, ['Accept' => 'application/json'])
            ->assertJson([
                "errors" => [
                    "name" => ["El nombre no puede contener más de 255 caracteres"]
                ]
            ]);
    }



    public function test_registro_exitoso()
    {
        $userData = [
            "name" => "Eduardo Aguilar Yáñez",
            "email" => "ed125@zac.conalep.edu.mx",
            "password" => "demo12345",
            "password_confirmation" => "demo12345"
        ];


        $response = $this->json('POST', '/register', $userData, ['Accept' => 'application/json']);

        $response->assertRedirect('');
            
    }


}
