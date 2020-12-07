<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use App\User;
use Tests\TestCase;

class EditarProcesosTest extends TestCase
{

    public function test_editar_proceso_nombre_codigo_existentes()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $processData = [
            "edit_proceso" => "Servicios Escolares",
            "edit_codigo" => "GSE",
            "edit_descripcion" => "Departamento de servicios escolares",
            "id_proceso" => 2,
            "_token" => csrf_token(),
            "_method" => "PUT",
        ];

        $response=$this->json('POST','administrador/procesos/1',$processData);
        $response->assertStatus(302);
    }



    public function test_editar_proceso_campos_vacios()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $processData = [
            "edit_proceso" => "",
            "edit_codigo" => "",
            "edit_descripcion" => "",
            "id_proceso" => 2,
            '_token' => csrf_token(),
            "_method" => "PUT",
        ];

        $response=$this->json('POST','administrador/procesos/1',$processData);
        $response->assertStatus(302);
    }


    public function test_editar_proceso_correcto()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $processData = [
            "edit_proceso" => "Recursos Humanos Sociales",
            "edit_codigo" => "RHS",
            "edit_descripcion" => "Departamento de recursos humanos sociales",
            "id_proceso" => 2,
            "_token" => csrf_token(),
            "_method" => "PUT",
        ];

        $response=$this->json('POST','administrador/procesos/1',$processData);
        $response->assertStatus(200);
    }
}
