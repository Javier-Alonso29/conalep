<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert(['nombre'=>'Aguascalientes']);
        DB::table('estados')->insert(['nombre'=>'Baja California']);
        DB::table('estados')->insert(['nombre'=>'Baja California Sur']);
        DB::table('estados')->insert(['nombre'=>'Campeche']);
        DB::table('estados')->insert(['nombre'=>'Chiapas']);
        DB::table('estados')->insert(['nombre'=>'Chihuahua']);
        DB::table('estados')->insert(['nombre'=>'Coahuila']);
        DB::table('estados')->insert(['nombre'=>'Colima']);
        DB::table('estados')->insert(['nombre'=>'Distrito Federal']);
        DB::table('estados')->insert(['nombre'=>'Durango']);
        DB::table('estados')->insert(['nombre'=>'Estado de México']);
        DB::table('estados')->insert(['nombre'=>'Guanajuato']);
        DB::table('estados')->insert(['nombre'=>'Guerrero']);
        DB::table('estados')->insert(['nombre'=>'Hidalgo']);
        DB::table('estados')->insert(['nombre'=>'Jalisco']);
        DB::table('estados')->insert(['nombre'=>'Michoacán']);
        DB::table('estados')->insert(['nombre'=>'Morelos']);
        DB::table('estados')->insert(['nombre'=>'Nayarit']);
        DB::table('estados')->insert(['nombre'=>'Nuevo León']);
        DB::table('estados')->insert(['nombre'=>'Oaxaca']);
        DB::table('estados')->insert(['nombre'=>'Puebla']);
        DB::table('estados')->insert(['nombre'=>'Querétaro']);
        DB::table('estados')->insert(['nombre'=>'Quintana Roo']);
        DB::table('estados')->insert(['nombre'=>'San Luis Potosí']);
        DB::table('estados')->insert(['nombre'=>'Sinaloa']);
        DB::table('estados')->insert(['nombre'=>'Sonora']);
        DB::table('estados')->insert(['nombre'=>'Tabasco']);
        DB::table('estados')->insert(['nombre'=>'Tamaulipas']);
        DB::table('estados')->insert(['nombre'=>'Tlaxcala']);
        DB::table('estados')->insert(['nombre'=>'Veracruz']);
        DB::table('estados')->insert(['nombre'=>'Yucatán']);
        DB::table('estados')->insert(['nombre'=>'Zacatecas']);
    }
}
