<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRutaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruta', function (Blueprint $table) {
            $table->id('id_ruta');
            $table->unsignedBigInteger('id_proceso');
            $table->foreign('id_proceso')
                 ->references('id')->on('procesos');
            $table->unsignedBigInteger('id_subproceso');
            $table->foreign('id_subproceso')
                 ->references('id')->on('subprocesos');
            $table->unsignedBigInteger('id_tipodocumento');
            $table->foreign('id_tipodocumento')
                      ->references('id')->on('tipodocumento');
            $table->unsignedBigInteger('id_documento');
            $table->foreign('id_documento')
                           ->references('id')->on('documento');
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
        Schema::dropIfExists('ruta');
    }
}
