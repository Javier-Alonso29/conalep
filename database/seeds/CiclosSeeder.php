<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CiclosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ciclo')->insert([
            'nombre'=>'Ciclo 2018-2019',
            'inicio'=>2018,
            'conclusion'=>2019
        ]);

        DB::table('ciclo')->insert([
            'nombre'=>'Ciclo 2019-2020',
            'inicio'=>2019,
            'conclusion'=>2020
        ]);

        DB::table('ciclo')->insert([
            'nombre'=>'Ciclo 2020-2021',
            'inicio'=>2020,
            'conclusion'=>2021
        ]);

        DB::table('ciclo')->insert([
            'nombre'=>'Ciclo 2021-2022',
            'inicio'=>2021,
            'conclusion'=>2022
        ]);

        DB::table('ciclo')->insert([
            'nombre'=>'Ciclo 2022-2023',
            'inicio'=>2022,
            'conclusion'=>2023
        ]);

        DB::table('ciclo')->insert([
            'nombre'=>'Ciclo 2023-2024',
            'inicio'=>2023,
            'conclusion'=>2024
        ]);

        DB::table('ciclo')->insert([
            'nombre'=>'Ciclo 2024-2025',
            'inicio'=>2024,
            'conclusion'=>2025
        ]);

        DB::table('ciclo')->insert([
            'nombre'=>'Ciclo 2025-2026',
            'inicio'=>2024,
            'conclusion'=>2025
        ]);

        DB::table('ciclo')->insert([
            'nombre'=>'Ciclo 2026-2027',
            'inicio'=>2024,
            'conclusion'=>2025
        ]);

        DB::table('ciclo')->insert([
            'nombre'=>'Ciclo 2027-2028',
            'inicio'=>2024,
            'conclusion'=>2025
        ]);

        DB::table('ciclo')->insert([
            'nombre'=>'Ciclo 2028-2029',
            'inicio'=>2024,
            'conclusion'=>2025
        ]);

        DB::table('ciclo')->insert([
            'nombre'=>'Ciclo 2029-2030',
            'inicio'=>2024,
            'conclusion'=>2025
        ]);
    }
}
