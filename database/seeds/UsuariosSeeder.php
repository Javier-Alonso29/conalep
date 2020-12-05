<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol_super_usuario = DB::table('roles')->where('id',1)->value('id');

        DB::table('users')->insert(
            ['name'=>'Test',
            'apellido_paterno'=>'Test',
            'apellido_materno'=>'Test',
            'email'=>'test@zac.conalep.edu.mx',
            'password'=>Hash::make('testtesttest'),
            'rol_id'=>$rol_super_usuario]
        );

    }
}
