<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcesoPersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proceso_personal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_subproceso');
            $table->foreign('id_subproceso')->references('id')->on('subprocesos');
            $table->unsignedBigInteger("id_usuario");
            $table->foreign("id_usuario")->references('id')->on('users');
            $table->string('nombre')->unique();
            $table->string('codigo')->unique();
            $table->longText("descripcion")->nullable();
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
        Schema::dropIfExists('_proceso_personal');
    }
}
