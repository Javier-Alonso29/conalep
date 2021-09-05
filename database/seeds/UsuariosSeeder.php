<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Seeder encargado de cargar todos los usuarios predefinidos.
     *
     * @return void
     */
    public function run()
    {
        /* 
            Variables que referencian a los roles y los planteles 
        */
        $rol_super_usuario = DB::table('roles')->where('id',1)->value('id');
        $rol_administrador = DB::table('roles')->where('id',2)->value('id');
        $rol_SU_Estatal = DB::table('roles')->where('id',3)->value('id');
        $plantel = DB::table('planteles')->where('id',1)->value('id');
        $plantel_2 = DB::table('planteles')->where('id',2)->value('id');
        $plantel_3 = DB::table('planteles')->where('id',3)->value('id');

        //Superusuario por defecto del plantel 1: Guadalupe
        DB::table('users')->insert(
            ['name'=>'Super',
            'apellido_paterno'=>'Usuario',
            'apellido_materno'=>'Uno',
            'email'=>'superusuario_plantel1@zac.conalep.edu.mx',
            'password'=>Hash::make('Superusuario121$#'),
            'rol_id'=>$rol_super_usuario,
            'id_plantel' => $plantel
            ]
        );

        //Superusuario por defecto del plantel 2: Fresnillo
        DB::table('users')->insert(
            ['name'=>'Super',
            'apellido_paterno'=>'Usuario',
            'apellido_materno'=>'Dos',
            'email'=>'superusuario_plantel2@zac.conalep.edu.mx',
            'password'=>Hash::make('Superusuario122$#'),
            'rol_id'=>$rol_super_usuario,
            'id_plantel' => $plantel_2
            ]
        );

        //Superusuario por defecto del plantel 3: Mazapil
        DB::table('users')->insert(
            ['name'=>'Super',
            'apellido_paterno'=>'Usuario',
            'apellido_materno'=>'Tres',
            'email'=>'superusuario_plantel3@zac.conalep.edu.mx',
            'password'=>Hash::make('Superusuario123$#'),
            'rol_id'=>$rol_super_usuario,
            'id_plantel' => $plantel_3
            ]
        );

        //Superusuario estatal por defecto
        DB::table('users')->insert(
            ['name'=>'Super',
            'apellido_paterno'=>'Usuario',
            'apellido_materno'=>'Estatal',
            'email'=>'superusuario_estatal@zac.conalep.edu.mx',
            'password'=>Hash::make('Superestatal123@!'),
            'rol_id'=>$rol_SU_Estatal,
            'id_plantel' => $plantel
            ]
        );

    }
}
