<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
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