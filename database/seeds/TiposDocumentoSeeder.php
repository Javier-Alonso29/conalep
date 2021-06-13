<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipodocumento')->insert(['nombre'=>'TipoDoc1','codigo'=>'TDC1','descripcion'=>'Tipo de Documento 1']);
        DB::table('tipodocumento')->insert(['nombre'=>'TipoDoc2','codigo'=>'TDC2','descripcion'=>'Tipo de Documento 2']);
        DB::table('tipodocumento')->insert(['nombre'=>'TipoDoc3','codigo'=>'TDC3','descripcion'=>'Tipo de Documento 3']);
        DB::table('tipodocumento')->insert(['nombre'=>'TipoDoc4','codigo'=>'TDC4','descripcion'=>'Tipo de Documento 4']);
    }
}
