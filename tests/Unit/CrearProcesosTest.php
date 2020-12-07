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


class CrearProcesosTest extends TestCase
{

    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * Crear procesos cuando el nombre del proceso ya este en uso
     */
   public function test_crear_proceso_nombre_codigo_existentes()
    {

        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
        
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $proceso1 = factory(Proceso::class)->create(['nombre'=>'Proceso 1','codigo'=>'AAAC']);

        $result = $this->post(route('procesos.store'),['nombre'=>'Proceso 1','codigo'=>'AAAC']);

        $result->assertSessionHasErrors();
    }


    /**
     * Crear un proceso con los campos vacios, donde la base de datos
     * no acepta el nombre ni el codigo del proceso vacios.
     */
    public function test_crear_proceso_campos_vacios()
    {
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
        
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $result = $this->post(route('procesos.store'),['nombre'=>'','codigo'=>'']);

        $result->assertSessionHasErrors();
    }

    /**
    * Crear un proceso con sus valores correctos
    */
    public function test_crear_proceso_correcto()
    {
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
        
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $result = $this->post(route('procesos.store'),['nombre'=>'Proceso 1','codigo'=>'AAAC']);

        $this->assertDatabaseHas('procesos',[
            'nombre'=>'Proceso 1',
            'codigo'=>'AAAC'
        ]);
    }
}
