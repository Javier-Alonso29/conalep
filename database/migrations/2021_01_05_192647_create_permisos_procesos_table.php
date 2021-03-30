<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisosProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos_procesos', function (Blueprint $table) {
            $table->integer('leer');
            $table->integer('descargar');
            $table->integer('subir');
            $table->integer('borrar');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger('id_proceso');
            $table->foreign('id_proceso')->references('id')->on('procesos');    
            $table->unsignedBigInteger('id_plantel');
            $table->foreign('id_plantel')->references('id')->on('planteles');    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permisos_procesos');
    }
}
