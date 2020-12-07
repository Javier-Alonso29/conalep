<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use Artisan;

class InicioSesionTest extends TestCase
{
    /**
     *  Verifica si muestra el formulario 
     *  de login al inicio.
    */
    public function test_usuario_ve_formulario_login()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

   

    /**
     * Verifica si se queda en la misma pagina
     * si se insertan mal los datos de login.
    */
    public function test_login_pass_incorrecta(){
        $response = $this->call('POST', '/login', [
            'email' => 'ed120@zac.conalep.edu.mx',
            'password' => 'conalep',
            '_token' => csrf_token()
        ]);
        
        $response->assertRedirect('');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    /**
     * Verifica si se queda en la misma pagina
     * si no se inserta el email.
    */
    public function test_login_email_vacio(){
        $response = $this->call('POST', '/login', [
            'email' => '',
            'password' => 'conalep',
            '_token' => csrf_token()
        ]);
        
        $response->assertRedirect('');
    }

    
    /**
     * Verifica si se queda en la misma pagina
     * si no se inserta la constraseña.
    */
    public function test_login_pass_vacio(){
        $response = $this->call('POST', '/login', [
            'email' => 'ed120@zac.conalep.edu.mx',
            'password' => '',
            '_token' => csrf_token()
        ]);
        
        $response->assertRedirect('');
    }
    


}
