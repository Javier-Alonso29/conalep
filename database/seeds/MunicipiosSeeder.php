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

        DB::table('municipios')->insert(['nombre'=>'Apozol', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Apulco', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Atolinga ', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Benito Juárez', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Calera', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Cañitas de Felipe Pescador', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Concepción del Oro', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Cuauhtémoc', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Chalchihuites', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Fresnillo', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Trinidad García de la Cadena', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Genaro Codina', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'General Enrique Estrada', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'General Francisco R. Murguía', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'El Plateado de Joaquín Amaro ', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'General Pánfilo Natera', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Huanusco', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Guadalupe', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Jalpa', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Jerez', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Jiménez del Teul', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Juan Aldama', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Juchipila', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Loreto', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Luis Moya', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Mazapil', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Melchor Ocampo', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Mezquital del Oro', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Miguel Auza', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Momax', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Monte Escobedo', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Morelos', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Moyahua de Estrada', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Nochistlán de Mejía', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Noria de Ángeles', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Ojocaliente', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Pánuco', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Pinos', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Río Grande', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Sain Alto', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'El Salvador ', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Sombrerete', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Susticacán', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Tabasco', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Tepechitlán', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Tepetongo', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Teúl de González Ortega', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Tlaltenango de Sánchez Román', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Valparaíso', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Vetagrande', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Villa de Cos', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Villa García', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Villa González Ortega', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Villa Hidalgo', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Villanueva', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Zacatecas', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Trancoso', 'estado_id' => $estado_zacatecas_id]);
        DB::table('municipios')->insert(['nombre'=>'Santa María de la Paz', 'estado_id' => $estado_zacatecas_id]);
    }
}
