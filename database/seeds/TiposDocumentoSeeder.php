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
        DB::table('tipodocumento')->insert(['nombre'=>'PDF','codigo'=>'PDF','descripcion'=>'Archivos tipo PDF']);
        DB::table('tipodocumento')->insert(['nombre'=>'TXT','codigo'=>'TXT','descripcion'=>'Archivos tipo TXT']);
    }
}
