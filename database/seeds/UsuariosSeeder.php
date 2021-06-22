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
        $plantel_2 = DB::table('planteles')->where('id',2)->value('id');
        $plantel_3 = DB::table('planteles')->where('id',3)->value('id');

        DB::table('users')->insert(
            ['name'=>'Super',
            'apellido_paterno'=>'Usuario',
            'apellido_materno'=>'Uno',
            'email'=>'test@zac.conalep.edu.mx',
            'password'=>Hash::make('testtesttest'),
            'rol_id'=>$rol_super_usuario,
            'id_plantel' => $plantel
            ]
        );

        DB::table('users')->insert(
            ['name'=>'Super',
            'apellido_paterno'=>'Usuario',
            'apellido_materno'=>'Dos',
            'email'=>'superusuario_plantel2@zac.conalep.edu.mx',
            'password'=>Hash::make('testtesttest'),
            'rol_id'=>$rol_super_usuario,
            'id_plantel' => $plantel_2
            ]
        );

        DB::table('users')->insert(
            ['name'=>'Super',
            'apellido_paterno'=>'Usuario',
            'apellido_materno'=>'Tres',
            'email'=>'superusuario_plantel3@zac.conalep.edu.mx',
            'password'=>Hash::make('testtesttest'),
            'rol_id'=>$rol_super_usuario,
            'id_plantel' => $plantel_3
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
