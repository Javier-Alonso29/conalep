<?php

use Illuminate\Database\Seeder;

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
            'proceso_user'
        ]);

        $this->call(RolesSeeder::class);
        $this->call(EstadosSeeder::class);
        $this->call(MunicipiosSeeder::class);
        $this->call(PlantelesSeeder::class);
        $this->call(ProcesosSeeder::class);
        $this->call(SubprocesosSeeder::class);
        $this->call(UsuariosSeeder::class);
        $this->call(ProcesoUserSeeder::class);
    }

    protected function truncateTables(array $tables){

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        
        foreach($tables as $table){
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
