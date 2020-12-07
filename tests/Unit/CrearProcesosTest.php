<?php

namespace Tests\Unit;

//use Illuminate\Foundation\Auth\User;

//use App\Models\User;
//use PHPUnit\Framework\TestCase;

use App\User;
use App\Models\Proceso;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Artisan;

//use PHPUnit\Framework\TestCase;


class CrearProcesosTest extends TestCase
{

    use RefreshDatabase;
    use WithoutMiddleware;


    /*public function test_index_muestra_procesos(){
        $user = factory(User::class)->create();
        
        $proceso_1=$user->procesos()->create();
        $proceso_2=
    }*/

   public function test_crear_proceso_nombre_codigo_existentes()
    
    {
        
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $processData = [
            "nombre" => "Servicios Escolares",
            "codigo" => "GSE",
            "descripción" => "Departamento de servicios escolares",
        ];

        $response=$this->json('POST','administrador/procesos',$processData,['Accept' => 'application/json']);
        $response->assertJson([
            "errors" => [
                "nombre" => ["Ya existe un proceso registrado con este nombre"],
                "codigo" => ["Ya existe un proceso con este codigo"]
            ]
        ]);
    }



    public function test_crear_proceso_campos_vacios()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $processData = [
            "nombre" => "",
            "codigo" => "",
            "descripción" => "",
        ];

        $response=$this->post('administrador/procesos',$processData,['Accept' => 'application/json']);
        $response->assertStatus(302);
    }

    /* 
        Verifica si un proceso fue creado
        correctamente.
    */
    public function test_crear_proceso_correcto()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $processData = [
            "nombre" => "Recursos Humanos S",
            "codigo" => "RHS",
            "descripción" => "Departamento de recursos humanos",
        ];

        $response=$this->post('administrador/procesos',$processData,['Accept' => 'application/json'])
        ->assertSuccessful();
    }
}
