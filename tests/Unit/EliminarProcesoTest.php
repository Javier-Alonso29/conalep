<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use App\User;
use Tests\TestCase;
use Artisan;
use App\Models\Proceso;


class EliminarProcesoTest extends TestCase
{
    
    public function test_eliminar_proceso_contraseña_incorrecta()
    {

        $this->withOutExceptionHandling();

        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');

        $user = factory(User::class)->create(['password'=>'contraseña']);
        $this->actingAs($user);

        $proceso = factory(Proceso::class)->create();

        $result = $this->delete(route('procesos.destroy',1),[
            'id' => 1,
            'contraseña' => 'p'
        ]);

        $result->assertSessionHasErrors();
    }
}


