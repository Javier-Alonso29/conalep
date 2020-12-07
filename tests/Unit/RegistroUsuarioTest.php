<?php

namespace Tests\Unit;
use Tests\TestCase;

//use PHPUnit\Framework\TestCase;

class RegistroUsuarioTest extends TestCase
{



    /* 
        Verifica si no se escede el numero máximo de
        caracteres permitidos.
    */
    public function test_email_maximo_caracteres()
    {
        $userData = [
            "name" => "Eduardo",
            "email" => "ed118SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS@zac.conalep.edu.mx",
            "password" => "demo12345",
            "password_confirmation" => "demo12345",
            "app_paterno" => "Aguilar"
        ];

        $this->json('POST', '/register', $userData, ['Accept' => 'application/json'])
            ->assertJson([
                "errors" => [
                    "email" => ["Tu correo no puede exceder los 255 caracteres"]
                ]
            ]);
    }


    /*
        Verifica si el formato del email coincide
        con el del conalep.
    */
    public function test_email_formato_invalido()
    {
        $userData = [
            "name" => "Eduardo",
            "email" => "ed118@gmail.com",
            "password" => "demo12345",
            "app_paterno" => "Aguilar"
        ];

        $this->json('POST', '/register', $userData, ['Accept' => 'application/json'])
            ->assertJson([
                "errors" => [
                    "email" => ["Correo electrónico con formato invalido"]
                ]
            ]);
    }


    /* 
        Verifica si la contraseña coincide
        con la confirmación de ella.
    */
    public function test_pass_no_coincide()
    {
        $userData = [
            "name" => "Eduardo",
            "email" => "ed118@zac.conalep.edu.mx",
            "password" => "demo12345",
            "app_paterno" => "Aguilar"
        ];

        $this->json('POST', '/register', $userData, ['Accept' => 'application/json'])
            ->assertJson([
                "errors" => [
                    "password" => ["Las contraseñas no coinciden"]
                ]
            ]);
    }

    /* 
        Verifica si la contraseña tiene el mínimo
        de caracteres permitidos.
    */
    public function test_pass_minimo()
    {
        $userData = [
            "name" => "Eduardo",
            "email" => "ed118@zac.conalep.edu.mx",
            "app_paterno" => "Aguilar",
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


    /*
        Verifica si el nombre no excede el número
        máximo de caracteres permitidos.
    */
    public function test_nombre_maximo()
    {
        $userData = [
            "name" => "Eduardo Aguilar Yáñez SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS",
            "email" => "ed118@zac.conalep.edu.mx",
            "password" => "demo12345",
            "app_paterno" => "Aguilar"
        ];

        $this->json('POST', '/register', $userData, ['Accept' => 'application/json'])
            ->assertJson([
                "errors" => [
                    "name" => ["El nombre no puede contener más de 255 caracteres"]
                ]
            ]);
    }



}
