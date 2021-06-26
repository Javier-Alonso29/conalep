<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposDocumentoSeeder extends Seeder
{
    /**
     * Seeder encargado de cargar todos los tipos de documentos predefinidos.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipodocumento')->insert(['nombre'=>'Base de Datos','codigo'=>'BD','descripcion'=>'Documentos de tipo Base de Datos.']);
        DB::table('tipodocumento')->insert(['nombre'=>'Croquis o distribución física de la Unidad Administrativa','codigo'=>'CR','descripcion'=>'Documentos referentes a la distribución física de la unidad administrativa.']);
        DB::table('tipodocumento')->insert(['nombre'=>'Encuesta de satisfacción o de opinión','codigo'=>'ES','descripcion'=>'Documentos referentes a encuestas de satisfacción o de opinión.']);
        DB::table('tipodocumento')->insert(['nombre'=>'Evaluación de proveedores','codigo'=>'EP','descripcion'=>'Documentos que contienen información sobre evaluaciones de proveedores.']);
        DB::table('tipodocumento')->insert(['nombre'=>'Guía','codigo'=>'GA','descripcion'=>'Documentos referentes a las guías implementadas en la institución.']);
        DB::table('tipodocumento')->insert(['nombre'=>'Instructivo','codigo'=>'IN','descripcion'=>'Instructiuvos implementados en la institución.']);
        DB::table('tipodocumento')->insert(['nombre'=>'Organigrama','codigo'=>'OG','descripcion'=>'Organigramas referentes a las estructuras implementadas en la institución.']);
        DB::table('tipodocumento')->insert(['nombre'=>'Manual','codigo'=>'MA','descripcion'=>'Documentos referentes a los manuales implementados en la institución.']);
        DB::table('tipodocumento')->insert(['nombre'=>'Programa','codigo'=>'PM','descripcion'=>'Programas que se implementan en la institución.']);
        DB::table('tipodocumento')->insert(['nombre'=>'Reglamento','codigo'=>'RE','descripcion'=>'Documentos referentes a los reglamentos implementados en la institución.']);
        DB::table('tipodocumento')->insert(['nombre'=>'Tríptico','codigo'=>'TC','descripcion'=>'Trípticos creados por la institución.']);
    }
}
