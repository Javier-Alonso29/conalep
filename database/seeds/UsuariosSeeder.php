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
        $rol_administrador = DB::table('roles')->where('id',2)->value('id');
        $rol_SU_Estatal = DB::table('roles')->where('id',3)->value('id');
        $plantel = DB::table('planteles')->where('id',1)->value('id');

        DB::table('users')->insert(
            ['name'=>'Test',
            'apellido_paterno'=>'Test',
            'apellido_materno'=>'Test',
            'email'=>'test@zac.conalep.edu.mx',
            'password'=>Hash::make('testtesttest'),
            'rol_id'=>$rol_super_usuario,
            'id_plantel' => $plantel
            ]
        );

        DB::table('users')->insert(
            ['name'=>'Carlos Javier',
            'apellido_paterno'=>'Alonso',
            'apellido_materno'=>'Caldera',
            'email'=>'kAlonso835@zac.conalep.edu.mx',
            'password'=>Hash::make('12345678'),
            'rol_id'=>$rol_administrador,
            'id_plantel' => $plantel
            ]
        );

        DB::table('users')->insert(
            ['name'=>'Estatal',
            'apellido_paterno'=>'Test',
            'apellido_materno'=>'Test',
            'email'=>'testEstatal@zac.conalep.edu.mx',
            'password'=>Hash::make('testtesttest'),
            'rol_id'=>$rol_SU_Estatal,
            'id_plantel' => $plantel
            ]
        );

    }
}
