<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubprocesosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subprocesos')->insert(['nombre'=>'SProc1','id_proceso'=>'1','codigo'=>'SP1','descripcion'=>'Subproceso 1']);
        DB::table('subprocesos')->insert(['nombre'=>'SProc2','id_proceso'=>'1','codigo'=>'SP2','descripcion'=>'Subproceso 2']);
        DB::table('subprocesos')->insert(['nombre'=>'SProc3','id_proceso'=>'2','codigo'=>'SP3','descripcion'=>'Subproceso 3']);
        DB::table('subprocesos')->insert(['nombre'=>'SProc4','id_proceso'=>'2','codigo'=>'SP4','descripcion'=>'Subproceso 4']);
        DB::table('subprocesos')->insert(['nombre'=>'SProc5','id_proceso'=>'3','codigo'=>'SP5','descripcion'=>'Subproceso 5']);
    }
}
