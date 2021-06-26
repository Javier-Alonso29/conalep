<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcesosSeeder extends Seeder
{
    /**
     * Seeder encargado de cargar todos los procesos predefinidos.
     *
     * @return void
     */
    public function run()
    {
        //PROCESOS ÁMBITO CE Y PLANTEL <---- SON MACROPROCESOS DE CONALEP (La mayoría)
        DB::table('procesos')->insert(['nombre'=>'Planeación y seguimiento de la gestión','codigo'=>'PSG','descripcion'=>'Proceso Directivo de planeación y seguimiento de la gestión.']);
        DB::table('procesos')->insert(['nombre'=>'Gestión de servicios escolares','codigo'=>'GSE','descripcion'=>'Proceso Sustantivo de gestión de servicios escolares.']);
        DB::table('procesos')->insert(['nombre'=>'Gestión del proceso de enseñanza - aprendizaje','codigo'=>'GEA','descripcion'=>'Proceso Sustantivo de gestión del proceso de enseñanza - aprendizaje.']);
        DB::table('procesos')->insert(['nombre'=>'Gestión de la vinculación institucional','codigo'=>'VI','descripcion'=>'Proceso Sustantivo de gestión de la vinculación institucional.']);
        DB::table('procesos')->insert(['nombre'=>'Gestión de recursos','codigo'=>'GR','descripcion'=>'Proceso de Soporte de la gestión de recursos.']);
        DB::table('procesos')->insert(['nombre'=>'Evaluación del desempeño','codigo'=>'EDM','descripcion'=>'Proceso Directivo de la evaluación del desempeño.']);
        DB::table('procesos')->insert(['nombre'=>'Mejora','codigo'=>'ME','descripcion'=>'Proceso Directivo de Mejora.']);



        //PROCESOS ÁMBITO CONALEP

        #MACROPROCESO DIRECTIVO DE PLANECIÓN Y SEGUIMEINTO DE LA GESTIÓN
        DB::table('procesos')->insert(['nombre'=>'Planeación de la gestión y crecimiento institucional','codigo'=>'PGC','descripcion'=>' ']);
        DB::table('procesos')->insert(['nombre'=>'Gestión y coordinación estrategica','codigo'=>'GCE','descripcion'=>' ']);

        
        #MACROPROCESO SUSTANTIVO MODELO ACADÉMICO
        DB::table('procesos')->insert(['nombre'=>'Diseño, desarollo y evaluación curricular','codigo'=>'DDE','descripcion'=>' ']);
        DB::table('procesos')->insert(['nombre'=>'Formación y evaluación académica','codigo'=>'FEA','descripcion'=>' ']);
        DB::table('procesos')->insert(['nombre'=>'Evaluación de competencias','codigo'=>'EC','descripcion'=>' ']);


        #MACROPROCESO SUSTANTIVO SERVICIOS INSTITUCIONALES
        DB::table('procesos')->insert(['nombre'=>'Servicios educativos para la formación de profesionales técnicos bachiller','codigo'=>'SEF','descripcion'=>' ']);
        DB::table('procesos')->insert(['nombre'=>'Servicios tecnológicos y de capacitación','codigo'=>'STC','descripcion'=>' ']);


        #MACROPROCESO SUSTANTIVO VINCULACIÓN INSTITUCIONAL
        DB::table('procesos')->insert(['nombre'=>'Vinculación nacional','codigo'=>'VN','descripcion'=>' ']);
        DB::table('procesos')->insert(['nombre'=>'Vinculación internacional','codigo'=>'PVI','descripcion'=>' ']);


        #MACROPROCESO DE SOPORTE GESTIÓN DE RECURSOS
        DB::table('procesos')->insert(['nombre'=>'Capital humano','codigo'=>'CP','descripcion'=>' ']);
        DB::table('procesos')->insert(['nombre'=>'Recursos financieros','codigo'=>'RF','descripcion'=>' ']);
        DB::table('procesos')->insert(['nombre'=>'Infraestructura y servicios','codigo'=>'IS','descripcion'=>' ']);
        DB::table('procesos')->insert(['nombre'=>'Tecnologías de la información','codigo'=>'TI','descripcion'=>' ']);
        DB::table('procesos')->insert(['nombre'=>'Apoyo','codigo'=>'AP','descripcion'=>' ']);


        #MACROPROCESO DIRECTIVO EVALUACIÓN DEL DESEMPEÑO
        DB::table('procesos')->insert(['nombre'=>'Integración de información para la evaluación y seguimiento','codigo'=>'IIE','descripcion'=>' ']);
        DB::table('procesos')->insert(['nombre'=>'Calidad institucional','codigo'=>'CI','descripcion'=>' ']);
        DB::table('procesos')->insert(['nombre'=>'Evaluación del SCGC','codigo'=>'ESG','descripcion'=>' ']);

        

        #MACROPROCESO MEJORA
        DB::table('procesos')->insert(['nombre'=>'Mejora continua','codigo'=>'MC','descripcion'=>' ']);

        


        //PROCESOS SECUENCIA
        
        #EXTRAS <-PROCESOS ENCONTRADOS EN LA SECUENCIA
        /* TENGO DUDAS DE ESTO, PARACE QUE SON SINÓNIMOS DE OTROS*/
    
        DB::table('procesos')->insert(['nombre'=>'Servicios institucionales','codigo'=>'SI','descripcion'=>' ']);
        DB::table('procesos')->insert(['nombre'=>'Modelo académico','codigo'=>'MA','descripcion'=>' ']);
        DB::table('procesos')->insert(['nombre'=>'Proceso de soporte','codigo'=>'PS','descripcion'=>' ']);

    }
}