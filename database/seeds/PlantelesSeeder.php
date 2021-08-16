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
        $municipio_guadalupe_id = DB::table('municipios')->where('nombre','=','Guadalupe')->value('id');
        $municipio_fresnillo_id = DB::table('municipios')->where('nombre','=','Fresnillo')->value('id');
        $municipio_mazapil_id = DB::table('municipios')->where('nombre','=','Mazapil')->value('id');
        #$municipio_zacatecas_id = DB::table('municipios')->where('nombre','=','Zacatecas')->value('id');


        //PLANTEL GUADALUPE (Mtra. Dolores Castro Varela)
        DB::table('planteles')->insert(
            ['municipio_id'=>$municipio_guadalupe_id,'numero'=>'538','clave_trabajo'=>'32DTP0001C','nombre_plantel'=>'Plantel Guadalupe']
        );

        //PLANTEL FRESNILLO
        DB::table('planteles')->insert(
            ['municipio_id'=>$municipio_fresnillo_id,'numero'=>'136','clave_trabajo'=>'32DTP0002B','nombre_plantel'=>'Plantel Fresnillo']
        );

        //PLANTEL MAZAPIL
        DB::table('planteles')->insert(
            ['municipio_id'=>$municipio_mazapil_id,'numero'=>'123','clave_trabajo'=>'32DPT0003A','nombre_plantel'=>'Plantel Mazapil']
        );

        /*DB::table('planteles')->insert(
            ['municipio_id'=>$municipio_zacatecas_id,'numero'=>'4928995040','clave_trabajo'=>'32APT0001F']
        );*/
    }
}
