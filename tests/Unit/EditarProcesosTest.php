<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Artisan;
use App\Models\Proceso;

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


    /**
     * Usuario con el rol de administrador puede actualizar un proceso
     * registrado en la base de datos y ver los datos actualizados en la base de datos
     * 
    */
    public function test_usuario_autenticado_actualiza_proceso()
    {

        // Borramos los procesos creados en las pruebas anteriores 
        

        Artisan::call('migrate:fresh');
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
}
