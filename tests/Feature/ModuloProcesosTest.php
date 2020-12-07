<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Models\Proceso;
use Artisan;

class ModuloProcesosTest extends TestCase
{
    use RefreshDatabase;

    public function test_muestra_lista_procesos()
    {
        // $this->withOutExceptionHandling();

        Artisan::call('migrate');
        Artisan::call('db:seed');

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $pro = factory(Proceso::class, 3)->create();


        $result = $this->get(route('procesos.index'));

        $result->assertOk();

        $procesos =  Proceso::all();

        $result->assertViewIs('administrador.procesos.index');
    }
    
    /**
     * Un usuario con el rol de Administrador puede crear un proceso
     * con los datos de nombre, codigo y descripcion y esos datos 
     * se ven reflejados en la baase de datos.
     */
    public function test_usuario_autenticado_puede_crear_procesos()
    {

        $this->withOutExceptionHandling();

        Artisan::call('migrate');
        Artisan::call('db:seed');

        // 1.- Teniendo un usuario registrado
        $user = factory(User::class)->create();
        $this->actingAs($user);

        // 2.- Cuando hace un post request a status
        $result = $this->post(route('procesos.store'),['nombre'=>'Prueba Proceso','codigo'=>'PRC']);

        // 3.- Entonces veo un nuevo proceso en la base de datos
        $this->assertDatabaseHas('procesos',[
            'nombre'=>'Prueba Proceso',
            'codigo'=>'PRC'
        ]);
    }

    /**
     * Un usuario con el rol de Administrador puede crear un proceso
     * con los datos de nombre y descripcion, esos datos 
     * no se ven reflejados en la base de datos ya que 
     * el request valida que debe de tener un nombre y un ccodigo de proceso
     */
    public function test_usuario_autenticado_no_crea_procesos()
    {

        Artisan::call('migrate');
        Artisan::call('db:seed');

        // 1.- Teniendo un usuario registrado
        $user = factory(User::class)->create();
        $this->actingAs($user);

        // 2.- Cuando hace un post request a status
        $result = $this->post(route('procesos.store'),['nombre'=>'Prueba Proceso 2']);

        // 3.- Entonces no veo el nuevo proceso en la base de datos
        $this->assertDatabaseMissing('procesos',[
            'nombre'=>'Prueba Proceso 2'
        ]);
    }

    /**
     * Usuario con el rol de administrador puede actualizar un proceso
     * registrado en la base de datos y ver los datos actualizados en la base de datos
     * 
    */
    public function test_usuario_autenticado_actualiza_proceso()
    {

        // Borramos los procesos creados en las pruebas anteriores 
        Proceso::destroy(1,2,3,4,5);

        Artisan::call('migrate');
        Artisan::call('db:seed');

        // 1.- Teniendo un usuario registrado
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $proces = factory(Proceso::class)->create();
        
        $result = $this->put(route('procesos.update',1), [
            'id'=>$proces->id,
            'nombre'=>'Proceso actualizado',
            'codigo'=>'PPA',
            'descripcion'=>'actualizado correctamente'
        ]);

        $this->assertCount(1, Proceso::all());

        $proces = $proces->fresh();

        $this->assertDatabaseMissing('procesos',[
            'nombre'=>'Proceso actualizado',
            'codigo'=>'PPA',
            'descripcion'=>'actualizado correctamente'
        ]);
    }

    /**
     * Usuario con el rol de administrador puede borrar un proceso
     * registrado en la base de datos y ver que los datos 
     * 
    */
    public function test_usuario_autenticado_borra_proceso()
    {

        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');

        // 1.- Teniendo un usuario registrado
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $proceso = factory(Proceso::class)->create();

        $result = $this->delete(route('procesos.destroy',1),[
            'id'=>1, 
            'contraseña'=>'password'
            ]);

        $this->assertDatabaseMissing('procesos',[
            'nombre'=> $proceso->nombre,
            'codigo'=> $proceso->codigo,
            'descripcion'=> $proceso->descripcion
        ]);

    }



}
