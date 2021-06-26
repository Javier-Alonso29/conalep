<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubprocesosSeeder extends Seeder
{
    /**
     * Seeder encargado de cargar todos los subprocesos predefinidos.
     *
     * @return void
     */
    public function run()
    {

        /* 
        ---------------------------------------------------------
            ÁMBITO CONALEP
        ---------------------------------------------------------
        */
    
        #NO HAY SUBPROCESOS, SOLO PROCESOS Y MACROPROCESOS (ESTOS SON IGUALES A LOS PROCESOS DEL ÁMBITO CE Y PLANTEL).


        /* 
        ---------------------------------------------------------
            ÁMBITO CE 
        ---------------------------------------------------------
        */

        //SUBPROCESOS DEL PROCESO PSG
        #NO EXISTEN



        //SUBPROCESOS DEL PROCESO GSE
        DB::table('subprocesos')->insert(['nombre'=>'Coordinación y segumiento para la captación y registro de la matrícula','id_proceso'=>'2','codigo'=>'CSR','descripcion'=>' ']);
        DB::table('subprocesos')->insert(['nombre'=>'Coordinación y segumiento de la administración escolar','id_proceso'=>'2','codigo'=>'CSA','descripcion'=>' ']);



        //SUBPROCESOS DEL PROCESO GEA
        DB::table('subprocesos')->insert(['nombre'=>'Coordinación y seguimiento del proceso de enseñanza - aprendizaje','id_proceso'=>'3','codigo'=>'CSE','descripcion'=>' ']);



        //SUBPROCESOS DEL PROCESO VI
        DB::table('subprocesos')->insert(['nombre'=>'Coordinación y seguimiento de la vinculación institucional','id_proceso'=>'4','codigo'=>'CSV','descripcion'=>' ']);



        //SUBPROCESOS DEL PROCESO GR
        #LO MISMOS QUE EN EL ÁMBITO PLANTEL


        //SUBPROCESOS DEL PROCESO EDM
        #EL MISMO QUE EN EL ÁMBITO PLANTEL



        //SUBPROCESOS DEL PROCESO ME
        #EL MISMO QUE EN EL ÁMBITO PLANTEL





        /* 
        ---------------------------------------------------------
            ÁMBITO PLANTEL 
        ---------------------------------------------------------
        */

        //SUBPROCESOS DEL PROCESO PSG
        #NO EXISTEN



        //SUBPROCESOS DEL PROCESO GSE
        DB::table('subprocesos')->insert(['nombre'=>'Capacitación y registro de la matrícula','id_proceso'=>'2','codigo'=>'CRM','descripcion'=>' ']);
        DB::table('subprocesos')->insert(['nombre'=>'Administración escolar','id_proceso'=>'2','codigo'=>'ADE','descripcion'=>' ']);



        //SUBPROCESOS DEL PROCESO GEA
        DB::table('subprocesos')->insert(['nombre'=>'Enseñanza - Aprendizaje','id_proceso'=>'3','codigo'=>'EA','descripcion'=>' ']);



        //SUBPROCESOS DEL PROCESO VI
        DB::table('subprocesos')->insert(['nombre'=>'Vinculación institucional','id_proceso'=>'4','codigo'=>'SVI','descripcion'=>' ']);



        //SUBPROCESOS DEL PROCESO GR
        DB::table('subprocesos')->insert(['nombre'=>'Gestión del capital humano','id_proceso'=>'5','codigo'=>'GCH','descripcion'=>' ']);
        DB::table('subprocesos')->insert(['nombre'=>'Recursos financieros','id_proceso'=>'5','codigo'=>'RF','descripcion'=>' ']);
        DB::table('subprocesos')->insert(['nombre'=>'Infraestructura','id_proceso'=>'5','codigo'=>'INF','descripcion'=>' ']);
        DB::table('subprocesos')->insert(['nombre'=>'Ambiente escolar','id_proceso'=>'5','codigo'=>'AME','descripcion'=>' ']);
        DB::table('subprocesos')->insert(['nombre'=>'Apoyo','id_proceso'=>'5','codigo'=>'AP','descripcion'=>' ']);


        //SUBPROCESOS DEL PROCESO EDM
        DB::table('subprocesos')->insert(['nombre'=>'Evaluación del SCGC','id_proceso'=>'6','codigo'=>'EDS','descripcion'=>' ']);



        //SUBPROCESOS DEL PROCESO CONALEP
        DB::table('subprocesos')->insert(['nombre'=>'Mejora continua','id_proceso'=>'7','codigo'=>'MC','descripcion'=>' ']);
       
    }
}

