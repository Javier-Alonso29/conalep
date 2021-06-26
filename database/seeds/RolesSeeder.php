<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Seeder encargado de cargar todos los roles predefinidos.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['name'=>'Super Usuario']);
        DB::table('roles')->insert(['name'=>'Administrador']);
        DB::table('roles')->insert(['name'=>'SuperUsuario Estatal']);
    }
}