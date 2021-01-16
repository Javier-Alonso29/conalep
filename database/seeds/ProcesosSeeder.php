<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcesosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('procesos')->insert(['nombre'=>'Proc1','codigo'=>'PR1','descripcion'=>'Proceso 1']);
        DB::table('procesos')->insert(['nombre'=>'Proc2','codigo'=>'PR2','descripcion'=>'Proceso 2']);
        DB::table('procesos')->insert(['nombre'=>'Proc3','codigo'=>'PR3','descripcion'=>'Proceso 3']);
        DB::table('procesos')->insert(['nombre'=>'Proc4','codigo'=>'PR4','descripcion'=>'Proceso 4']);
        DB::table('procesos')->insert(['nombre'=>'Proc5','codigo'=>'PR5','descripcion'=>'Proceso 5']);
    }
}