<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcesoPersonal extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proceso_personal')->insert(['nombre'=>'Certificados','codigo'=>'PR1','descripcion'=>'Certificados que he obtenido dentro del conalep', 'id_subproceso'=>'1', 'id_usuario'=>'4', 'id_plantel'=>'1', 'id_proceso'=>'1']);
        DB::table('proceso_personal')->insert(['nombre'=>'Documentos','codigo'=>'PR2','descripcion'=>'Reportes semestrales', 'id_subproceso'=>'1', 'id_usuario'=>'4', 'id_plantel'=>'1', 'id_proceso'=>'1']);
        DB::table('proceso_personal')->insert(['nombre'=>'Excel','codigo'=>'PR3','descripcion'=>'Matriculas de los alumnos', 'id_subproceso'=>'1', 'id_usuario'=>'4', 'id_plantel'=>'1', 'id_proceso'=>'1']);
        DB::table('proceso_personal')->insert(['nombre'=>'Prueba','codigo'=>'PR4','descripcion'=>'Prueba de otro plantel', 'id_subproceso'=>'1', 'id_usuario'=>'5', 'id_plantel'=>'2', 'id_proceso'=>'1']);
    }
}