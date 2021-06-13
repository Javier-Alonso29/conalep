<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'roles',
            'users',
            'estados',
            'municipios',
            'planteles',
            'procesos',
            'subprocesos',
            'proceso_personal',
            'proceso_user',
            'documento',
            'tipodocumento'
        ]);

        $this->call(RolesSeeder::class);
        $this->call(EstadosSeeder::class);
        $this->call(MunicipiosSeeder::class);
        $this->call(PlantelesSeeder::class);
        $this->call(UsuariosSeeder::class);
        $this->call(ProcesosSeeder::class);
        $this->call(SubprocesosSeeder::class);
        $this->call(ProcesoPersonal::class);
        $this->call(ProcesoUserSeeder::class);
        $this->call(DocumentosSeeder::class);
        $this->call(TiposDocumentoSeeder::class);
    }

    protected function truncateTables(array $tables){

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        
        foreach($tables as $table){
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}