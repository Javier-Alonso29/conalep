<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estado_zacatecas_id = DB::table('estados')->where('nombre','=','Zacatecas')->value('id');

        DB::table('municipios')->insert(['nombre'=>'Dolores Castro Varela', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Fresnillo', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Mazapil', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Zacatecas', 'estado_id' => $estado_zacatecas_id]);
    }
}
