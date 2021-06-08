<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class ProcesoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $super_user_seeder = User::find(1); 
        $user_seeder = User::find(2);

        DB::table('proceso_user')->insert(['user_id'=>$super_user_seeder->id,'proceso_id'=>1]);
        DB::table('proceso_user')->insert(['user_id'=>$super_user_seeder->id,'proceso_id'=>2]);
        DB::table('proceso_user')->insert(['user_id'=>$super_user_seeder->id,'proceso_id'=>3]);
        DB::table('proceso_user')->insert(['user_id'=>$super_user_seeder->id,'proceso_id'=>4]);
        DB::table('proceso_user')->insert(['user_id'=>$super_user_seeder->id,'proceso_id'=>5]);
        DB::table('proceso_user')->insert(['user_id'=>$user_seeder->id,'proceso_id'=>1]);
        DB::table('proceso_user')->insert(['user_id'=>$user_seeder->id,'proceso_id'=>2]);
        DB::table('proceso_user')->insert(['user_id'=>$user_seeder->id,'proceso_id'=>3]);
        DB::table('proceso_user')->insert(['user_id'=>$user_seeder->id,'proceso_id'=>5]);
    }
}