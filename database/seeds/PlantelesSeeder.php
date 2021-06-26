<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantelesSeeder extends Seeder
{
    /**
     * Seeder encargado de cargar todos los planteles que hay en el estado de Zacatecas.
     *
     * @return void
     */
    public function run()
    {
        $municipio_dolores_id = DB::table('municipios')->where('nombre','=','Zacatecas')->value('id');
        $municipio_fresnillo_id = DB::table('municipios')->where('nombre','=','Fresnillo')->value('id');
        $municipio_mazapil_id = DB::table('municipios')->where('nombre','=','Mazapil')->value('id');
        $municipio_zacatecas_id = DB::table('municipios')->where('nombre','=','Zacatecas')->value('id');

        DB::table('planteles')->insert(
            ['municipio_id'=>$municipio_dolores_id,'numero'=>'4286850104','clave_trabajo'=>'32DTP0001C']
        );

        DB::table('planteles')->insert(
            ['municipio_id'=>$municipio_fresnillo_id,'numero'=>'4939323355','clave_trabajo'=>'32DTP0002B']
        );

        DB::table('planteles')->insert(
            ['municipio_id'=>$municipio_mazapil_id,'numero'=>'8424242081','clave_trabajo'=>'DTP0003A']
        );

        DB::table('planteles')->insert(
            ['municipio_id'=>$municipio_zacatecas_id,'numero'=>'4928995040','clave_trabajo'=>'32APT0001F']
        );
    }
}
